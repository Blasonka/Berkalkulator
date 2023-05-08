@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Bejelentkezés</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">
                <form>
                    @csrf
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="email" class="form-label">Email</label>
                        <div class="mx-auto">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="password" class="form-label">Jelszó</label>
                        <div class="mx-auto">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
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
