@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Beosztás hozzáadása</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-auto col-sm-12 bg-blur-login">

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- ADD SHIFT FORM --}}
                <form method="POST" action="{{ route('shift') }}">
                    @csrf

                    {{-- DATE INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="date" class="form-label">Munkanap:</label>
                        <div class="mx-auto">
                            <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" required
                                pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" />
                        </div>
                    </div>

                    {{-- START TIME INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="start_time" class="form-label">Munka kezdete</label>
                        <div class="mx-auto">
                            <input type="time" id="start_time" name="start_time" min="00:00" max="23:59" required>
                        </div>
                    </div>

                    {{-- END TIME INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="end_time" class="form-label">Munka vége</label>
                        <div class="mx-auto">
                            <input type="time" id="end_time" name="end_time" min="00:00" max="23:59" required>
                        </div>
                    </div>

                    {{-- HOURLY WAGE INPUT --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Órabér</label>
                            <select id="inputState" class="form-select" onchange="toggleCustomValue(this)">
                                <option id="egyeni" value="egyeni" selected>Egyéni összeg:</option>
                                @foreach ($wages as $wage)
                                    <option value="{{ $wage->value }}">{{ $wage->name }} - {{ $wage->value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-auto mt-3">
                            <input type="number" name="hourly_wage" id="hourly_wage" min="1000" max="10000"
                                required>
                            <span style="margin-left:10px;">Ft</span>
                        </div>
                    </div>

                    {{-- HOLIDAY CHECKBOX --}}
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

                    {{-- SAVE BUTTON --}}
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-primary">Mentés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DYNAMIC HOURLY WAGE DROPDOWN --}}
    <script>
        function toggleCustomValue(selectElement) {
            var inputElement = document.getElementById('egyeni');
            var hourlyWageInput = document.getElementById('hourly_wage');
            var kiiras = document.getElementById('kiiras');

            if (selectElement.value === 'egyeni') {
                hourlyWageInput.readOnly = false;
                hourlyWageInput.value = "";
            } else {
                hourlyWageInput.readOnly = true;
                hourlyWageInput.value = selectElement.value;
            }
        }
    </script>
@endsection
