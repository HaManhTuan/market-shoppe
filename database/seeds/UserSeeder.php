<?php

use App\User;
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
            'name' => 'HMT',
            'email' => 'tuanhanb98@gmail.com',
            'password' => Hash::make('123123123'),
            'admin' => 1
        ]);
    }
}
