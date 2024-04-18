<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        if (is_null($countries)) {
            return response()->json([
               'message' => 'No countries found'
            ], 404);
        }
        return $countries;
    }

    public function show($id)
    {
        $country = Country::find($id);
        if (is_null($country)) {
            return response()->json([
               'message' => 'Country not found'
            ], 404);
        }
        return $country;
    }
}
