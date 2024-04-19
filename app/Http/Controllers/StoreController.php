<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stores = Store::paginate($request['limit'] ?? 10);
        if ($request['withCity'] == 'true') {
            $stores = $stores->load('city');
        }
        if ($stores->isEmpty()) {
            return response()->json([
               'message' => 'No store found'
            ], 404);
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
    public function show(Request $request, $id)
    {
        $store = Store::find($id);
        if ($request['withCity'] == 'true') {
            $store = $store->load('city');
        }
        if (is_null($store)) {
            return response()->json([
               'message' => 'Store not found'
            ], 404);
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
