<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();
        if ($request['name']) {
            $query = $query->where('name', 'like', '%' . $request['name'] . '%');
        }
        if ($request['isCapital'] == 'true') {
            $query = $query->where('isCapital', true);
        }
        if ($request['withCountry'] == 'true') {
            $query->with('country');
        }
        if ($request['withStores'] == 'true') {
            $query->with('stores');
        }
        $cities = $query->paginate($request['limit'] ?? 10);
        if ($cities->isEmpty()) {
            return response()->json(['message' => 'No city found'], Response::HTTP_NOT_FOUND);
        }
        return $cities;
    }

    public function show(Request $request, $id)
    {
        $city = City::find($id);
        if ($request['withCountry'] == 'true') {
            $city = $city->load('country');
        }
        if ($request['withStores'] == 'true') {
            $city = $city->load('stores');
        }
        if (is_null($city)) {
            return response()->json(['message' => 'City not found'], Response::HTTP_NOT_FOUND);
        }
        return $city;
    }
}
