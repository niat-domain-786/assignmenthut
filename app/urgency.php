<?php

namespace App;

use App\assignmentOrder;
use Illuminate\Database\Eloquent\Model;

class urgency extends Model
{
    public function assignment_orders(){
    	return $this->hasMany(assignmentOrder::class, 'deadline', 'id');
    }
}
