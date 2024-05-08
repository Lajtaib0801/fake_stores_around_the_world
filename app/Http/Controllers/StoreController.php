<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequests\IndexStoreRequest;
use App\Http\Requests\StoreRequests\ShowStoreRequest;
use App\Http\Requests\StoreRequests\StoreStoreRequest;
use App\Http\Requests\StoreRequests\UpdateStoreRequest;
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
        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->query('city')) {
            $query->whereHas('city', function ($cityQuery) use ($request) {
                $cityQuery->where('name', $request->query('city'));
            });
        }

        if ($request->query('address')) {
            $query->where('address', 'like', '%' . $request->query('address') . '%');
        }

        if ($request->query('foundedDate')) {
            $query->where('foundedDate', $request->query('foundedDate'));
        }

        if ($request->query('openingTime')) {
            $query->where('openingTime', $request->query('openingTime'));
        }

        if ($request->query('closingTime')) {
            $query->where('closingTime', $request->query('closingTime'));
        }

        if ($request->query('withCity') == true) {
            $query->with('city');
        }

        $stores = $query->paginate($request->query('limit', 10));

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
    public function store(StoreStoreRequest $request)
    {
        $request->validated();
        Store::create($request->all());
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowStoreRequest $request, $id)
    {
        $request->validated();
        $store = Store::find($id);
        if ($request->query('withCity') == true) {
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
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $request->validated();
        return $store->update($request->all());
        // return $updatedStore;
        // if ($updatedStore) {
        //     return response()->noContent();
        // }
        // return response()->json([
        //     'message' => 'No store found to be updated'
        // ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
