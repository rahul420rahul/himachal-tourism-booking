@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Welcome to Dashboard</h1>
    <div class="bg-white rounded-lg shadow p-6">
        <p>You are logged in!</p>
        <a href="{{ route('packages.index') }}" class="text-blue-600 hover:underline">View Packages</a>
    </div>
</div>
@endsection
