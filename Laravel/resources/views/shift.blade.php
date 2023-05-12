@extends('layouts.app')

@section('content')
    {{-- Havi leosztás --}}
    <div class="container">
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
                                    <td>{{ $month->monthly_pay }} FT</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Napi leosztás --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Beosztás</h2>
            </div>
        </div>
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
                        <tbody>
                            @foreach ($shifts as $shift)
                                <tr>
                                    <th scope="row">{{ $shift->date }}</th>
                                    <td>{{ $shift->start_time }}</td>
                                    <td>{{ $shift->end_time }}</td>
                                    <td>{{ $shift->worked_hours }} óra</td>
                                    <td>{{ $shift->hourly_wage }} Ft</td>
                                    <td><a href="" class="btn btn-primary">Szerkesztés</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
