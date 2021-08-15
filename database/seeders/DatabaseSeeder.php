<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CountriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CountriesTableSeeder::class, 1);
        // $this->call(CurrenciesTableSeeder::class, 1);
        $this->call(BankTableSeeder::class, 1);
    }
}
