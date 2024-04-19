<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Person::query();
        if (!is_null($request['name'])) {
            $query->where('name', 'like', '%'. $request['name'] . '%');
        }
        if (!is_null($request['email'])) {
            $query->where('email', 'like', '%'. $request['email'] . '%');
        }
        if (!is_null($request['birthday'])) {
            $query->where('birthday', $request['birthday']);
        }
        if (!is_null($request['phone'])) {
            $query->where('phone', $request['phone']);
        }
        if (!is_null($request['address'])) {
            $query->where('address', 'like', '%'. $request['address'] . '%');
        }
        if (!is_null($request['isMale'])) {
            $query->where('isMale', $request['isMale']);
        }
        $people = $query->paginate($request['limit'] ?? 10);
        if (is_null($people['data'])) {
            return response()->json([
                'message' => 'No person found'
            ], 404);
        }
        return $people;
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
        $person = Person::find($id);
        if (is_null($person)) {
            return response()->json([
                'message' => 'Person not found'
            ], 404);
        }
        return $person;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
    }
}
