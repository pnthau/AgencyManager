<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::factory()->count(100)->create();
        $faker = \Faker\Factory::create();
        $companyIds = Company::pluck('id')->toArray();
        // $data = [];
        for ($i = 0; $i < 10000; $i++) {
            # code...
            User::create(
                [
                    'name' => $faker->lastName() . ' ' . $faker->firstName(),
                    'email' => $faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('123456789'), // password
                    'remember_token' => Str::random(10),
                    'avatar' => $faker->imageUrl(60, 60),
                    'phone' => $faker->phoneNumber(),
                    'link' => null,
                    'role' => $faker->randomElement(UserRoleEnum::getValues()),
                    'bio' => $faker->boolean() ? $faker->name() : null,
                    'position' => $faker->jobTitle(),
                    'gender' => $faker->boolean(),
                    'city' => $faker->city(),
                    'company_id' => $faker->randomElement($companyIds),
                ]
            );
        }
        // User::insert($data);
    }
}
