<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'superadmin',
            'email'=>'superadmin@mail.com',
            'password'=> '12345678',
            'is_admin'=>true,


        ]);
    }
}
