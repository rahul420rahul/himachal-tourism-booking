@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(Auth::user()->role === 'admin')
        @include('dashboard.admin')
    @else
        @include('dashboard.user')
    @endif
</div>
@endsection
