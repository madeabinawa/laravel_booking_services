<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 50; $i++) {
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('customer'),
            ]);

            // CREATE CUSTOMER DETAIL IN CUSTOMERS TABLE
            $profile = Customer::create([
                'phone' => '0182739812',
                'address' => $faker->address(),
                'city' => $faker->city(),
                'priority' => 'HIGH',
            ]);

            $profile->user()->save(User::find($user->id));
        }
    }
}
