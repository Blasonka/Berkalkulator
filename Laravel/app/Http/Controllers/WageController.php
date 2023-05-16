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
}
