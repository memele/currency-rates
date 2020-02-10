<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencyTableSeeder::class);

        $date = now();
        $month = $date->subMonth();
        $year = $month < 12 ? $date->year : $date->subYear();

        Artisan::call('rates:archive ' . $month . ' ' . $year);

        for ($day = 1; $day <= $date->day; $day++) {
            Artisan::call('rates:get ' . $day . ' ' . $date->month . ' ' . $date->year);
        }
    }
}
