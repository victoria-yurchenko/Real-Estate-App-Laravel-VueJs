<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->has('bathrooms')) {
            $query->where('bathrooms', $request->bathrooms);
        }
        if ($request->has('storeys')) {
            $query->where('storeys', $request->storeys);
        }
        if ($request->has('garages')) {
            $query->where('garages', $request->garages);
        }
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        return response()->json($query->get());
    }
}
