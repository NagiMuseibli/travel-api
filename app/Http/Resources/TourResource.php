<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TourResource extends JsonResource
{
    const CURRENCY = [
        'AZN' => '₼',
        'USD' => '$',
    ];
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'name' => $this->name,
            'starting_date' => Carbon::parse($this->starting_date)->format('d-M-Y'),
            'ending_date' => Carbon::parse($this->ending_date)->format('d-M-Y'),
            'price' => number_format($this->price, 2) . ' ' .self::CURRENCY['AZN']

        ];
    }
}
