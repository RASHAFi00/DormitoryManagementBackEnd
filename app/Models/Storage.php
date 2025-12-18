<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = [

    ];

    protected $hidden = [

    ];

    public function unit() {
        return $this->belongsTo(Unit::class , "unit_id" , "id");
    }
}
