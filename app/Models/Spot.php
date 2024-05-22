<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;
    
    public function spot_trips() {
        return $this->hasmany(Spot_trip::class);
    }
    
    public function spot_category() {
        return $this->belongsTo(Spot_category::class);
    }
}
