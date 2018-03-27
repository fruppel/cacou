@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="/weight/{{ auth()->id() }}" class="form-inline">
                @csrf

                <label for="weight" class="mr-1">Gewicht (kg):</label>
                <input type="number" step="0.1" name="weight" id="weight" class="form-control">

                <label for="created_at" class="mr-1 ml-2">Datum:</label>
                <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i:s') }}">

                <button class="btn btn-primary ml-2">Hinzufügen</button>
            </form>
        </div>
    </div>
@endsection