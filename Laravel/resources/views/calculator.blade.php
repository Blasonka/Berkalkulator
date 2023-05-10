@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Bejelentkezés</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('shift') }}">
                    @csrf
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="date" class="form-label">Munkanap:</label>
                        <div class="mx-auto">
                            <input type="date" id="date" name="date" required pattern="\d{4}-\d{2}-\d{2}" />
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="start_time" class="form-label">Műszak kezdete</label>
                        <div class="mx-auto">
                            <input type="time" id="start_time" name="start_time" min="00:00" max="23:59" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="end_time" class="form-label">Műszak vége</label>
                        <div class="mx-auto">
                            <input type="time" id="end_time" name="end_time" min="00:00" max="23:59" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="hourly_wage" class="form-label">Órabér</label>
                        <div class="mx-auto">
                            <input type="number" id="hourly_wage" name="hourly_wage" min="1000" max="10000" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="doublepay" name="doublepay">
                                <label class="form-check-label" for="doublepay">
                                    Ünnepnap (dupla órabér)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary">Mentés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
