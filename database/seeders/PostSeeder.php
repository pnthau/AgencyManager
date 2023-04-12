<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $companyIds = Company::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        $amount = 100;
        for ($i = 0; $i < $amount; $i++) {
            Post::create(
                [
                    'job_title' => fake()->jobTitle(),
                    'district' =>  fake()->city(),
                    'city' => fake()->city(),
                    'remote' => fake()->boolean(),
                    'is_parttime' => fake()->boolean(),
                    'min_salary' => fake()->numberBetween(1000000, 3000000),
                    'max_salary' => fake()->numberBetween(5000000, 10000000),
                    'company_id' => fake()->randomElement($companyIds),
                    'user_id' => fake()->randomElement($userIds),
                ]
            );
        }
    }
}
