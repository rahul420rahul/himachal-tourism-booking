@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div id="react-booking-root"></div>
</div>
@endsection

@push('scripts')
    <script>
        // Pass package ID from Laravel to React
        window.selectedPackageId = {{ request()->route('id') ?? 'null' }};
        console.log('Package ID:', window.selectedPackageId);
    </script>
    @vite(['resources/js/app.js'])
@endpush
