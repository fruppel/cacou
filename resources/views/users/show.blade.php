@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>{{ $user->name }}</h2>

            <table class="table">
                <tr>
                    <td>Alter:</td>
                    <td>{{ $user->age }}</td>
                </tr>
                <tr>
                    <td>Größe:</td>
                    <td>{{ $user->height }} cm</td>
                </tr>
            </table>
        </div>
    </div>

@endsection