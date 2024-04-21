<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequests\IndexStoreRequest;
use App\Http\Requests\StoreRequests\ShowStoreRequest;
use App\Models\City;
use App\Models\Store;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexStoreRequest $request)
    {
        $request->validated();
        $query = Store::query();
        if (!is_null($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%');
        }
        if (!is_null($request['city'])) {
            $cityId = City::where('name', $request['city'])->first()?->id;
            if (is_null($cityId)) {
                return response()->json([
                    'message' => 'City not found'
                ], Response::HTTP_NOT_FOUND);
            }
            $query->where('city', $cityId);
        }
        if (!is_null($request['address'])) {
            $query->where('address', 'like', '%' . $request['address'] . '%');
        }
        if (!is_null($request['foundedDate'])) {
            $query->where('foundedDate', $request['foundedDate']);
        }
        if (!is_null($request['openingTime'])) {
            $query->where('openingTime', $request['openingTime']);
        }
        if (!is_null($request['closingTime'])) {
            $query->where('closingTime', $request['closingTime']);
        }
        if ($request['withCity'] == true) {
            $query->with('city');
        }
        $stores = $query->paginate($request['limit'] ?? 10);
        if ($stores->isEmpty()) {
            return response()->json([
                'message' => 'No store found'
            ], Response::HTTP_NOT_FOUND);
        }
        return $stores;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowStoreRequest $request, $id)
    {
        $request->validated();
        $store = Store::find($id);
        if ($request['withCity'] == true) {
            $store = $store->load('city');
        }
        if (is_null($store)) {
            return response()->json([
                'message' => 'Store not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return $store;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
