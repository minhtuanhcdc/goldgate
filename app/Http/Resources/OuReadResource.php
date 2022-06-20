<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OuReadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'read_code'=>$this->read_code,
            'status'=>$this->status,

        ];
    }
}
