<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        User::create( [
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'role'     => 'user',
            'password' => bcrypt( '12345678' ),
        ] );
    }
}