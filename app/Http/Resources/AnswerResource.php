<?php

namespace App\Http\Resources;

use App\Http\Resources\FormQuestionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'form_question' => new FormQuestionResource($this->form_question),
            'answer_content' => $this->content,
        ];    }
}
