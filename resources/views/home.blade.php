@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Auth::user()->rol === 1)
            <div class="panel panel-default">
                <div class="panel-heading">Admin pannel</div>

                <div class="panel-body">
                    <h2>Gewerkte uren</h2>
                    <table class="table">
                        <tr>
                            <th>naam</th>
                            <th>email</th>
                            <th>startdatum</th>
                            <th>ingevoerd</th>
                            <th>uren</th>
                        </tr>

                        @foreach ($uur as $u)
                        <tr><td>{{ $u->Touser->voornaam . ' ' . $u->Touser->achternaam }}</td>
                            <td>{{ $u->Touser->email }}</td>
                            <td>{{ $u->startDatum }}</td> 
                            <td>{{ $u->eindDatum }}</td>
                            <td>{{ Carbon\Carbon::parse($u['eindDatum'])->format('H') - Carbon\Carbon::parse($u['startDatum'])->format('H') }}</td>
                        </tr>
                        @endforeach
                    
                    </table>
                </div>
            </div>
            @else
            <div class="panel panel-default">
                <div class="panel-heading">User pannel</div>

                <div class="panel-body">
                    @if (Auth::user()->ingechecked === 0)
                        {!! Form::open(['url' => 'start']) !!}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <button class="btn btn-primary">Check in</button>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['url' => 'eind']) !!}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <button class="btn btn-primary">Check uit</button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
