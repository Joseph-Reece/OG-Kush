<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    protected $fillable = [
        'name',
        'place_id',
        'image',
        'description',
        'details',
    ];

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }
}
