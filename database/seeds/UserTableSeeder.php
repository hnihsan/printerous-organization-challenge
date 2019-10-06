<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create('en_US');
        $password = base64_encode(Hash::make('demo'));
        for($i=1; $i<=10; $i++){
            User::create([
                'email'             => ($i == 1) ? "admin@printerous.com" : "{$f->firstName}@printerous.com",
                'password'          => $password,
                'name'              => $f->name
            ]);
        }
    }
}
