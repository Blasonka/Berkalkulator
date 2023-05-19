<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftCreationRequest as CreationRequest;
use App\Http\Requests\ShiftUpdateRequest as UpdateRequest;
use App\Models\Shift;
use Carbon\Carbon;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json(Shift::all(), 200);
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
            if ($request->doublepay == 'on') {
                $hourly_wage = 2 * $request->hourly_wage;
            } else {
                $hourly_wage = $request->hourly_wage;
            }

            $start_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->start_time);
            $end_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->end_time);

            // Az este 6 óra időpontját a Carbon függvények segítségével létrehozzuk
            $evening_start = Carbon::createFromTime(18, 0, 0);

            // Ellenőrizzük, hogy a start_time este 6 óra után van-e
            if ($start_time->greaterThanOrEqualTo($evening_start) || $end_time->greaterThan($evening_start)) {

                if ($start_time->greaterThanOrEqualTo($evening_start)) {
                    // Számoljuk ki a munkaidőt a kezdő- és végidő között
                    $worked_hours = $start_time->diffInSeconds($end_time) * 1.3;
                } else {
                    $worked_hours = $start_time->diffInSeconds($evening_start);
                    $worked_hours += $evening_start->diffInSeconds($end_time) * 1.3;
                }
            } else {
                // Ha a start_time este 6 óra előtt van, akkor nincs bérpótlék
                $worked_hours = $end_time->diffInSeconds($start_time);
            }

            // A dolgozott órák számát századokra kerekítjük és tároljuk
            $worked_hours = $worked_hours / 3600;
            $worked_hours = round($worked_hours, 3);

            $shift = Shift::create([
                'user_id' => $request->user_id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'hourly_wage' => $hourly_wage,
                'worked_hours' => $worked_hours,
            ]);
            return response()->json(['message' => 'Shift created successfully'], 201);
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
            $shift = Shift::find($id);
            if ($shift->exists()) {
                return response()->json($shift, 200);
            } else {
                return response()->json(['message' => 'Shift not found, id: ' . $id], 404);
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
            $shift = Shift::find($id);
            if ($shift->exists()) {
                if ($request->doublepay == 'on') {
                    $hourly_wage = 2 * $request->hourly_wage;
                } else {
                    $hourly_wage = $request->hourly_wage;
                }

                $start_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->start_time);
                $end_time = Carbon::createFromFormat('Y-m-d H:i', $request->date . $request->end_time);

                // Az este 6 óra időpontját a Carbon függvények segítségével létrehozzuk
                $evening_start = Carbon::createFromTime(18, 0, 0);

                // Ellenőrizzük, hogy a start_time este 6 óra után van-e
                if ($start_time->greaterThanOrEqualTo($evening_start) || $end_time->greaterThan($evening_start)) {

                    if ($start_time->greaterThanOrEqualTo($evening_start)) {
                        // Számoljuk ki a munkaidőt a kezdő- és végidő között
                        $worked_hours = $start_time->diffInSeconds($end_time) * 1.3;
                    } else {
                        $worked_hours = $start_time->diffInSeconds($evening_start);
                        $worked_hours += $evening_start->diffInSeconds($end_time) * 1.3;
                    }
                } else {
                    // Ha a start_time este 6 óra előtt van, akkor nincs bérpótlék
                    $worked_hours = $end_time->diffInSeconds($start_time);
                }

                // A dolgozott órák számát századokra kerekítjük és tároljuk
                $worked_hours = $worked_hours / 3600;
                $worked_hours = round($worked_hours, 3);

                $shift = Shift::updated([
                    'user_id' => $request->user_id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'hourly_wage' => $hourly_wage,
                    'worked_hours' => $worked_hours,
                ]);
                return response()->json(['message' => 'Shift updated successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Shift not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error', $th], 400);
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
            $shift = Shift::find($id);
            if ($shift->exists()) {
                $shift->delete();
                return response()->json(['message' => 'Shift deleted successfully, id: ' . $id], 200);
            } else {
                return response()->json(['message' => 'Shift not found, id: ' . $id], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Database error.'], 400);
        }
    }
}
