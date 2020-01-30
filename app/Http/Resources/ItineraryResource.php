<?php

namespace App\Http\Resources;

use App\Itinerary;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ItineraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  parent::toArray($request);
        $data['date_readable'] = Carbon::parse($data['date'])->toFormattedDateString();
        return $data;
    }
}
