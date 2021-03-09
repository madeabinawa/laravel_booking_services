<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class AdminModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 1; $i++) {
            $user = User::create([
                'email' => 'admin' . $i . '@mail.com',
                'password' => Hash::make('12345678'),
            ]);

            // CREATE ASSISTANT DETAIL IN ASSISTANT TABLE
            $profile = Admin::create([
                'name' => $faker->name(),
            ]);
            $profile->user()->save(User::find($user->id));
        }
    }
}
