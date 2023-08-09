<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Version extends Model
{
    use HasFactory;
    protected $fillable = ['request_id','version_number','response_id'];
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
    public function response(): HasOne
    {
        return $this->hasOne(Response::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
