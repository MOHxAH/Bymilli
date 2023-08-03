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

    public function responses(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
    public function requests(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function forms(): HasOne
    {
        return $this->hasOne(Form::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
