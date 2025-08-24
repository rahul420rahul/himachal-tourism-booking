@extends('layouts.app')

@section('title', 'Gallery - MyBirBilling')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="min-h-screen bg-gradient-to-b from-slate-50 to-white">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-violet-600 via-purple-600 to-indigo-700 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-6 animate-pulse">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h1 class="text-5xl lg:text-6xl font-extrabold mb-6 bg-gradient-to-r from-white to-violet-100 bg-clip-text text-transparent">
                BirBilling Community Gallery
            </h1>
            <p class="text-xl lg:text-2xl text-violet-100 max-w-4xl mx-auto leading-relaxed mb-8">
                Capture and share your thrilling paragliding moments from Bir Billing! Upload photos and videos to inspire the community.
            </p>
            <button id="shareMemoryBtn" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 to-violet-500 text-white font-bold rounded-2xl hover:from-pink-600 hover:to-violet-600 transition-all transform hover:scale-105 shadow-xl hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-pink-400" title="Upload your paragliding memories">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Share Your Memory
            </button>
        </div>
        <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl animate-bounce"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-violet-300/20 rounded-full blur-lg animate-bounce delay-200"></div>
    </section>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300">
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-violet-600 to-purple-600 bg-clip-text text-transparent">
                        Share Your BirBilling Adventure
                    </h2>
                    <button id="closeModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none" title="Close modal">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="uploadForm" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Memory Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-violet-100 focus:border-violet-500 transition-all" placeholder="Give your memory a title..." required>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Upload Photo or Video <span class="text-red-500">*</span></label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-violet-500 transition-colors relative">
                            <input type="file" id="fileUpload" name="file" accept="image/*,video/*" class="hidden" required>
                            <label for="fileUpload" class="cursor-pointer w-full h-full absolute top-0 left-0 flex flex-col items-center justify-center">
                                <div class="bg-violet-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <p class="text-lg font-semibold text-gray-700">Click to upload or drag file here</p>
                                <p class="text-sm text-gray-500 mt-2">Support: JPG, PNG, GIF, MP4, AVI, MOV (Max: 50MB)</p>
                            </label>
                            <div id="filePreview" class="mt-4 hidden">
                                <div id="previewContent" class="max-w-xs mx-auto"></div>
                                <p id="fileName" class="text-sm text-gray-600 mt-2"></p>
                            </div>
                        </div>
                        <p id="fileError" class="text-sm text-red-600 mt-2 hidden"></p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Share Your Experience</label>
                        <textarea name="description" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-violet-100 focus:border-violet-500 transition-all resize-none" rows="4" placeholder="Tell us about your amazing paragliding experience in Bir Billing..."></textarea>
                    </div>

                    <!-- Upload Progress -->
                    <div id="uploadProgress" class="hidden">
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                            <div id="progressBar" class="bg-violet-600 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <p id="uploadStatus" class="text-sm text-center text-gray-600">Uploading...</p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-violet-600 to-purple-600 text-white py-4 px-8 rounded-xl font-bold text-lg hover:from-violet-700 hover:to-purple-700 transition-all transform hover:scale-[1.02] shadow-xl hover:shadow-2xl flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-purple-400 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <span id="btnText">Share My Adventure</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-violet-50 to-purple-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto text-center">
                <div class="group">
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all group-hover:scale-105">
                        <div class="text-3xl font-bold text-violet-600 mb-2" id="totalMemories">0</div>
                        <div class="text-gray-600 font-medium">Memories Shared</div>
                    </div>
                </div>
                <div class="group">
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all group-hover:scale-105">
                        <div class="text-3xl font-bold text-purple-600 mb-2" id="totalPhotos">0</div>
                        <div class="text-gray-600 font-medium">Photos</div>
                    </div>
                </div>
                <div class="group">
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all group-hover:scale-105">
                        <div class="text-3xl font-bold text-pink-600 mb-2" id="totalVideos">0</div>
                        <div class="text-gray-600 font-medium">Videos</div>
                    </div>
                </div>
                <div class="group">
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all group-hover:scale-105">
                        <div class="text-3xl font-bold text-indigo-600 mb-2" id="totalLikes">0</div>
                        <div class="text-gray-600 font-medium">Total Likes</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-8 bg-white shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <h3 class="text-lg font-bold text-gray-800">Filter by:</h3>
                    <div class="flex items-center space-x-2">
                        <button class="filter-btn active px-4 py-2 rounded-full bg-violet-500 text-white font-medium transition-colors" data-filter="all">All</button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-violet-100 transition-colors" data-filter="photo">Photos</button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-100 text-gray-600 font-medium hover:bg-violet-100 transition-colors" data-filter="video">Videos</button>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <label for="sortBy" class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select id="sortBy" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                        <option value="latest">Latest</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-20" id="gallerySection">
        <div class="container mx-auto px-4">
            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="text-center py-20">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-violet-600"></div>
                <p class="mt-4 text-gray-600">Loading memories...</p>
            </div>
            
            <!-- No Memories Message -->
            <div id="noMemories" class="text-center py-20 hidden">
                <div class="bg-violet-100 p-4 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No memories found</h3>
                <p class="text-gray-600 mb-6">Be the first to share your BirBilling adventure!</p>
                <button id="firstUploadBtn" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-violet-600 to-purple-600 text-white font-bold rounded-xl hover:from-violet-700 hover:to-purple-700 transition-all transform hover:scale-105">
                    Upload First Memory
                </button>
            </div>
            
            <!-- Gallery Grid -->
            <div id="galleryGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-8xl mx-auto hidden">
                <!-- Dynamic content will be loaded here -->
            </div>
            
            <!-- Load More Button -->
            <div id="loadMoreContainer" class="text-center mt-12 hidden">
                <button id="loadMoreBtn" class="px-8 py-4 bg-gradient-to-r from-violet-600 to-purple-600 text-white font-bold rounded-xl hover:from-violet-700 hover:to-purple-700 transition-all transform hover:scale-105">
                    Load More Memories
                </button>
            </div>
        </div>
    </section>

    <!-- View Modal -->
    <div id="viewModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300">
            <div class="flex items-center justify-between p-6 border-b">
                <div>
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-800"></h3>
                    <p id="modalDate" class="text-gray-600"></p>
                </div>
                <button id="closeViewModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors focus:outline-none" title="Close preview">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="p-6">
                <!-- Content will be dynamically loaded -->
            </div>
            <div id="modalDescription" class="px-6 pb-4 text-gray-700"></div>
            <div class="p-6 border-t flex justify-between items-center">
                <button id="modalLikeBtn" class="flex items-center px-4 py-2 bg-white border-2 border-gray-200 text-gray-700 rounded-lg hover:border-red-400 hover:text-red-500 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span id="modalLikeCount">0</span> Likes
                </button>
                <div class="text-sm text-gray-500" id="modalUploadInfo"></div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="successText">Memory uploaded successfully!</span>
        </div>
    </div>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600">
        <div class="container mx-auto px-4 text-center text-white">
            <h2 class="text-4xl font-bold mb-6">Ready for Your Own Adventure?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Join hundreds of adventurers who have shared their incredible paragliding experiences with us!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('packages.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-violet-600 font-bold rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Book Your Flight
                </a>
                <a href="tel:+919736696260" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold rounded-xl hover:from-pink-600 hover:to-rose-600 transition-all transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Now
                </a>
            </div>
        </div>
    </section>
</div>

<style>
.memory-card {
    @apply bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group cursor-pointer transform hover:scale-[1.02];
}

.memory-media {
    @apply relative overflow-hidden h-64 bg-gray-100;
}

.memory-media img,
.memory-media video {
    @apply w-full h-full object-cover transition-transform duration-300 group-hover:scale-110;
}

.memory-content {
    @apply p-6;
}

.memory-title {
    @apply text-lg font-bold text-gray-800 mb-2 line-clamp-2;
}

.memory-description {
    @apply text-gray-600 text-sm mb-4 line-clamp-2;
}

.memory-actions {
    @apply flex items-center justify-between;
}

.like-btn {
    @apply flex items-center space-x-2 px-3 py-2 rounded-lg bg-gray-100 hover:bg-red-100 text-gray-600 hover:text-red-500 transition-colors;
}

.like-btn.liked {
    @apply bg-red-100 text-red-500;
}

.memory-date {
    @apply text-xs text-gray-500;
}

.filter-btn.active {
    @apply bg-violet-500 text-white;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.6s ease-out forwards;
}
</style>

<script>
// Gallery App - Complete Implementation
const GalleryApp = {
    data: {
        memories: [],
        loading: false,
        hasMore: true,
        currentPage: 1,
        filter: 'all',
        sort: 'latest',
        uploading: false,
        stats: { total: 0, photos: 0, videos: 0, likes: 0 }
    },

    async init() {
        await this.loadMemories();
        this.setupEventListeners();
        this.setupInfiniteScroll();
        this.updateStats();
    },

    async loadMemories(reset = true) {
        if (this.loading) return;
        
        this.loading = true;
        
        try {
            const params = new URLSearchParams({
                page: reset ? 1 : this.currentPage,
                filter: this.filter,
                sort: this.sort
            });
            
            const response = await fetch(`/api/memories?${params}`);
            const data = await response.json();
            
            if (reset) {
                this.memories = data.data || [];
                this.currentPage = 1;
            } else {
                this.memories.push(...(data.data || []));
            }
            
            this.hasMore = data.has_more || false;
            this.currentPage = data.next_page || this.currentPage + 1;
            
            this.renderMemories();
            this.updateStats();
        } catch (error) {
            console.error('Failed to load memories:', error);
            this.showError('Failed to load memories');
        } finally {
            this.loading = false;
            document.getElementById('loadingSpinner').style.display = 'none';
        }
    },

    async uploadMemory(formData) {
        if (this.uploading) return;
        
        this.uploading = true;
        this.showUploadProgress(0);
        
        try {
            const xhr = new XMLHttpRequest();
            
            return new Promise((resolve, reject) => {
                xhr.upload.addEventListener('progress', (e) => {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        this.showUploadProgress(percentComplete);
                    }
                });
                
                xhr.addEventListener('load', () => {
                    if (xhr.status === 200) {
                        const data = JSON.parse(xhr.responseText);
                        if (data.success) {
                            this.memories.unshift(data.memory);
                            this.renderMemories();
                            this.updateStats();
                            this.showSuccess('Memory uploaded successfully!');
                            resolve(data);
                        } else {
                            this.showError(data.message || 'Upload failed');
                            reject(new Error(data.message));
                        }
                    } else {
                        this.showError('Upload failed');
                        reject(new Error('Upload failed'));
                    }
                });
                
                xhr.addEventListener('error', () => {
                    this.showError('Upload failed');
                    reject(new Error('Upload failed'));
                });
                
                xhr.open('POST', '/api/memories');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
                xhr.send(formData);
            });
        } catch (error) {
            this.showError('Upload failed');
            throw error;
        } finally {
            this.uploading = false;
            this.hideUploadProgress();
        }
    },

    async toggleLike(memoryId, button) {
        try {
            button.disabled = true;
            
            const response = await fetch(`/api/memories/${memoryId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                const memory = this.memories.find(m => m.id === memoryId);
                if (memory) {
                    memory.likes_count = data.likes_count;
                }
                
                // Update button appearance
                const likeCount = button.querySelector('.like-count') || button.querySelector('span');
                if (likeCount) {
                    likeCount.textContent = data.liked ? `${data.likes_count} Likes` : data.likes_count;
                }
                
                if (data.liked) {
                    button.classList.add('liked');
                    button.classList.remove('bg-gray-100', 'text-gray-600');
                    button.classList.add('bg-red-100', 'text-red-500');
                } else {
                    button.classList.remove('liked');
                    button.classList.remove('bg-red-100', 'text-red-500');
                    button.classList.add('bg-gray-100', 'text-gray-600');
                }
                
                this.updateStats();
            }
        } catch (error) {
            console.error('Failed to toggle like:', error);
            this.showError('Failed to update like');
        } finally {
            button.disabled = false;
        }
    },

    renderMemories() {
        const container = document.getElementById('galleryGrid');
        const noMemories = document.getElementById('noMemories');
        const loadMoreContainer = document.getElementById('loadMoreContainer');
        
        if (!container) return;
        
        if (this.memories.length === 0) {
            container.classList.add('hidden');
            noMemories.classList.remove('hidden');
            loadMoreContainer.classList.add('hidden');
            return;
        }
        
        container.classList.remove('hidden');
        noMemories.classList.add('hidden');
        loadMoreContainer.classList.toggle('hidden', !this.hasMore);
        
        container.innerHTML = this.memories.map((memory, index) => `
            <div class="memory-card animate-fadeInUp" data-memory-id="${memory.id}" style="animation-delay: ${index * 0.1}s">
                <div class="memory-media" onclick="GalleryApp.openViewModal(${memory.id})">
                    ${memory.type === 'photo' ? 
                        `<img src="${memory.thumbnail_url || memory.file_url}" alt="${memory.title}" loading="lazy" onerror="this.src='/images/placeholder.jpg'">` :
                        `<video src="${memory.file_url}" class="w-full h-full object-cover" muted loop onmouseover="this.play()" onmouseout="this.pause()"></video>`
                    }
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">
                        <p class="text-sm font-medium truncate">${memory.title}</p>
                        ${memory.type === 'video' ? '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"><svg class="w-12 h-12 text-white/80" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>' : ''}
                    </div>
                </div>
                <div class="memory-content">
                    <h3 class="memory-title">${memory.title}</h3>
                    ${memory.description ? `<p class="memory-description">${memory.description}</p>` : ''}
                    <div class="memory-actions">
                        <button class="like-btn ${memory.is_liked_by_current_ip ? 'liked bg-red-100 text-red-500' : 'bg-gray-100 text-gray-600'}" 
                                onclick="GalleryApp.toggleLike(${memory.id}, this)">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="like-count">${memory.likes_count}</span>
                        </button>
                        <span class="memory-date">${new Date(memory.created_at).toLocaleDateString()}</span>
                    </div>
                </div>
            </div>
        `).join('');
    },

    openViewModal(memoryId) {
        const memory = this.memories.find(m => m.id === memoryId);
        if (!memory) return;
        
        const modal = document.getElementById('viewModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalDate = document.getElementById('modalDate');
        const modalContent = document.getElementById('modalContent');
        const modalDescription = document.getElementById('modalDescription');
        const modalLikeBtn = document.getElementById('modalLikeBtn');
        const modalLikeCount = document.getElementById('modalLikeCount');
        const modalUploadInfo = document.getElementById('modalUploadInfo');
        
        modalTitle.textContent = memory.title;
        modalDate.textContent = new Date(memory.created_at).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        if (memory.type === 'photo') {
            modalContent.innerHTML = `<img src="${memory.file_url}" alt="${memory.title}" class="w-full max-h-96 object-contain mx-auto rounded-lg">`;
        } else {
            modalContent.innerHTML = `<video src="${memory.file_url}" controls class="w-full max-h-96 object-contain mx-auto rounded-lg"></video>`;
        }
        
        modalDescription.textContent = memory.description || '';
        modalDescription.style.display = memory.description ? 'block' : 'none';
        
        modalLikeCount.textContent = memory.likes_count;
        modalLikeBtn.className = `flex items-center px-4 py-2 rounded-lg transition-colors ${
            memory.is_liked_by_current_ip 
                ? 'bg-red-100 text-red-500 border-2 border-red-200' 
                : 'bg-white border-2 border-gray-200 text-gray-700 hover:border-red-400 hover:text-red-500'
        }`;
        
        modalLikeBtn.onclick = () => this.toggleLike(memory.id, modalLikeBtn);
        
        modalUploadInfo.textContent = `Uploaded ${this.timeAgo(memory.created_at)}`;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    },

    closeViewModal() {
        const modal = document.getElementById('viewModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    },

    updateStats() {
        const totalMemories = this.memories.length;
        const totalPhotos = this.memories.filter(m => m.type === 'photo').length;
        const totalVideos = this.memories.filter(m => m.type === 'video').length;
        const totalLikes = this.memories.reduce((sum, m) => sum + m.likes_count, 0);
        
        this.animateCounter('totalMemories', totalMemories);
        this.animateCounter('totalPhotos', totalPhotos);
        this.animateCounter('totalVideos', totalVideos);
        this.animateCounter('totalLikes', totalLikes);
    },

    animateCounter(elementId, targetValue) {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        const startValue = parseInt(element.textContent) || 0;
        const duration = 1000;
        const startTime = Date.now();
        
        const animate = () => {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const currentValue = Math.floor(startValue + (targetValue - startValue) * progress);
            
            element.textContent = currentValue;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        
        animate();
    },

    setupEventListeners() {
        // Modal controls
        document.getElementById('shareMemoryBtn').addEventListener('click', () => this.openUploadModal());
        document.getElementById('firstUploadBtn')?.addEventListener('click', () => this.openUploadModal());
        document.getElementById('closeModal').addEventListener('click', () => this.closeUploadModal());
        document.getElementById('closeViewModal').addEventListener('click', () => this.closeViewModal());
        
        // Filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active', 'bg-violet-500', 'text-white');
                    b.classList.add('bg-gray-100', 'text-gray-600');
                });
                e.target.classList.add('active', 'bg-violet-500', 'text-white');
                e.target.classList.remove('bg-gray-100', 'text-gray-600');
                
                this.filter = e.target.dataset.filter;
                this.loadMemories(true);
            });
        });
        
        // Sort dropdown
        document.getElementById('sortBy').addEventListener('change', (e) => {
            this.sort = e.target.value;
            this.loadMemories(true);
        });
        
        // Load more button
        document.getElementById('loadMoreBtn').addEventListener('click', () => {
            this.loadMemories(false);
        });
        
        // File upload handling
        const fileUpload = document.getElementById('fileUpload');
        fileUpload.addEventListener('change', (e) => this.handleFileSelect(e));
        
        // Upload form
        document.getElementById('uploadForm').addEventListener('submit', (e) => this.handleUploadSubmit(e));
        
        // Close modals on outside click
        document.getElementById('uploadModal').addEventListener('click', (e) => {
            if (e.target.id === 'uploadModal') this.closeUploadModal();
        });
        
        document.getElementById('viewModal').addEventListener('click', (e) => {
            if (e.target.id === 'viewModal') this.closeViewModal();
        });
    },

    setupInfiniteScroll() {
        window.addEventListener('scroll', () => {
            if (this.loading || !this.hasMore) return;
            
            const scrollTop = window.pageYOffset;
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            
            if (scrollTop + windowHeight >= documentHeight - 1000) {
                this.loadMemories(false);
            }
        });
    },

    openUploadModal() {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    },

    closeUploadModal() {
        document.getElementById('uploadModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        this.resetUploadForm();
    },

    resetUploadForm() {
        const form = document.getElementById('uploadForm');
        form.reset();
        
        document.getElementById('filePreview').classList.add('hidden');
        document.getElementById('fileError').classList.add('hidden');
        document.getElementById('submitBtn').disabled = false;
        document.getElementById('btnText').textContent = 'Share My Adventure';
    },

    handleFileSelect(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('filePreview');
        const previewContent = document.getElementById('previewContent');
        const fileName = document.getElementById('fileName');
        const fileError = document.getElementById('fileError');
        
        fileError.classList.add('hidden');
        
        if (!file) {
            preview.classList.add('hidden');
            return;
        }
        
        // Validate file size (50MB max)
        if (file.size > 50 * 1024 * 1024) {
            fileError.textContent = 'File size must be less than 50MB';
            fileError.classList.remove('hidden');
            event.target.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'video/mp4', 'video/avi', 'video/mov', 'video/wmv'];
        if (!validTypes.includes(file.type)) {
            fileError.textContent = 'Please select a valid image (JPG, PNG, GIF) or video (MP4, AVI, MOV, WMV) file';
            fileError.classList.remove('hidden');
            event.target.value = '';
            return;
        }
        
        // Show preview
        preview.classList.remove('hidden');
        fileName.textContent = file.name;
        
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.className = 'max-w-full h-32 object-cover rounded-lg';
            img.src = URL.createObjectURL(file);
            previewContent.innerHTML = '';
            previewContent.appendChild(img);
        } else {
            const video = document.createElement('video');
            video.className = 'max-w-full h-32 object-cover rounded-lg';
            video.controls = true;
            video.muted = true;
            video.src = URL.createObjectURL(file);
            previewContent.innerHTML = '';
            previewContent.appendChild(video);
        }
    },

    async handleUploadSubmit(event) {
        event.preventDefault();
        
        const formData = new FormData(event.target);
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        
        if (!formData.get('file') || !formData.get('title')) {
            this.showError('Please fill in all required fields');
            return;
        }
        
        submitBtn.disabled = true;
        btnText.textContent = 'Uploading...';
        
        try {
            await this.uploadMemory(formData);
            this.closeUploadModal();
        } catch (error) {
            console.error('Upload failed:', error);
        } finally {
            submitBtn.disabled = false;
            btnText.textContent = 'Share My Adventure';
        }
    },

    showUploadProgress(percent) {
        const progress = document.getElementById('uploadProgress');
        const progressBar = document.getElementById('progressBar');
        const status = document.getElementById('uploadStatus');
        
        progress.classList.remove('hidden');
        progressBar.style.width = percent + '%';
        status.textContent = percent < 100 ? `Uploading... ${Math.round(percent)}%` : 'Processing...';
    },

    hideUploadProgress() {
        document.getElementById('uploadProgress').classList.add('hidden');
    },

    showSuccess(message) {
        const successMsg = document.getElementById('successMessage');
        const successText = document.getElementById('successText');
        
        successText.textContent = message;
        successMsg.classList.remove('translate-x-full');
        successMsg.classList.add('translate-x-0');
        
        setTimeout(() => {
            successMsg.classList.remove('translate-x-0');
            successMsg.classList.add('translate-x-full');
        }, 5000);
    },

    showError(message) {
        alert(message); // Simple error display - you can enhance this
    },

    timeAgo(date) {
        const seconds = Math.floor((new Date() - new Date(date)) / 1000);
        
        let interval = seconds / 31536000;
        if (interval > 1) return Math.floor(interval) + ' years ago';
        
        interval = seconds / 2592000;
        if (interval > 1) return Math.floor(interval) + ' months ago';
        
        interval = seconds / 86400;
        if (interval > 1) return Math.floor(interval) + ' days ago';
        
        interval = seconds / 3600;
        if (interval > 1) return Math.floor(interval) + ' hours ago';
        
        interval = seconds / 60;
        if (interval > 1) return Math.floor(interval) + ' minutes ago';
        
        return 'just now';
    }
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    GalleryApp.init();
});
</script>

@endsection