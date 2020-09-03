<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'USD',
            'value' => '1'
           
        ]);

        Currency::create([
            'name' => 'GBP',
            'value' => '0.79'
        ]);

        Currency::create([
            'name' => 'EUR',
            'value' => '0.89'
        ]);

        Currency::create([
            'name' => 'CAD',
            'value' => '1.34'
        ]);

        Currency::create([
            'name' => 'AUD',
            'value' => '1.43'
        ]);
    }
}
