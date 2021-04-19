<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'HMT',
            'email' => 'tuanhanb98@gmail.com',
            'password' => Hash::make('123123123'),
            'admin' => 1
        ]);
    }
}
