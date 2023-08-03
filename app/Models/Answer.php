<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;
    public function responses(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
    public function versions(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }
    public function form_questions(): BelongsTo
    {
        return $this->belongsTo(FormQuestion::class);
    }
}
