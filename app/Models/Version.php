<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Version extends Model
{
    use HasFactory;

    public function requests(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
    public function responses(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
