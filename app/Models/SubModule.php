<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubModule extends Model
{
    protected $fillable = [
        'module_id',
        'name',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
