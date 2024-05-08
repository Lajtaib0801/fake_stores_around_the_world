<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequests\IndexCountryRequest;
use App\Http\Requests\CountryRequests\ShowCountryRequest;
use App\Models\Country;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function index(IndexCountryRequest $request)
    {
        $request->validated();
        $query = Country::query();

        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->query('code')) {
            $query->where('code', 'like', '%' . $request->query('code') . '%');
        }

        if ($request->query('continent')) {
            $query->where('continent', $request->query('continent'));
        }

        if ($request->query('withCities') == true) {
            $query->with('cities');
        }

        $countries = $query->paginate($request->query('limit', 10));

        if ($countries->isEmpty()) {
            return response()->json([
                'message' => 'Countries not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return $countries;
    }

    public function show(ShowCountryRequest $request, $id)
    {
        $request->validated();
        $country = Country::find($id);
        if ($request->query('withCities') == true) {
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
