<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect(route('home'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user and Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect(route('home'));
        } else {
            return redirect(route('login'))->withErrors('Hibás email cím vagy jelszó');
        }
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->hourly_wage = $request->hourly_wage;

        $user->save();

        return redirect()->back()->with('message', 'A fiókja sikeresen frissítve lett.');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A jelenlegi jelszó nem helyes.'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('message', 'A jelszó sikeresen frissítve lett.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();

        return redirect()->route('login')->with('message', 'A fiókod sikeresen törölve lett.');
    }
}
