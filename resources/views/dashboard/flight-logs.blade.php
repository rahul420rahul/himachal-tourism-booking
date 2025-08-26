@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">My Flight Logs</h1>
                <a href="{{ route('dashboard.flight-logs.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Flight
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($flightLogs && $flightLogs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Site</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Launch</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Landing</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Max Alt</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Distance</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($flightLogs as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->site_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->launch_time->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->landing_time->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->flight_duration }} min</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->max_altitude }} m</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $log->distance }} km</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($log->is_verified)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Verified
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('dashboard.flight-logs.edit', $log) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <span class="mx-1">|</span>
                                        <form action="{{ route('dashboard.flight-logs.destroy', $log) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $flightLogs->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <p class="mt-2 text-gray-600">No flight logs found.</p>
                    <p class="text-sm text-gray-500">Start by adding your first flight!</p>
                    <a href="{{ route('dashboard.flight-logs.create') }}" 
                       class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Add Your First Flight
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
