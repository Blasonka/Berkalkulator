<?php

namespace App\Http\Controllers;

use App\Http\Requests\WageRequest;
use App\Models\Wage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(WageRequest $request)
    {
        $wage = Wage::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name_wage,
            'value' => $request->value
        ]);
        return redirect()->back()->with('message_wage', 'Órabér sikeresen mentve.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WageRequest $request, $id)
    {
        $shift = Wage::find($id);
        $shift->update([
            'name' => $request->name_wage,
            'value' => $request->value
        ]);

        return redirect()->back()->with('message_wage', 'Az órabér sikeresen frissítve lett.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Wage::destroy($id);
            return redirect()->back()->with('message_wage', 'Órabér sikeresen törölve lett.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message_wage', 'Hiba, az órabért nem tudtuk törölin.');
        }
    }
}
