<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   /*=> MASCULINO*/
       $user = User::create([
            'name' =>  fake()->name($gender = "male"),
            'email' => fake()->unique()->email($gender = "male"),
            'phone' => fake()->unique()->phoneNumber(),
            'gender' => "MASCULINO",
            'password' => bcrypt('password')
        ]);

        Funcionario::create([
            'categoria' => 'VIP',
            'user_id' => $user->id,
            'created_by' => $user->id,
            'updated_by'=> $user->id
        ]);
    }
}
