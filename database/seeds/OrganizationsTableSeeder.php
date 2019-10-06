<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Organization;
use Faker\Factory;
class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create('en_US');
        $users = User::all();
        foreach ($users as $user){
            Organization::create([
                'email'             => $f->companyEmail,
                'name'              => $f->company,
                'phone'             => $f->phoneNumber,
                'logo'              => null,
                'website'           => $f->url,
                'user_id'           => $user->id
            ]);
        }
    }
}
