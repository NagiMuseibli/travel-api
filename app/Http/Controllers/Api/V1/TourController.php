<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TourController extends Controller
{
    public function index(Travel $travel, Request $request)
    {

        $request->validate([
           'priceFrom' => 'numeric',
           'priceTo' => 'numeric',
           'dateFrom' => 'date',
           'dateTo' => 'date',
           'sortBy' => Rule::in(['price']),
           'sortOrder' => Rule::in(['asc', 'desc']),
        ]);

        $tours = $travel->tours()
            ->when($request->priceFrom, function ($query) use ($request){
                $query->where('price', '>=', $request->priceForm * 100);
            })
            ->when($request->priceTo, function ($query) use ($request){
                $query->where('price', '<=', $request->priceForm * 100);
            })
            ->when($request->dateFrom, function ($query) use ($request){
                $query->where('starting_date', '>=', $request->dateFrom);
            })
            ->when($request->dateTo, function ($query) use ($request){
                $query->where('starting_date', '<=', $request->dateTo);
            })
            ->when($request->sortBy && $request->sortOrder, function ($query) use ($request){
                if(!in_array($request->sortOrder, ['asc', 'desc'])) return;
                $query->orderBy($request->sortBy, $request->sortOrder);
            })
            ->orderBy('starting_date')
            ->paginate();

        return TourResource::collection($tours);
    }
}
