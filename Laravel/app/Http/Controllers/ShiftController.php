<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function store(ShiftRequest $request)
    {
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
            'user_id' => Auth::user()->id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'hourly_wage' => $hourly_wage,
            'worked_hours' => $worked_hours,
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
    public function update(ShiftRequest $request, $id)
    {
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

        $shift = Shift::where('id', $id);
        $shift->update([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'hourly_wage' => $hourly_wage,
            'worked_hours' => $worked_hours,
        ]);

        return redirect()->back()->with('message', 'A műszak sikeresen frissítve lett.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shift::destroy($id);
        return redirect()->back()->with('message', 'A műszak sikeresen törölve lett.');
    }

    public function show_page()
    {
        $shifts = DB::table('shifts')
            ->select(
                'id',
                'worked_hours',
                'hourly_wage',
                DB::raw("DATE_FORMAT(start_time, '%Y. %m. %d.') AS date"),
                DB::raw("DATE_FORMAT(start_time, '%H:%i') AS start_time"),
                DB::raw("DATE_FORMAT(end_time, '%H:%i') AS end_time")
            )
            ->where('user_id', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->get();

        $months = DB::table('shifts')
            ->select(DB::raw('YEAR(start_time) as year, MONTH(start_time) as month, SUM(worked_hours) as total_hours'), DB::raw('ROUND(SUM(worked_hours * hourly_wage)) as monthly_pay'))
            ->where('user_id', Auth::user()->id)
            ->groupBy(DB::raw('YEAR(start_time), MONTH(start_time)'))
            ->get();

        return view('shift', ['shifts' => $shifts, 'months' => $months]);
    }

    public function show_calculator()
    {
        $wages = DB::table('wages')
            ->select(
                'id',
                'name',
                'value',
            )
            ->where('user_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();
        return view('calculator', ['wages' => $wages]);
    }
}
