@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Create Booking (React Version)</h1>
        <div id="booking-widget"></div>
    </div>
</div>
@endsection

@push('scripts')
<script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
<script>
window.laravelData = {
    packages: @json($packages ?? [])
};

const { useState, useEffect } = React;
function BookingWidget() {
    const [packages, setPackages] = useState(window.laravelData.packages || []);
    
    return React.createElement('div', {className: 'bg-white p-6 rounded-lg shadow'},
        React.createElement('h2', {className: 'text-2xl font-bold mb-4'}, '✅ React Working!'),
        React.createElement('p', null, `Found ${packages.length} packages`),
        packages.map(pkg => 
            React.createElement('div', {key: pkg.id, className: 'border p-3 mt-2'},
                React.createElement('h3', {className: 'font-bold'}, pkg.name),
                React.createElement('p', null, `₹${pkg.price} - ${pkg.duration}`)
            )
        )
    );
}

ReactDOM.createRoot(document.getElementById('booking-widget')).render(React.createElement(BookingWidget));
</script>
@endpush
