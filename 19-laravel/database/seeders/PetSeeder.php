<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet = new Pet;
        $pet->name = 'Sancocho';
        $pet->kind = 'Dog';
        $pet->weight = 9.8;
        $pet->age = 1;
        $pet->breed = 'Sicario';
        $pet->location = 'Bogotá, Bosa';
        $pet->description = 'Perro peligroso y juguetón, ideal para familias con niños';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Pedro';
        $pet->kind = 'Dog';
        $pet->weight = 9.8;
        $pet->age = 2;
        $pet->breed = 'Sicario';
        $pet->location = 'Bogotá, Bosa';
        $pet->description = 'Perro peligroso y juguetón, ideal para familias con niños';
        $pet->save();
    }
}