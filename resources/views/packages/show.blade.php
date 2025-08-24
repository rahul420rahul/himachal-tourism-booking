@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="relative h-96 bg-gradient-to-r from-blue-600 to-green-500">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="container mx-auto px-4 h-full flex items-center relative z-10">
            <div class="text-white">
                <nav class="text-sm mb-4">
                    <a href="/" class="hover:underline">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/packages" class="hover:underline">Packages</a>
                    <span class="mx-2">/</span>
                    <span>{{ $package->name }}</span>
                </nav>
                <h1 class="text-4xl font-bold mb-4">{{ $package->name }}</h1>
                <p class="text-xl opacity-90 max-w-2xl">{{ $package->description }}</p>
            </div>
        </div>
    </div>

    {{-- Dynamic Package Content --}}
    @includeIf('packages.partials.' . $package->slug)

    {{-- Common Booking Form --}}
    @include('packages.partials.booking-form')
</div>
@endsection
