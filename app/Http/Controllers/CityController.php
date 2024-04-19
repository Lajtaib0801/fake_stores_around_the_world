<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if (is_null($request['page'])) {
            return City::all();
        }
        return City::paginate($request['limit'] ?? 10);
    }

    public function show($id) {
        $city = City::find($id);
        if (is_null($city)) {
            return response()->json(['message' => 'City not found'], 404);
        }
        return $city;
    }
}
