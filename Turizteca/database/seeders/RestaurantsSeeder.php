<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RRestaurantsAPIController extends Controller
{
    
    public function index()
    {
        $restaurants = Restaurant::with('owner')->get();
        return response()->json([
            "data" => $restaurants,
            "status" => "success"
        ]);
    }

    
    public function create()
    {
       
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'cuisine_type' => 'nullable|string',
            'average_price' => 'nullable|numeric',
            'location_lat' => 'nullable|numeric',
            'location_lng' => 'nullable|numeric',
            'opening_hours_type' => 'nullable|string',
            'opens_at' => 'nullable|string',
            'closes_at' => 'nullable|string'
        ]);

        $restaurant = Restaurant::create($request->all());

        return response()->json([
            "data" => $restaurant,
            "status" => "success"
        ], 201);
    }

    
    public function show(string $id)
    {
        $restaurant = Restaurant::with('owner')->find($id);
        
        if ($restaurant == null) {
            return response()->json([
                "message" => "Restaurante no encontrado",
                "status" => "error"
            ], 404);
        }

        return response()->json([
            "data" => $restaurant,
            "status" => "success"
        ]);
    }

    
    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::find($id);
        
        if ($restaurant == null) {
            return response()->json([
                "message" => "Restaurante no encontrado",
                "status" => "error"
            ], 404);
        }

        $restaurant->update($request->all());

        return response()->json([
            "data" => $restaurant,
            "status" => "success"
        ]);
    }

    
    public function destroy(string $id)
    {
        $restaurant = Restaurant::find($id);
        
        if ($restaurant == null) {
            return response()->json([
                "message" => "Restaurante no encontrado",
                "status" => "error"
            ], 404);
        }

        $restaurant->delete();

        return response()->json([
            "message" => "Restaurante eliminado",
            "status" => "success"
        ], 204);
    }
}