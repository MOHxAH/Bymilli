<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{

    use HasFactory;

    protected $fillable = ['project_id',"project_name",
    "owner_name","consultant_name",
    'consultant_email','contractor_name',
    'contractor_email',"start_date",
    "end_date","project_logo",
    'project_description','location'];

    public function project_users(): HasMany
    {
        return $this->hasMany(ProjectUser::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function resposes(): HasMany
    {
        return $this->hasMany(Response::class);
    }

}
