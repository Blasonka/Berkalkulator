@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Bejelentkezés</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">

                {{-- MESSAGES --}}
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- LOGIN FORM --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- EMAIL INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="email" class="form-label">Email</label>
                        <div class="mx-auto">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    {{-- PW INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="password" class="form-label">Jelszó</label>
                        <div class="mx-auto">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    {{-- REMEMBER CHECKBOX --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Emlékezzen rám
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                            <a href="{{ route('login') }}" class="mx-3">Elfelejtetted a jelszavad?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
