<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormQuestion extends Model
{
    use HasFactory;
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function form(): HasOne
    {
        return $this->hasOne(Form::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
