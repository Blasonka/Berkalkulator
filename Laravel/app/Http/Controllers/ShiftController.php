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
        if ($request->doublepay == 'on') {
            $hourly_wage = 2 * $request->hourly_wage;
        } else {
            $hourly_wage = $request->hourly_wage;
        }

        $start_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->start_time);
        $end_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->end_time);
        //$worked_hours = $end_time->diffInHours($start_time);

        // Ha a kezdő- és végdátum különböző napra esik, akkor a napok számát is figyelembe kell venni
        if ($start_time->diffInDays($end_time) > 0) {
            $worked_hours = $start_time->copy()->endOfDay()->diffInSeconds($start_time) / 3600; // Az első napon dolgozott órák száma
            $worked_hours += $end_time->copy()->startOfDay()->diffInSeconds($end_time) / 3600; // Az utolsó napon dolgozott órák száma
            $worked_hours += ($end_time->diffInDays($start_time) - 1) * 24; // A köztes napokon dolgozott órák száma
        } else {
            $worked_hours = $end_time->diffInSeconds($start_time) / 3600;
        }

        // A dolgozott órák számát századokra kerekítjük és tároljuk
        $worked_hours = round($worked_hours, 2);

        $shift = Shift::create([
            'user_id' => Auth::user()->id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'hourly_wage' => $hourly_wage,
            'worked_hours' => $worked_hours
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
