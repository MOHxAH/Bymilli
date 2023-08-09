<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    use HasFactory;
    public function form_questions(): HasMany
    {
        return $this->hasMany(FormQuestion::class);
    }
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
