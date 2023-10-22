<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionExports extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'driver_name' => $this->user->fullname,
            'vehicle' => $this->vehicle->serie. " | " .$this->vehicle->license_number,
            'booking_start' => $this->booking_start,
            'pickup_date' => $this->pickup_date,
            'return_date' => $this->return_date,
            'is_borrowed' => $this->is_approved == 1 ? "Sudah" : "Belum",
            'is_returned' => $this->is_returned == 1 ? "Sudah" : "Belum",
        ];
    }
}
