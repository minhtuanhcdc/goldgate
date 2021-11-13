<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'display_name'=>$this->display_name,
            'parent_id'=>$this-> parent_id,
            'level_tag'=>$this-> level_tag,
            'status'=>$this-> status,
            'permissionsChildrent'=>new PermissionResource($this->whenLoaded('permissionsChildrent')),
            'created_at_for_human'=>$this->when($this->created_at, function(){
                return $this->created_at->diffForHumans();
            }),
        ];
    }
}
