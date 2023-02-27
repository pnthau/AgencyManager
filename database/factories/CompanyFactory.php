<?php

namespace Database\Factories;

use Faker\Generator as FakerGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = app(FakerGenerator::class);
        return [
            'name' => $faker->company,
            'address' => $faker->streetAddress(),
            'address2' => $faker->address(),
            'district' => $faker->streetName(),
            'city' => $faker->city(),
            'country' => $faker->country(),
            'zipcode' => $faker->postcode(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'logo' => $faker->boolean() ? fake()->imageUrl(340, 240) : null,

        ];
    }
}
