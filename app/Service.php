<?php

namespace App;

use App\AcademicLevel;
use App\Revision;
use App\assignmentOrder;
use App\paper;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   public function order(){

   	return $this->hasMany(assignmentOrder::class);

   }


   public function revisions(){

   	return $this->hasMany(Revision::class);
   	
   }

   public function papers(){

   	return $this->hasMany(paper::class);
   	
   }
}
