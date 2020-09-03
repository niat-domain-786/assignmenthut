<?php

namespace App;

use App\assignmentOrder;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(assignmentOrder::class);
    }
}
