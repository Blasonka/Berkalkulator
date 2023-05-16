@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1 class="text-center display-3 mb-3">Beosztás hozzáadása</h1>
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
                            <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" required
                                pattern="\d{4}-\d{2}-\d{2}" max="{{ date('Y-m-d') }}" />
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="start_time" class="form-label">Munka kezdete</label>
                        <div class="mx-auto">
                            <input type="time" id="start_time" name="start_time" min="00:00" max="23:59" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <label for="end_time" class="form-label">Munka vége</label>
                        <div class="mx-auto">
                            <input type="time" id="end_time" name="end_time" min="00:00" max="23:59" required>
                        </div>
                    </div>
                    <div class="row col-lg-10 mb-3 mx-auto">
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Órabér</label>
                            <select id="inputState" class="form-select">
                                <option selected>Egyéni összeg:</option>
                                @foreach ($wages as $wage)
                                    <option><a href="#hourly_wage">{{ $wage->name }} - {{ $wage->value }}</a></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-auto mt-3">
                            <input type="number" id="hourly_wage" name="hourly_wage" min="1000" max="10000"
                                value="{{ $wage->value }}" required>
                            <span style="margin-left:10px;">Ft</span>
                        </div>
                    </div>











                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list"
                                    data-bs-toggle="list" href="#list-home" role="tab"
                                    aria-controls="list-home">Home</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list"
                                    data-bs-toggle="list" href="#list-profile" role="tab"
                                    aria-controls="list-profile">Profile</a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list"
                                    data-bs-toggle="list" href="#list-messages" role="tab"
                                    aria-controls="list-messages">Messages</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list"
                                    data-bs-toggle="list" href="#list-settings" role="tab"
                                    aria-controls="list-settings">Settings</a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                                    aria-labelledby="list-home-list">1</div>
                                <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                    aria-labelledby="list-profile-list">2</div>
                                <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                    aria-labelledby="list-messages-list">3</div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                    aria-labelledby="list-settings-list">4</div>
                            </div>
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
