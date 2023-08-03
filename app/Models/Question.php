<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;
    public function form_questions(): BelongsTo
    {
        return $this->belongsTo(FormQuestion::class);
    }
    public function question_options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
