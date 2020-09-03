<?php

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
        //$this->call(SubjectSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(ProductSeeder::class);
        //$this->call(OrderSeeder::class);
        
        $this->call(UserSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(AcademicLevelSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(PaperSeeder::class);
    }
}
