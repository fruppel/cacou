@extends('layouts.app')

@section('content')

    <div class="container">
        <weight-chart></weight-chart>

        <form method="POST" action="/weight/{{ auth()->id() }}">
            @csrf
            <div class="form-row align-items-end">
                <div class="form-group col-md-5">
                    <label for="created_at">Datum:</label>
                    <input type="datetime-local" name="created_at" id="created_at" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}">
                </div>
                <div class="form-group col-md-5">
                    <label for="weight">Gewicht (kg):</label>
                    <input type="number" step="0.1" name="weight" id="weight" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <button class="btn btn-primary btn-block">Hinzufügen</button>
                </div>
            </div>
        </form>

        <table class="table">
            <tr>
                <th>Datum</th>
                <th>Gewicht</th>
                <th>Aktionen</th>
            </tr>
            @foreach ($weights as $weight)
                <tr>
                    <td>{{ $weight->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ number_format($weight->weight, 1, ',', '') }} kg</td>
                    <td><i class="far fa-trash-alt"></i></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection