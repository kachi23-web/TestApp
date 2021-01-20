<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,

            'name' => $this->name,

            'DoB' => $this->DoB,
             'LGA'=> $this->LGA,
             'state' => $this->state,
             'Phone_Number'=> $this->Phone_Number,
             'Country_code'=> $this->Country_code,

            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),

        ];

        //return parent::toArray($request);
    }
}
