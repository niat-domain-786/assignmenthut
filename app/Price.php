<?php

namespace App;

use App\AcademicLevel;
use App\Service;
use App\paper;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
	// protected $table = 'prices';
    public function service(){
    	return $this->belongsTo(Service::class);
    }

    public function academics(){
    	return $this->belongsTo(AcademicLevel::class, 'academic_level_id', 'id');
    }

    public function paper(){
    	return $this->belongsTo(paper::class);
    }
}
