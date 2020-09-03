<?php

namespace App;

use App\Currency;
use App\Note;
use App\OrderMeta;
use App\Price;
use App\Revision;
use App\Service;
use App\paper;
use App\urgency;
use Illuminate\Database\Eloquent\Model;

class assignmentOrder extends Model
{

protected $casts = ['order_files' => 'array'];

   public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }

    public function exp_time()
    {
        return $this->belongsTo(Price::class, 'deadline', 'id');
    }

    public function paper()
    {
        return $this->belongsTo(paper::class);
    }

    public function academic_level()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function price_info()
    {
        return $this->belongsTo(Price::class, 'price_id', 'id');
    }

    public function meta_data() {
        return $this->hasOne(OrderMeta::class, 'assignment_order_id', 'id');
    }


}
