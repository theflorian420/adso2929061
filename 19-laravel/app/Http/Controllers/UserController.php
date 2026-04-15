<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('qsearch');
        $users = User::orderBy('id', 'desc')
            ->when($q, fn($query) => $query->where(function($query) use ($q) {
                $query->where('fullname',  'like', "%$q%")
                      ->orWhere('email',    'like', "%$q%")
                      ->orWhere('document', 'like', "%$q%")
                      ->orWhere('phone',    'like', "%$q%");
            }))
            ->paginate(12)
            ->withQueryString();
        return view('users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => ['required', 'unique:' . User::class],
            'fullname' => ['required', 'string'],
            'gender'   => ['required'],
            'birthdate'=> ['required', 'date'],
            'photo'    => ['required', 'image'],
            'phone'    => ['required'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $photo = 'no-photo.png';
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);
        }

        $user = new User;
        $user->document  = $request->document;
        $user->fullname  = $request->fullname;
        $user->gender    = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo     = $photo;
        $user->phone     = $request->phone;
        $user->email     = $request->email;
        $user->password  = bcrypt($request->password);

        if ($user->save()) {
            return redirect('users')
                ->with('message', 'El usuario ' . $user->fullname . ' fue agregado exitosamente.');
        }
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'document' => ['required', 'numeric', 'unique:' . User::class . ',document,' . $user->id],
            'fullname' => ['required', 'string'],
            'gender'   => ['required'],
            'birthdate'=> ['required', 'date'],
            'phone'    => ['required'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $user->id],
        ]);

        $photo = $request->originphoto ?? 'no-photo.png';
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photo);

            if ($request->originphoto != 'no-photo.png' &&
                file_exists(public_path('images/' . $request->originphoto))) {
                unlink(public_path('images/' . $request->originphoto));
            }
        }

        $user->document  = $request->document;
        $user->fullname  = $request->fullname;
        $user->gender    = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo     = $photo;
        $user->phone     = $request->phone;
        $user->email     = $request->email;

        if ($user->save()) {
            return redirect('users')
                ->with('message', 'El usuario ' . $user->fullname . ' fue editado exitosamente.');
        }
    }

    public function destroy(User $user)
    {
        if ($user->photo != 'no-photo.png' && file_exists(public_path('images/' . $user->photo))) {
            unlink(public_path('images/' . $user->photo));
        }

        $user->delete();

        return redirect('users')
            ->with('message', 'El usuario ' . $user->fullname . ' fue eliminado exitosamente.');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function exportPdf()
    {
        $users = User::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('users.pdf', compact('users'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('users_' . now()->format('Ymd_His') . '.pdf');
    }
}