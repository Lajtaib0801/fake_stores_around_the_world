<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Person::query();

        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        if ($request->query('email')) {
            $query->where('email', 'like', '%' . $request->query('email') . '%');
        }

        if ($request->query('birthday')) {
            $query->where('birthday', $request->query('birthday'));
        }

        if ($request->query('phone')) {
            $query->where('phone', $request->query('phone'));
        }

        if ($request->query('address')) {
            $query->where('address', 'like', '%' . $request->query('address') . '%');
        }

        if ($request->query('isMale')) {
            $query->where('isMale', $request->query('isMale'));
        }

        $people = $query->paginate($request->query('limit', 10));

        if ($people->isEmpty()) {
            return response()->json([
                'message' => 'No person found'
            ], Response::HTTP_NOT_FOUND);
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
            ], Response::HTTP_NOT_FOUND);
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
