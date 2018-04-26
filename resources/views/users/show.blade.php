@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>{{ $user->name }}</h2>

            <table class="table">
                <tr>
                    <td>Alter:</td>
                    <td>{{ $user->age }} <small>({{ $user->birthdate->format('d.m.Y')  }})</small></td>
                </tr>
                <tr>
                    <td>Größe:</td>
                    <td>{{ $user->height }} cm</td>
                </tr>
                <tr>
                    <td>Geschlecht:</td>
                    <td>{{ $user->gender === 'male' ? 'Männlich' : 'Weiblich' }}</td>
                </tr>
                <tr>
                    <td>Gewicht:</td>
                    <td>{{ $user->currentWeight }} kg</td>
                </tr>
            </table>
        </div>
    </div>

@endsection