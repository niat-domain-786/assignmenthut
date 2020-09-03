<?php

use App\AcademicLevel;
use Illuminate\Database\Seeder;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	AcademicLevel::create([
    		'name' => 'Doctoral',  
    	]);

        AcademicLevel::create([
          
            'name' => 'Masters',
        ]);

        AcademicLevel::create([
     
            'name' => 'Bachelors',
        ]);

        AcademicLevel::create([
      
            'name' => 'Diploma',
        ]);

        AcademicLevel::create([
 
            'name' => 'High School',
        ]);
        				
    }
}
