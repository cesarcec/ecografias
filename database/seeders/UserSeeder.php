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
            'email' => 'admin@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '1'
        ]); 
        
/////Recepcionista//////
User::create([
    'name' => 'lucia',
    'email' => 'lucia@correo.cedisa.bo',
    'password' => Hash::make('123'),
    'rol_id' => '2'
]); 

      ///ESPECIALISTAS//
      //tomografia
        User::create([
            'name' => 'liliana',
            'email' => 'liliana@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '3'
        ]);
       /* 
        //ecografia
        User::create([
            'name' => 'carlos',
            'email' => 'carlos@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '3'
        ]); 

        //rayosx
        User::create([
            'name' => 'pedro',
            'email' => 'pedro@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '3'
        ]); 
        ////////////*/


         //paciente/////
        
         User::create([
            'name' => 'hugo',
            'email' => 'hugo@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '4'
        ]); 

        ///////repartidor////
        User::create([
            'name' => 'ronald',
            'email' => 'ronald@correo.cedisa.bo',
            'password' => Hash::make('123'),
            'rol_id' => '5'
        ]); 


       



    }
}
