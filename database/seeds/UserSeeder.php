<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'user@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'name' => 'namnn',
        ]);
    }
}
