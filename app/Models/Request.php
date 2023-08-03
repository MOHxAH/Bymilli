<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function versions(): HasMany
    {
        return $this->hasMany(Version::class);
    }

    public function form_questions(): HasMany
    {
        return $this->hasMany(FormQuestion::class);
    }

    public function forms(): HasOne
    {
        return $this->hasOne(Form::class);
    }
}
