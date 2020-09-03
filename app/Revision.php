<?php

namespace App;

use App\Service;
use App\assignmentOrder;
use Illuminate\Database\Eloquent\Model;


class Revision extends Model
{
   
    protected $table = 'revisions';
    protected $casts = ['file' => 'array'];


    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function order() {
    	return $this->belongsTo(assignmentOrder::class, 'assignment_order_id', 'id');
    }

    public function files() {
    	return $this->belongsTo(File::class);
    }


    public function service() {
        return $this->belongsTo(Service::class);
    }


}
