<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->bathrooms);
        }
        if ($request->filled('storeys')) {
            $query->where('storeys', $request->storeys);
        }
        if ($request->filled('garages')) {
            $query->where('garages', $request->garages);
        }
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        return response()->json($query->get());
    }
}
