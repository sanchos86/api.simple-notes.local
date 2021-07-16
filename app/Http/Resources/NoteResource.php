<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use DateTime;

/**
 * Class NoteResource
 * @package App\Http\Resources
 *
 * @property int id
 * @property string priority
 * @property string description
 * @property DateTime date
 * @property boolean completed
 * @property Category category
 */
class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'priority' => $this->priority,
            'description' => $this->description,
            'date' => $this->date,
            'completed' => $this->completed,
            'category' => new CategoryResource($this->category)
        ];
    }
}
