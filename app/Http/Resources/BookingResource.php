<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'hotel_id' => $this->hotel_id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'number_of_people' => $this->number_of_people,
            'booking_date' => $this->booking_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
