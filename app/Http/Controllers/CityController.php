<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::paginate($request['limit'] ?? 10);
        if ($request['withCountry'] == 'true') {
            $cities = $cities->load('country');
        }
        if ($request['withStores'] == 'true') {
            $cities = $cities->load('stores');
        }
        if (is_null($cities['data'])) {
            return response()->json(['message' => 'No city found'], 404);
        }
        return $cities;
    }

    public function show(Request $request, $id) {
        $city = City::find($id);
        if ($request['withCountry'] == 'true') {
            $city = $city->load('country');
        }
        if ($request['withStores'] == 'true') {
            $city = $city->load('stores');
        }
        if (is_null($city)) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return $city;
    }
}
