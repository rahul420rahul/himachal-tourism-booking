@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Add to Gallery</h1>
    
    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf
        
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required>
        </div>
        
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium mb-2">File (Image or Video)</label>
            <input type="file" name="file" id="file" accept="image/*,video/*" class="w-full" required>
        </div>
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload
        </button>
    </form>
</div>
@endsection
