@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Regisztráció</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="name" class="form-label">Név</label>
                        <div class="mx-auto">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
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
                        <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
                        <div class="mx-auto">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary">Regisztráció</button>
                            <a href="{{ route('login') }}" class="mx-3">Már regisztrálva vagy?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
