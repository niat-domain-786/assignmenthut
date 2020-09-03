<?php

namespace App;

use App\Service;
use Illuminate\Database\Eloquent\Model;

class paper extends Model
{
    public function services() {
    	return $this->belongsTo(Service::class);
    }

}
