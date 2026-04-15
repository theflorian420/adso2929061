<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Exports\PetsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PetController extends Controller
{
    private string $imgFolder = 'images/pets';

    public function index(Request $request)
    {
        $q = $request->input('qsearch');
        $pets = Pet::orderBy('id', 'desc')
            ->when($q, fn($query) => $query->where(function($query) use ($q) {
                $query->where('name',     'like', "%$q%")
                      ->orWhere('kind',   'like', "%$q%")
                      ->orWhere('breed',  'like', "%$q%")
                      ->orWhere('location', 'like', "%$q%");
            }))
            ->paginate(12)
            ->withQueryString();
        return view('pets.index', compact('pets', 'q'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required'],
            'weight'      => ['required', 'numeric', 'min:0'],
            'age'         => ['required', 'integer', 'min:0'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['required', 'string'],
            'image'       => ['required', 'image'],
        ]);

        $image = 'no-image.png';
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path($this->imgFolder), $image);
        }

        $pet = new Pet;
        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = (int) $request->input('active', 0);
        $pet->status      = 0;

        if ($pet->save()) {
            return redirect('pets')->with('message', 'La mascota ' . $pet->name . ' fue agregada exitosamente.');
        }
    }

    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required'],
            'weight'      => ['required', 'numeric', 'min:0'],
            'age'         => ['required', 'integer', 'min:0'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $image = $request->originimage ?? 'no-image.png';
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image']);
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path($this->imgFolder), $image);

            if ($request->originimage != 'no-image.png' &&
                file_exists(public_path($this->imgFolder . '/' . $request->originimage))) {
                unlink(public_path($this->imgFolder . '/' . $request->originimage));
            }
        }

        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = (int) $request->input('active', 0);
        $pet->status      = (int) $request->input('status', 0);

        if ($pet->save()) {
            return redirect('pets')->with('message', 'La mascota ' . $pet->name . ' fue editada exitosamente.');
        }
    }

    public function destroy(Pet $pet)
    {
        if ($pet->image != 'no-image.png' &&
            file_exists(public_path($this->imgFolder . '/' . $pet->image))) {
            unlink(public_path($this->imgFolder . '/' . $pet->image));
        }

        $pet->delete();

        return redirect('pets')->with('message', 'La mascota ' . $pet->name . ' fue eliminada exitosamente.');
    }

    public function exportExcel()
    {
        return Excel::download(new PetsExport, 'pets_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function exportPdf()
    {
        $pets = Pet::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('pets_' . now()->format('Ymd_His') . '.pdf');
    }
}
