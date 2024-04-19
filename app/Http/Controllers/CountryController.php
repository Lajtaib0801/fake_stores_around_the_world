<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)         //TODO Search by name, code and continent!
    {
        $countries = Country::paginate($request['limit'] ?? 10);
        if ($request['withCities'] == 'true') {
            $countries = $countries->load('cities');
        }
        if (is_null($countries['data'])) {
            return response()->json([
                'message' => 'Countries not found'
            ], 404);
        }
        return $countries;
    }

    public function show(Request $request, $id)
    {
        $country = Country::find($id);
        if ($request['withCities'] == 'true') {
            $country = $country->load('cities');
        }
        if (is_null($country)) {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }
        return $country;
    }
}
