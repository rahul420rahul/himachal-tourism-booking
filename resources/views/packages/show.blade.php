@extends('layouts.app')
@section('content')
<div class="bg-white">
    <!-- Video Section with optimized sources -->
    <video autoplay loop muted playsinline preload="none" poster="{{ asset('storage/hero-poster.jpg') }}">
        <source src="{{ asset('storage/hero.webm') }}" type="video/webm">
        <source src="{{ asset('storage/hero-mobile.mp4') }}" type="video/mp4" media="(max-width: 768px)">
        <source src="{{ asset('storage/hero-desktop.mp4') }}" type="video/mp4">
    </video>
    
    <!-- Gallery with WebP and lazy loading -->
    @for ($i = 1; $i <= 16; $i++)
    <picture>
        <source type="image/webp" data-srcset="{{ asset('storage/p'.$i.'.webp') }}">
        <img class="lazyload blur-up" src="{{ asset('storage/p'.$i.'-tiny.jpg') }}" 
             data-src="{{ asset('storage/p'.$i.'.jpg') }}" alt="Gallery {{$i}}">
    </picture>
    @endfor
</div>

@push('styles')
<style>
.blur-up { filter: blur(5px); transition: filter 400ms; }
.blur-up.lazyloaded { filter: blur(0); }
</style>
@endpush
@endsection
