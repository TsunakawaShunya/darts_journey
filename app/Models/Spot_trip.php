<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot_trip extends Model
{
    use HasFactory;
    
    public function trip() {
        return $this->belongsTo(User::class);
    }
    
    public function spot() {
        return $this->belongsTo(Spot_trip::class);
    }
}
