<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function show($id) {
        $city = City::find($id);
        if (is_null($city)) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return $city;
    }
}
