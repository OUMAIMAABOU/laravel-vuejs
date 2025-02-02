<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EtudiantResources extends JsonResource
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
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'age' => $this->age,
           
            // 'genre' => array_map(
            //     function ($genre) {
            //         return $genre['nom'];
            //     },
            //     $this->roles->toArray()
            // ),
            
        ];
    }
}
