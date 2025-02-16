<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'session_id',
        'row',
        'seat',
        'type',
        'qr_code'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
