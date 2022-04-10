<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\SkillDetail;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'children' => ChildSkillResource::collection(SkillDetail::where(['is_published'=>true, 'skill_id'=> $this->id])->get()),
        ];
    }
}
