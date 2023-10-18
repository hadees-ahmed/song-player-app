<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path', 'artist_id', 'duration', 'views'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}
