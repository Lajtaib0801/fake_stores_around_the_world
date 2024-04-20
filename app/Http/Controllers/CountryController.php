<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequests\GetCountryRequest;
use App\Models\Country;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function index(GetCountryRequest $request)
    {
        $request->validated();
        $query = Country::query();
        if (!is_null($request['name'])) {
            $query->where('name', 'like', '%'. $request['name']. '%');
        }
        if (!is_null($request['code'])) {
            $query->where('code', 'like', '%'. $request['code']. '%');
        }
        if (!is_null($request['continent'])) {
            $query->where('continent', $request['continent']);
        }
        if ($request['withCities'] == true) {
            $query->with('cities');
        }
        $countries = $query->paginate($request['limit'] ?? 10);
        if ($countries->isEmpty()) {
            return response()->json([
                'message' => 'Countries not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return $countries;
    }

    public function show(GetCountryRequest $request, $id)
    {
        $request->validated();
        $country = Country::find($id);
        if ($request['withCities'] == true) {
            $country = $country->load('cities');
        }
        if (is_null($country)) {
            return response()->json([
                'message' => 'Country not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return $country;
    }
}
