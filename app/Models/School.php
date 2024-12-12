<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'state_id',
        'district_id',
        'name',
        'address',
        'school_board_id',
        'school_code'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function scopeStateId($query, $stateId){
        return $query->where('state_id', $stateId);
    }

    public function scopeDistrictId($query, $districtId){
        return $query->where('district_id', $districtId);
    }
    public function scopeSchoolboardId($query, $schoolboardId){
        return $query->where('schoolboard_id', $schoolboardId);
    }

    public function scopeSchoolCodeId($query, $schoolCode){
        return $query->where('school_code', $schoolCode);
    }
}
