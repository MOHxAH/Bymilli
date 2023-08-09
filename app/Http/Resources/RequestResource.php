<?php

namespace App\Http\Resources;

use App\Http\Resources\VersionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //'request_id' => $this->id,
            'code'=> $this->code,
            'versions' => VersionResource::collection($this->versions),
        ];
    }
}
