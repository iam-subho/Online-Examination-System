<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolBoard extends Model
{
    protected $fillable = [
        'state_id',
        'name',
    ];

    public function state()
    {
        if ($this->state_id == 0 || $this->state_id === null) {
            return new State(['name' => 'Central']);
        }
        return $this->belongsTo(State::class);
    }

    /**
     * Scope for filtering by state_id.
     */
    public function scopeStateId($query, int $stateId)
    {
        return $query->where('state_id', $stateId);
    }
}
