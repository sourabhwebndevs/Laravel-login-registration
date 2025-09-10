@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p>{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Total Admins</h5>
                    <p>{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
