<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function spot_trips() {
        return $this->hasmany(Spot_trip::class);
    }
    
    public function images() {
        return $this->hasmany(Image::class);
    }

    public function likes() {
        return $this->hasmany(Like::class);
    }
}
