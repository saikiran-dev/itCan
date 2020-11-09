<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Service extends JsonResource
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
            "id" => $this->id,
            "client" => $this->client,
            "service" => $this->service,
            "row_count" => $this->row_count,
            "user" => $this->user,
            "revenue" => $this->revenue,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),

        ];
    }
}
