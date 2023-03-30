<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companyIds = Company::pluck('id')->toArray();
        return [
            'name' => fake()->lastName() . ' ' . fake()->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
            'avatar' => fake()->imageUrl(60, 60),
            'phone' => fake()->phoneNumber(),
            'link' => null,
            'role' => fake()->randomElement(UserRoleEnum::getValues()),
            'bio' => fake()->boolean() ? fake()->name() : null,
            'position' => fake()->jobTitle(),
            'gender' => fake()->boolean(),
            'city' => fake()->city(),
            'company_id' => fake()->randomElement($companyIds),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
