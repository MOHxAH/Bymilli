<?php

namespace App\Http\Resources;

use App\Http\Resources\AnswerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
        'answers' => AnswerResource::collection($this->answers),
        //'response'=> when('response'),
        ];
    }
}
