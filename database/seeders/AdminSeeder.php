<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@eatdrink.com'],
            [
                'name' => 'Administrateur',
                'nom_entreprise' => 'Eat&Drink',
                'password' => Hash::make('admin1234'), // Mot de passe par défaut
                'role' => 'admin',
                'statut' => 'approuve'
            ]
        );
    }
}
