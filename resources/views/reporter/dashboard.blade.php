@extends('reporter.layout.app')

@section('content')
    <div class="container">
        <h2>Reporter Dashboard</h2>
        <p>Welcome, {{ auth('reporter')->user()->name }}!</p>
    </div>
@endsection
