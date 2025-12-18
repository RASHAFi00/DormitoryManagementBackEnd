<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "gender",
        "room_cap",
        "room_count"
    ];

    protected $hidden = [];

    public function employee() {
        return $this->hasMany(Employee::class , "unit_id" , "id");
    }

    public function room() {
        return $this->hasMany(Room::class , "unit_id" , "id");
    }

    public function storage() {
        return $this->hasMany(Storage::class , "unit_id" , "id");
    }
}
