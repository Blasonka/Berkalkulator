@extends('layouts.app')

@section('content')
    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3 mb-3"
        data-bs-theme="dark">
        <form method="POST" action="{{ route('update_profile') }}" class="col-xxl-6 col-xl-7 col-lg-8 col-md-9" method="POST">
            @csrf
            <h3>Profil információk</h3>
            <p>
                Frissítse fiókja adatait és e-mail címét.
            </p>
            <div class="mb-3">
                <label for="name" class="form-label">Név</label>
                @if ($errors->has('name'))
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email cím</label>
                @if ($errors->has('email'))
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <input type="email" class="form-control" id="email" name="email" autocomplete="username"
                    value="{{ Auth::user()->email }}" required>
            </div>
            <div class="mb-3">
                <label for="hourly_wage" class="form-label">Órabér</label>
                @if ($errors->has('hourly_wage'))
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first('hourly_wage') }}
                    </div>
                @endif
                <input type="number" class="form-control" id="hourly_wage" name="hourly_wage" autocomplete="hourly_wage"
                    value="{{ Auth::user()->hourly_wage }}">
            </div>
            <button type="submit" class="btn btn-light">Mentés</button>
        </form>
    </div>

    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3 mb-3"
        data-bs-theme="dark">
        <form class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
            @csrf
            <h3>Jelszó frissítése</h3>
            <p>
                Győződjön meg róla, hogy fiókja hosszú, véletlenszerű jelszót használ, hogy biztonságban maradjon.
            </p>
            <div class="mb-3">
                <label for="current_password" class="form-label">Jelenlegi jelszó</label>
                <input type="password" class="form-control" id="current_password" name="current_password"
                    autocomplete="current-password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Új jelszó</label>
                <input type="password" class="form-control" id="new_password" name="new_password"
                    autocomplete="new-password" required>
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Új jelszó megerősítése</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                    required>
            </div>
            <button type="submit" class="btn btn-light" disabled>Mentés</button>
        </form>
    </div>

    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3"
        data-bs-theme="dark">
        <form class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
            @csrf
            <h3>Fiók törlése</h3>
            <p>
                A fiók törlése után a fiók minden erőforrása és adata véglegesen törlődik. Mielőtt törli fiókját, kérjük,
                töltse le azokat az adatokat vagy információkat, amelyeket meg kíván tartani.
            </p>
            <button type="submit" class="btn btn-danger" disabled>Fiók törlése</button>
        </form>
    </div>
@endsection
