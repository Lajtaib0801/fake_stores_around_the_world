<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if (is_null($request['page'])) {
            return Country::all();
        }
        return Country::paginate($request['limit'] ?? 10);
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
