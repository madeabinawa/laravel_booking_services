<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Assistant;
use Illuminate\Support\Facades\Hash;

class AssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 2; $i++) {
            $user = User::create([
                'email' => 'assistant' . $i . '@mail.com',
                'password' => Hash::make('12345678'),
            ]);

            // CREATE ASSISTANT DETAIL IN ASSISTANT TABLE
            $profile = Assistant::create([
                'name' => $faker->name(),
                'phone' => '0182739888',
                'address' => $faker->address(),
                'city' => $faker->city(),
            ]);

            $profile->user()->save(User::find($user->id));
        }
    }
}
