<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $role = Role::inRandomOrder()->first();

        $user = User::create([
            'role_id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'phone' => '085854'
        ]);

        // for ($i=0; $i < 10; $i++) {
        //     $user = User::create([
        //         'role_id' => $role->id,
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => Hash::make('password'),
        //         'phone' => $faker->phoneNumber,
        //     ]);
        // }
    }
}
