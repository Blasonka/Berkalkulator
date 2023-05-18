@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Regisztráció</h1>
        </div>

        {{-- REGISTRATION FORM --}}
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- NAME INPUT --}}
                    <div class="row col-lg-10 mx-auto">
                        <label for="name" class="form-label">Név</label>
                        <div class="mx-auto mb-3">
                            <input type="text" class="form-control mb-3" id="name" name="name" required>

                            {{-- NAME ERROR MESSAGES --}}
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('name') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- EMAIL INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="email" class="form-label">Email</label>
                        <div class="mx-auto">
                            <input type="email" class="form-control mb-3 danger" id="email" name="email" required>

                            {{-- EMAIL ERROR MESSAGES --}}
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('email') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- PW INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="password" class="form-label">Jelszó</label>
                        <div class="mx-auto">
                            <input type="password" class="form-control mb-3" id="password" name="password" required>

                            {{-- PW ERROR MESSAGES --}}
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('password') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- PW CONFIRMATION INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
                        <div class="mx-auto">
                            <input type="password" class="form-control mb-3" id="password_confirmation"
                                name="password_confirmation" required>

                                {{-- PW CONFIRMATION ERROR MESSAGES --}}
                            @if ($errors->has('password_confirmation'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('password_confirmation') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- REGISTRATION BUTTON --}}
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
