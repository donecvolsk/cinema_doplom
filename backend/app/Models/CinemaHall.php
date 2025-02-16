<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaHall extends Model
{
    protected $fillable = [
        'name',
        'rows',
        'seats_per_row'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}