<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@cedisa.com',
            'password' => Hash::make('123'),
            'rol_id' => '1'
        ]); 
        

        User::create([
            'name' => 'recepcionista',
            'email' => 'recepcionista@cedisa.com',
            'password' => Hash::make('123'),
            'rol_id' => '2'
        ]); 
        
        User::create([
            'name' => 'doctor',
            'email' => 'doctor@cedisa.com',
            'password' => Hash::make('123'),
            'rol_id' => '3'
        ]); 

        User::create([
            'name' => 'paciente',
            'email' => 'paciente@cedisa.com',
            'password' => Hash::make('123'),
            'rol_id' => '4'
        ]); 

        User::create([
            'name' => 'repartidor',
            'email' => 'repartidor@cedisa.com',
            'password' => Hash::make('123'),
            'rol_id' => '5'
        ]); 

    }
}
