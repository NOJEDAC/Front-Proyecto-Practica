<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
          'id' => $this->resource['id'],
          'firstName' => $this->resource['firstName'],
          'lastName' => $this->resource['lastName'],
          'identityDocument' => $this->resource['identityDocument'],
          'active' => $this->resource['active']

        ];
    }
}
