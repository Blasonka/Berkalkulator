@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center">
                {{-- <div class="table-wrap">
                    <table class="table table-striped table-wrap">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                style="padding-right: 6rem">
                                <span>Kezdés</span>
                                <span>Befelyezés</span>
                                <span>Dolgozott órák</span>
                                <span>Órabér</span>
                                <span></span>
                            </li>
                            @foreach ($shifts as $shift)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $shift->start_time }}</span>
                                    <span>{{ $shift->end_time }}</span>
                                    <span>{{ $shift->worked_hours }}</span>
                                    <span>{{ $shift->hourly_wage }}</span>
                                    <span><a href="" class="btn btn-primary">Szerkesztés</a></span>
                                </li>
                            @endforeach
                        </ul>
                    </table>
                </div> --}}



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
                                            <th>Befelyezés</th>
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
            </div>
        </div>
    </div>
@endsection
