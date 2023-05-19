<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest as CreationRequest;
use App\Http\Requests\UserUpdateRequest as UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(User::all(), 200);
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
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json($user, 201);
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
            $shift = User::find($id);
            if ($shift->exists()) {
                return response()->json($shift, 200);
            } else {
                return response()->json(['message' => 'User not found, id: ' . $id], 404);
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
            $shift = User::find($id);
            if ($shift->exists()) {
                $shift->update($request->all());
                return response()->json(['message' => 'User updated successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'User not found, id: ' . $id], 404);
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
            $shift = User::find($id);
            if ($shift->exists()) {
                $shift->delete();
                return response()->json(['message' => 'User deleted successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'User not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error.'], 400);
        }
    }
}
