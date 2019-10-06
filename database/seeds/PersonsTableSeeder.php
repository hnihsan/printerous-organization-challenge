<?php

use App\Person;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Organization;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create('en_US');
        $organizations = Organization::all();
        foreach ($organizations as $organization){
            for($i=1; $i<=5; $i++) {
                Person::create([
                    'email'             => $f->email,
                    'name'              => $f->name,
                    'phone'             => $f->phoneNumber,
                    'avatar'            => null,
                    'organization_id'   => $organization->id
                ]);
            }
        }
    }
}
