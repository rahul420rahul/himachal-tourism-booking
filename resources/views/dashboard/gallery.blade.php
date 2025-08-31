@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">My Gallery</h1>
        <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-upload mr-2"></i> Upload Photo/Video
        </button>
    </div>

    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative group">
                        @if(in_array(pathinfo($gallery->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ asset('storage/' . $gallery->file_path) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-48 object-cover">
                        @elseif(in_array(pathinfo($gallery->file_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov', 'wmv']))
                            <video class="w-full h-48 object-cover" controls>
                                <source src="{{ asset('storage/' . $gallery->file_path) }}" type="video/{{ pathinfo($gallery->file_path, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-file text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay with actions -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="flex space-x-2">
                                <a href="{{ asset('storage/' . $gallery->file_path) }}" 
                                   target="_blank" 
                                   class="bg-white text-gray-800 px-3 py-1 rounded hover:bg-gray-100">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('dashboard.gallery.delete', $gallery->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">{{ $gallery->title ?? 'Untitled' }}</h3>
                        @if($gallery->description)
                            <p class="text-gray-600 text-sm">{{ Str::limit($gallery->description, 50) }}</p>
                        @endif
                        <div class="mt-2 flex justify-between items-center text-xs text-gray-500">
                            <span>{{ $gallery->created_at->format('M d, Y') }}</span>
                            <span class="bg-{{ $gallery->is_public ? 'green' : 'gray' }}-100 text-{{ $gallery->is_public ? 'green' : 'gray' }}-800 px-2 py-1 rounded">
                                {{ $gallery->is_public ? 'Public' : 'Private' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $galleries->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-xl">No images uploaded yet.</p>
            <p class="text-gray-400 mt-2">Click the upload button to add your first photo or video!</p>
        </div>
    @endif
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Upload to Gallery</h2>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" 
                    class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('dashboard.gallery.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" required 
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description (Optional)</label>
                <textarea name="description" rows="3" 
                          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">File</label>
                <input type="file" name="file" required accept="image/*,video/*"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Supported: JPG, PNG, GIF, MP4, AVI, MOV (Max: 10MB)</p>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_public" value="1" class="mr-2">
                    <span class="text-sm">Make this public (visible on main gallery page)</span>
                </label>
            </div>
            
            <div class="flex justify-end space-x-2">
                <button type="button" 
                        onclick="document.getElementById('uploadModal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Close modal when clicking outside
document.getElementById('uploadModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});
</script>
@endsection
