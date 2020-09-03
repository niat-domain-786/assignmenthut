<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Service::create([
          'name' => 'Academic Essay/Assignment',      
         ]);

         Service::create([
          'name' => 'Business Report',    
      
         ]);
         
         Service::create([
          'name' => 'Case Study',     
               
         ]);
         
         Service::create([
           'name' => 'Dissertation/Thesis',    
          

         ]);
         
         Service::create([
          'name' => 'Statistics/Economics Problem',     
     
         ]);
         
         Service::create([
           'name' => 'PowerPoint Presentation',    
          
         ]);
         
         Service::create([
          'name' => 'Reflection',     
      
         ]);
         
         Service::create([
          'name' => 'Article Critique',   
              
         ]);
         
         Service::create([
          'name' => 'Lab Report',
  
         ]);
         
         Service::create([
          'name' => 'Rewriting',
      
         ]);
         
         Service::create([
          'name' => 'Proofreading',

         ]);
         



    }
}
