<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = ['version_id','user_id','content','form_question_id'];
    use HasFactory;
    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }
    public function form_question(): BelongsTo
    {
        return $this->belongsTo(FormQuestion::class);
    }
}
