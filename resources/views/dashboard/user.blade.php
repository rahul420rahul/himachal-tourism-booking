@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600">Manage your paragliding journey</p>
        </div>

        <!-- Three Main Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- My Bookings Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">My Bookings</h2>
                    <a href="{{ route('bookings.my') }}" class="text-blue-600 text-sm hover:underline">View All</a>
                </div>
                
                <div class="space-y-3">
                    @if(isset($myBookings) && count($myBookings) > 0)
                        @foreach($myBookings as $booking)
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <p class="font-medium text-gray-800">{{ $booking->package->name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">
                                    @if($booking->booking_date)
                                        {{ $booking->booking_date->format('d M Y, h:i A') }}
                                    @else
                                        Date not set
                                    @endif
                                </p>
                                <span class="inline-block px-2 py-1 text-xs rounded-full mt-1 
                                    {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($booking->status ?? 'pending') }}
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">No bookings yet</p>
                        <a href="{{ route('packages.index') }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                            Book Your First Flight
                        </a>
                    @endif
                </div>
            </div>

            <!-- My Certificates Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">My Certificates</h2>
                    <button onclick="openCertificateModal()" class="text-green-600 text-sm hover:underline">+ Add New</button>
                </div>
                
                <div class="space-y-3">
                    @if(isset($certificates) && count($certificates) > 0)
                        @foreach($certificates as $certificate)
                            <div class="border-l-4 border-green-500 pl-4 py-2">
                                <p class="font-medium text-gray-800">{{ $certificate->name ?? 'Untitled Certificate' }}</p>
                                <p class="text-sm text-gray-600">
                                    @if($certificate->issue_date)
                                        Issued: {{ \Carbon\Carbon::parse($certificate->issue_date)->format('d M Y') }}
                                    @else
                                        Issue date not available
                                    @endif
                                </p>
                                @if($certificate->file_path)
                                    <a href="{{ Storage::url($certificate->file_path) }}" target="_blank" class="text-blue-600 text-sm hover:underline">View</a>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">No certificates yet</p>
                        <button onclick="openCertificateModal()" class="block w-full text-center bg-green-600 text-white py-2 rounded hover:bg-green-700">
                            Upload Your First Certificate
                        </button>
                    @endif
                </div>
            </div>

            <!-- My Memories (Gallery) Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">My Memories</h2>
                    <button onclick="openMemoryModal()" class="text-purple-600 text-sm hover:underline">+ Add Photo/Video</button>
                </div>
                
                <div class="grid grid-cols-2 gap-2">
                    @if(isset($galleries) && count($galleries) > 0)
                        @foreach($galleries as $memory)
                            <div class="relative group cursor-pointer" onclick="viewMemory('{{ Storage::url($memory->file_path) }}')">
                                @if(in_array($memory->file_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                    <img src="{{ Storage::url($memory->file_path) }}" class="w-full h-24 object-cover rounded">
                                @else
                                    <div class="w-full h-24 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded flex items-center justify-center">
                                    <span class="text-white text-xs">View</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-2">
                            <p class="text-gray-500 text-center py-4">No memories yet</p>
                            <button onclick="openMemoryModal()" class="block w-full text-center bg-purple-600 text-white py-2 rounded hover:bg-purple-700">
                                Upload Your First Memory
                            </button>
                        </div>
                    @endif
                </div>
                
                @if(isset($galleries) && method_exists($galleries, 'total') && $galleries->total() > 0)
                    <a href="{{ route('dashboard.gallery') }}" class="block text-center text-purple-600 text-sm mt-4 hover:underline">
                        View All Memories ({{ $galleries->total() }})
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Certificate Upload Modal -->
<div id="certificateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Upload Certificate</h3>
        <form action="{{ route('dashboard.certificates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Certificate Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" placeholder="e.g., Paragliding License" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Certificate Number (Optional)</label>
                <input type="text" name="certificate_number" class="w-full border rounded px-3 py-2" placeholder="e.g., PG-2024-001">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Issue Date</label>
                <input type="date" name="issue_date" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date (Optional)</label>
                <input type="date" name="expiry_date" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Issuing Authority</label>
                <input type="text" name="issuing_authority" class="w-full border rounded px-3 py-2" placeholder="e.g., Paragliding Association">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Certificate File</label>
                <input type="file" name="certificate_file" class="w-full border rounded px-3 py-2" accept=".pdf,.jpg,.jpeg,.png" required>
                <p class="text-xs text-gray-500 mt-1">Accepted: PDF, JPG, PNG (Max: 2MB)</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeCertificateModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Upload</button>
            </div>
        </form>
    </div>
</div>

<!-- Memory Upload Modal -->
<div id="memoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-lg font-semibold mb-4">Add Memory</h3>
        <form action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" placeholder="e.g., My First Flight" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Photo/Video</label>
                <input type="file" name="file" class="w-full border rounded px-3 py-2" accept="image/*,video/*" required>
                <p class="text-xs text-gray-500 mt-1">Accepted: Images and Videos (Max: 10MB)</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="3" placeholder="Share your experience..."></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeMemoryModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Upload</button>
            </div>
        </form>
    </div>
</div>

<script>
function openCertificateModal() {
    document.getElementById('certificateModal').classList.remove('hidden');
}

function closeCertificateModal() {
    document.getElementById('certificateModal').classList.add('hidden');
}

function openMemoryModal() {
    document.getElementById('memoryModal').classList.remove('hidden');
}

function closeMemoryModal() {
    document.getElementById('memoryModal').classList.add('hidden');
}

function viewMemory(path) {
    window.open(path, '_blank');
}

// Close modals when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    // Certificate modal
    document.getElementById('certificateModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCertificateModal();
        }
    });
    
    // Memory modal
    document.getElementById('memoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMemoryModal();
        }
    });
});
</script>
@endsection
