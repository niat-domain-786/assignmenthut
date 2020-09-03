<?php

use App\paper;
use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        paper::create([
          'name' => 'Essay',
      
         ]);
        paper::create([
          'name' => 'MCQs',
      
         ]);
        paper::create([
          'name' => 'Paragraph Writing',
      
         ]);
        paper::create([
          'name' => 'Thesis',
      
         ]);
        paper::create([
          'name' => 'Research Paper',
      
         ]);
    }
}
