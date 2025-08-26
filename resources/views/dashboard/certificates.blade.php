@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">My Certificates</h1>
    @if($certificates && count($certificates) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($certificates as $cert)
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-bold">{{ $cert->title }}</h3>
                <p class="text-sm text-gray-600">{{ $cert->description }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ $cert->issued_date }}</p>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No certificates earned yet. Keep flying!</p>
    @endif
</div>
@endsection
