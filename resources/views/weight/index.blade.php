@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row mb-5">
            <div class="col-12">
                <weight-chart></weight-chart>
            </div>
        </div>

        <div class="row flex-md-row-reverse">
            <div class="col-md-4">
                <form method="POST" action="/weight/{{ auth()->id() }}">
                    @csrf
                    <div class="form-group">
                        <label for="created_at">Datum:</label>
                        <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}">
                    </div>
                    <div class="form-group">
                        <label for="weight">Gewicht (kg):</label>
                        <input type="number" step="0.1" name="weight" id="weight" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Hinzufügen</button>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <weight-table :weights="{{ json_encode($weights) }}"></weight-table>
            </div>
        </div>
    </div>
@endsection