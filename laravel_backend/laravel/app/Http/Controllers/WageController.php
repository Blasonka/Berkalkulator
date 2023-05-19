<?php

namespace App\Http\Controllers;

use App\Http\Requests\WageCreationRequest as CreationRequest;
use App\Http\Requests\WageUpdateRequest as UpdateRequest;
use App\Models\Wage;
use Illuminate\Http\Request;

class WageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(Wage::all(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreationRequest $request)
    {
        try {
            Wage::create([
                'user_id' => $request->user_id,
                'name' => $request->name_wage,
                'value' => $request->value
            ]);
            return response()->json(['message' => 'Wage created successfully'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $wage = Wage::find($id);
            if ($wage->exists()) {
                return response()->json($wage, 200);
            } else {
                return response()->json(['message' => 'Wage not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $shift = Wage::find($id);
            if ($shift->exists()) {
                $shift->update($request->all());
                return response()->json(['message' => 'Wage updated successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Wage not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $shift = Wage::find($id);
            if ($shift->exists()) {
                $shift->delete();
                return response()->json(['message' => 'Wage deleted successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Wage not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error.'], 400);
        }
    }
}
