<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->doublepay == 'on'){
            $hourly_wage = 2 * $request->hourly_wage;
        } else {
            $hourly_wage = $request->hourly_wage;
        }

        $shift = Shift::create([
            'user_id' => Auth::user()->id,
            'start_time' => Carbon::createFromFormat('Y-m-d H:i', $request->date.$request->start_time),
            'end_time' => Carbon::createFromFormat('Y-m-d H:i', $request->date.$request->end_time),
            'hourly_wage' => $hourly_wage
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
