@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <div class="mb-3">
            <label>Site Name</label>
            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? config('app.name')) }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
