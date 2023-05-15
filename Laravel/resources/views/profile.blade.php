@extends('layouts.app')

@section('content')
    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3 mb-3"
        data-bs-theme="dark">

        {{-- Messages --}}
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        {{-- Udate general account information --}}
        <form method="POST" action="{{ route('update_profile') }}" class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
            @method('PUT')
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

    {{-- Udate account password --}}
    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3 mb-3"
        data-bs-theme="dark">
        <form method="POST" action="{{ route('update_password') }}" class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
            @method('PUT')
            @csrf
            <h3>Jelszó frissítése</h3>
            <p>
                Győződjön meg róla, hogy fiókja hosszú, véletlenszerű jelszót használ, hogy biztonságban maradjon.
            </p>
            <div class="mb-3">
                <label for="current_password" class="form-label">Jelenlegi jelszó</label>
                @if ($errors->has('current_password'))
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first('current_password') }}
                    </div>
                @endif
                <input type="password" class="form-control" id="current_password" name="current_password"
                    autocomplete="current-password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Új jelszó</label>
                @if ($errors->has('new_password'))
                    <div class="alert alert-danger d-flex align-items-center">
                        {{ $errors->first('new_password') }}
                    </div>
                @endif
                <input type="password" class="form-control" id="new_password" name="new_password"
                    autocomplete="new-password" required>
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Új jelszó megerősítése</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                    required>
            </div>
            <button type="submit" class="btn btn-light">Mentés</button>
        </form>
    </div>

    {{-- Delete account --}}
    <div class="container text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 py-3"
        data-bs-theme="dark">
        <form method="POST" action="{{ route('delete_profile') }}" class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
            @method('DELETE')
            @csrf
            <h3>Fiók törlése</h3>
            <p>
                A fiók törlése után a fiók minden erőforrása és adata véglegesen törlődik. Mielőtt törli fiókját,
                kérjük,
                töltse le azokat az adatokat vagy információkat, amelyeket meg kíván tartani.
            </p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProfile">
                Fiók törlése
            </button>

            <!-- Modal -->
            <div class="modal fade" id="deleteProfile" tabindex="-1" aria-labelledby="deleteProfileLabel"
                aria-hidden="true" data-bs-theme="dark">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteProfileLabel">Fiók törlése</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h3>Biztosan szeretné véglet törölni fiókját?</h3>
                        </div>
                        <div class="modal-body">
                            A fiók törlése után a fiók minden erőforrása és adata véglegesen törlődik. Mielőtt törli
                            fiókját,
                            kérjük,
                            töltse le azokat az adatokat vagy információkat, amelyeket meg kíván tartani.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                            <button type="submit" class="btn btn-danger">Törlés</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
