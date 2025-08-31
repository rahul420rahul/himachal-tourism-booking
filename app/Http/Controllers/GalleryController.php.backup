<?php

namespace App\Http\Controllers;

use App\Models\GalleryMemory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery');
    }

    public function getMemories(Request $request)
    {
        $query = GalleryMemory::approved();

        // Filter by type
        if ($request->filter && $request->filter !== 'all') {
            $query->where('type', $request->filter);
        }

        // Sort
        $sort = $request->sort ?? 'latest';
        if ($sort === 'popular') {
            $query->orderBy('likes_count', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $memories = $query->paginate(12);

        return response()->json([
            'data' => $memories->items(),
            'has_more' => $memories->hasMorePages(),
            'next_page' => $memories->currentPage() + 1
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:jpeg,jpg,png,gif,mp4,avi,mov,wmv|max:50000' // 50MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('file');
            $type = str_starts_with($file->getMimeType(), 'image/') ? 'photo' : 'video';
            
            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();
            $directory = $type === 'photo' ? 'memories/photos' : 'memories/videos';
            
            // Store file
            $filePath = $file->storeAs('public/' . $directory, $filename);
            $thumbnailPath = null;
            
            // Create thumbnail for photos
            if ($type === 'photo') {
                $thumbnailPath = $this->createThumbnail($file, $filename);
            }
            
            // Save to database
            $memory = GalleryMemory::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $type,
                'file_path' => $directory . '/' . $filename,
                'thumbnail_path' => $thumbnailPath,
                'original_filename' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'uploaded_by_ip' => $request->ip()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Memory uploaded successfully!',
                'memory' => $memory
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleLike(Request $request, GalleryMemory $memory)
    {
        $ip = $request->ip();
        $wasLiked = $memory->isLikedByIp($ip);
        
        $memory->toggleLike($ip);
        
        return response()->json([
            'success' => true,
            'liked' => !$wasLiked,
            'likes_count' => $memory->likes_count
        ]);
    }

    private function createThumbnail($file, $filename)
    {
        try {
            $thumbnailFilename = 'thumb_' . $filename;
            $thumbnailPath = 'memories/thumbs/' . $thumbnailFilename;
            $fullThumbnailPath = storage_path('app/public/' . $thumbnailPath);
            
            // Create directory if it doesn't exist
            $directory = dirname($fullThumbnailPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Create thumbnail
            Image::make($file->getPathname())
                ->fit(300, 200)
                ->save($fullThumbnailPath, 80);
                
            return $thumbnailPath;
        } catch (\Exception $e) {
            // If thumbnail creation fails, return null
            return null;
        }
    }
}
