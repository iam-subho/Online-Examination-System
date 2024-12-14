<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_uid',
        'question_text',
        'question_type',
        'difficulty',
        'points',
    ];


    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
