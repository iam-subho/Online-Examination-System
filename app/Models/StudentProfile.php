<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'state_id',
        'district_id',
        'school_board_id',
        'classes_id',
        'school_id',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function schoolBoard(): BelongsTo
    {
        return $this->belongsTo(SchoolBoard::class);
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
