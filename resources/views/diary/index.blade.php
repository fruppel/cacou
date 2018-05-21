@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
    <div class="container">
        <date-nav date="{{ $date }}"></date-nav>
    </div>
@endsection