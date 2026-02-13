<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //➡with eloquent:orm
        $user = new User;
        $user->document = 75000001;
        $user->fullname = 'Jhon wick';
        $user->gender = 'male';
        $user->birthdate = '1990-01-01';  
        $user->phone = 3000000001;        
        $user->email = 'john@mail.com';  
        $user->password = bcrypt('admin');
        $user->role = 'admin';
        $user->save();

        //➡with Query Builder
        DB::table('users')->insert([
            'document' => 75000002,
            'fullname' => 'Lara croft',
            'gender' => 'female',
            'birthdate' => '1969-02-14', 
            'phone' => 3200000002,
            'email' => 'larac@mail.com',
            'password' => bcrypt('1234'),
            'created_at' => now(),
            'updated_at' => now()
            
        ]);
    }
}