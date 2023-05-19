@extends('layouts.app')

@section('content')
    {{-- MONTLY TABLE --}}
    <div class="container">

        {{-- Messages --}}
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Összesen</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Dátum</th>
                                <th>Dolgozott órák</th>
                                <th>Várható fizetés</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($months as $month)
                                <tr>
                                    <th scope="row">{{ $month->year }}. {{ $month->month }}</th>
                                    <td>{{ $month->total_hours }} óra</td>
                                    <td>{{ number_format($month->monthly_pay, 0, '.', '.') }} FT</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DAILY TABLE --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Beosztás</h2>
            </div>
        </div>

        {{-- TABLE HEADER --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Dátum</th>
                                <th>Kezdés</th>
                                <th>Befejezés</th>
                                <th>Dolgozott órák</th>
                                <th>Órabér</th>
                                <th></th>
                            </tr>
                        </thead>

                        TABLE BODY
                        <tbody>
                            @foreach ($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->date }}</th>
                                    <td>{{ $shift->start_time }}</td>
                                    <td>{{ $shift->end_time }}</td>
                                    <td>{{ $shift->worked_hours }} óra</td>
                                    <td>{{ number_format($shift->hourly_wage, 0, '.', '.') }} Ft</td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="{{ $shift->id }}" disabled>
                                            Szerkesztés</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $shift->id }}">
                                            🗑️
                                        </button>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                @if ($shifts->count() > 0)
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-theme="dark">
                                        <div class="modal-dialog">
                                            <form action="{{ route('delete_shift', $shift->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteProfileLabel">Beosztás
                                                            törlése</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Biztosan szeretné törölni az alábbi beosztást?</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li scope="row">Dátum: {{ $shift->date }}</li>
                                                            <li>Kezdés: {{ $shift->start_time }}</li>
                                                            <li>Befejezés: {{ $shift->end_time }}</li>
                                                            <li>dolgozott órák: {{ $shift->worked_hours }} óra</li>
                                                            <li>Órabér: {{ $shift->hourly_wage }} Ft</li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Mégsem</button>
                                                        <button type="submit" class="btn btn-danger">Törlés</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <!-- Edit Modal -->
                                @if ($shifts->count() > 0)
                                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                        aria-hidden="true" data-bs-theme="dark">
                                        <div class="modal-dialog">
                                            <form action="{{ route('update_shift', $shift->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteProfileLabel">Beosztás
                                                            szerkesztése
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row col-lg-10 mb-3 mx-auto">
                                                            <label for="date" class="form-label">Munkanap:</label>
                                                            <div class="mx-auto">
                                                                <input type="date" id="date" name="date"
                                                                    value="{{ date('Y-m-d', strtotime($shift->start_time)) }}"
                                                                    required pattern="\d{4}-\d{2}-\d{2}"
                                                                    max="{{ date('Y-m-d') }}" />
                                                            </div>
                                                        </div>
                                                        <div class="row col-lg-10 mb-3 mx-auto">
                                                            <label for="start_time" class="form-label">Munka kezdete</label>
                                                            <div class="mx-auto">
                                                                <input type="time" id="start_time" name="start_time"
                                                                    min="00:00" max="23:59" required
                                                                    value="{{ $shift->start_time }}">
                                                            </div>
                                                        </div>
                                                        <div class="row col-lg-10 mb-3 mx-auto">
                                                            <label for="end_time" class="form-label">Munka vége</label>
                                                            <div class="mx-auto">
                                                                <input type="time" id="end_time" name="end_time"
                                                                    min="00:00" max="23:59" required
                                                                    value="{{ $shift->end_time }}">
                                                            </div>
                                                        </div>
                                                        <div class="row col-lg-10 mb-3 mx-auto">
                                                            <label for="hourly_wage" class="form-label">Órabér</label>
                                                            <div class="mx-auto">
                                                                <input type="number" id="hourly_wage" name="hourly_wage"
                                                                    min="1000" max="10000"
                                                                    value="{{ $shift->hourly_wage }}" required>
                                                                <span style="margin-left:10px;">Ft</span>
                                                            </div>
                                                        </div>
                                                        <div class="row col-lg-10 mb-3 mx-auto">
                                                            <div class="mx-auto">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="doublepay" name="doublepay">
                                                                    <label class="form-check-label" for="doublepay">
                                                                        Ünnepnap (dupla órabér)
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Mégsem</button>
                                                        <button type="submit" class="btn btn-primary">Mentés</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
