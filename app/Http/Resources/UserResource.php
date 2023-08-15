<?php

namespace App\Http\Resources;

use App\Http\Resources\ProjectUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'logo' => $this->logo,
            'user_type' => $this->user_type,
            'user_projects' => ProjectUserResource::collection($this->project_users)


        ];
    }
}
