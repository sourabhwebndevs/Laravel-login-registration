@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>
    <p>Name: {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>
</div>
@endsection
