<?php

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        {
            return[
                'id' => $this->id,
                'client' => Client::findOrFail($this->client_id)->name,
                'number_order' => $this->number_order,
            ];
        }
    }
}
