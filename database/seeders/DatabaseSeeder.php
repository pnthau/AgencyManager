<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(UserSeeder::class);
    }
}
