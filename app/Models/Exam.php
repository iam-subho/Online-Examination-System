<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'exam_uid',
        'title',
        'description',
        'exam_date',
        'exam_expire_date',
        'duration',
        'total_question',
        'passing_percentage',
        'total_score',
        'status',
        'exam_category_id',
        'time_limit_per_question',
        'result_published',
        'created_by',
    ];
    protected $casts = [
        'result_published' => 'boolean',
    ];
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function examCategory(): BelongsTo
    {
        return $this->belongsTo(ExamCategory::class);
    }
}
