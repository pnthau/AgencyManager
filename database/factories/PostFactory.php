<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyIds = Company::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        return [
            'job_title' => fake()->jobTitle(),
            'district' =>  fake()->city(),
            'city' => fake()->city(),
            'remote' => fake()->boolean(),
            'is_parttime' => fake()->boolean(),
            'min_salary' => fake()->numberBetween(1000000, 3000000),
            'max_salary' => fake()->numberBetween(5000000, 10000000),
            'company_id' => fake()->randomElement($companyIds),
            'user_id' => fake()->randomElement($userIds),
        ];
    }
}
