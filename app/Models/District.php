<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'state_id',
        'name',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function scopeStateId($query, $stateId){
        return $query->where('state_id', $stateId);
    }
}
