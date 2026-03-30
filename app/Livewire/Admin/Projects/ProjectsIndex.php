<?php

namespace App\Livewire\Admin\Projects;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class ProjectsIndex extends AdminComponent
{
    use WithFileUploads;
    
    public $projects = [];
    public $categories = [];
    public $loading = true;
    
    public $mainImageFile = null;
    public $imageUrl = '';
    public $imageTab = 'upload'; // 'upload' or 'url'
    public $galleryFiles = [];
    public $gallery = [];
    public $uploadedGallery = [];
    public $showModal = false;
    public $editingProject = null;
    
    public $title = '';
    public $subtitle = '';
    public $categoryId = '';
    public $year = '';
    public $technologies = '';
    public $description = '';
    public $image = '';
    public $client = '';
    public $url = '';
    public $featured = false;
    public $status = 'published';
    
    public $deleteId = null;
    public $showDeleteModal = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->projects = Project::orderBy('created_at', 'desc')->get()->toArray();
        $this->categories = Category::orderBy('name')->get()->toArray();
        
        // Process projects to handle missing images
        foreach ($this->projects as &$project) {
            // Check if main image exists
            if ($project['image'] && !$this->imageExists($project['image'])) {
                $project['image'] = null;
            }
            
            // Check gallery images
            if (isset($project['gallery']) && is_array($project['gallery'])) {
                $project['gallery'] = array_filter($project['gallery'], function($img) {
                    return $this->imageExists($img);
                });
                $project['gallery'] = array_values($project['gallery']);
            }
        }
        
        $this->loading = false;
    }
    
    /**
     * Check if an image exists (basic URL validation)
     */
    private function imageExists($url)
    {
        // Skip external URLs that might be valid
        if (str_starts_with($url, 'http')) {
            return true;
        }
        
        // Check for local asset paths that don't exist
        if (str_starts_with($url, '/assets/img/portfolio/')) {
            return false; // These old portfolio images don't exist
        }
        
        // Check for storage URLs
        if (str_starts_with($url, '/storage/')) {
            $relativePath = str_replace('/storage/', '', $url);
            return \Storage::disk('public')->exists($relativePath);
        }
        
        return true;
    }

    public function openModal($project = null)
    {
        // Prevent modal from opening if already open
        if ($this->showModal) {
            return;
        }
        
        if ($project) {
            $this->editingProject = $project;
            $this->title = $project['title'];
            $this->subtitle = $project['subtitle'] ?? '';
            $this->categoryId = $project['category_id'];
            $this->year = $project['year'] ?? '';
            $this->technologies = is_array($project['technologies']) ? implode(', ', $project['technologies']) : '';
            $this->description = $project['description'] ?? '';
            $this->image = $project['image'] ?? '';
            $this->imageUrl = '';
            $this->imageTab = 'upload'; // Default to upload tab
            $this->gallery = is_array($project['gallery'] ?? []) ? $project['gallery'] : (is_string($project['gallery'] ?? '') ? json_decode($project['gallery'] ?? '[]', true) : []);
            $this->client = $project['client'] ?? '';
            $this->url = $project['url'] ?? '';
            $this->featured = $project['featured'] ?? false;
            $this->status = $project['status'] ?? 'published';
        } else {
            $this->resetModal();
            if (!empty($this->categories)) {
                $this->categoryId = $this->categories[0]['id'] ?? '';
                $this->year = date('Y');
            }
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingProject = null;
        $this->resetModal();
    }

    public function resetModal()
    {
        $this->title = '';
        $this->subtitle = '';
        $this->categoryId = '';
        $this->year = '';
        $this->technologies = '';
        $this->description = '';
        $this->image = '';
        $this->imageUrl = '';
        $this->imageTab = 'upload';
        $this->gallery = [];
        $this->client = '';
        $this->url = '';
        $this->featured = false;
        $this->status = 'published';
        
        // Reset file uploads
        $this->mainImageFile = null;
        $this->galleryFiles = [];
        $this->uploadedGallery = [];
    }

    // Handle main image upload
    public function updatedMainImageFile()
    {
        $this->validate([
            'mainImageFile' => 'image|max:10240', // 10MB max
        ]);
    }

    // Handle gallery file uploads
    public function updatedGalleryFiles()
    {
        $this->validate([
            'galleryFiles.*' => 'image|max:10240', // 10MB max per file
        ]);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'categoryId' => 'required|string',
            'technologies' => 'string',
            'description' => 'string',
            'imageUrl' => 'nullable|url',
            'mainImageFile' => 'nullable|image|max:10240',
            'galleryFiles.*' => 'nullable|image|max:10240',
        ]);

        // Validate that either main image file or image URL is provided
        if (!$this->mainImageFile && !$this->imageUrl && !$this->image) {
            $this->addError('imageRequired', 'A main image is required. Please either upload an image or provide an image URL.');
            return;
        }

        // Process main image
        if ($this->mainImageFile) {
            try {
                $uploadService = app(\App\Services\FileUploadService::class);
                $uploadedImage = $uploadService->uploadImage($this->mainImageFile, 'projects/main');
                $this->image = $uploadedImage['url'];
                $this->dispatch('toast', ['message' => 'Main image uploaded successfully!', 'type' => 'success']);
            } catch (\Exception $e) {
                $this->addError('mainImageFile', 'Failed to upload main image: ' . $e->getMessage());
                $this->dispatch('toast', ['message' => 'Failed to upload main image', 'type' => 'error']);
            }
        } elseif ($this->imageUrl) {
            // Use the provided URL
            $this->image = $this->imageUrl;
        }

        // Process gallery images
        if (!empty($this->galleryFiles)) {
            $uploadService = app(\App\Services\FileUploadService::class);
            $galleryUploads = $uploadService->uploadGallery($this->galleryFiles, 'projects/gallery');
            
            // Add new gallery images to existing ones
            $newGalleryUrls = array_column($galleryUploads, 'url');
            $this->gallery = array_merge($this->gallery, $newGalleryUrls);
        }

        // Add uploaded gallery images from component
        if (!empty($this->uploadedGallery)) {
            $newGalleryUrls = array_column($this->uploadedGallery, 'url');
            $this->gallery = array_merge($this->gallery, $newGalleryUrls);
        }

        $techArray = array_map('trim', explode(',', $this->technologies));
        $techArray = array_filter($techArray);

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'category_id' => $this->categoryId,
            'year' => $this->year,
            'technologies' => array_values($techArray),
            'description' => $this->description,
            'image' => $this->image,
            'gallery' => $this->gallery,
            'client' => $this->client,
            'url' => $this->url,
            'featured' => $this->featured,
            'status' => $this->status,
        ];

        // Debug: Log what we're saving
        \Log::info('Saving project with image: ' . ($this->image ?: 'NULL'));
        \Log::info('Gallery count: ' . count($this->gallery));

        if ($this->editingProject) {
            Project::where('id', $this->editingProject['id'])->update($data);
            $this->dispatch('toast', ['message' => 'Project updated successfully!', 'type' => 'success']);
        } else {
            Project::create($data);
            $this->dispatch('toast', ['message' => 'Project created successfully!', 'type' => 'success']);
        }

        $this->closeModal();
        $this->loadData();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function delete()
    {
        if ($this->deleteId) {
            $project = Project::find($this->deleteId);
            
            // Delete associated files
            if ($project && $project->image) {
                $uploadService = app(\App\Services\FileUploadService::class);
                $imagePath = parse_url($project->image, PHP_URL_PATH);
                if ($imagePath) {
                    $relativePath = str_replace('/storage/', '', $imagePath);
                    $uploadService->deleteFile($relativePath);
                }
            }
            
            // Delete gallery images
            if ($project && !empty($project->gallery)) {
                $uploadService = app(\App\Services\FileUploadService::class);
                foreach ($project->gallery as $galleryImage) {
                    $imagePath = parse_url($galleryImage, PHP_URL_PATH);
                    if ($imagePath) {
                        $relativePath = str_replace('/storage/', '', $imagePath);
                        $uploadService->deleteFile($relativePath);
                    }
                }
            }
            
            Project::where('id', $this->deleteId)->delete();
            $this->dispatch('toast', ['message' => 'Project deleted successfully!', 'type' => 'success']);
        }
        $this->cancelDelete();
        $this->loadData();
    }

    public function removeGalleryImage($index)
    {
        if (isset($this->gallery[$index])) {
            // Delete file from storage
            $uploadService = app(\App\Services\FileUploadService::class);
            $imagePath = parse_url($this->gallery[$index], PHP_URL_PATH);
            if ($imagePath) {
                $relativePath = str_replace('/storage/', '', $imagePath);
                $uploadService->deleteFile($relativePath);
            }
            
            // Remove from gallery array
            unset($this->gallery[$index]);
            $this->gallery = array_values($this->gallery);
        }
    }

    public function onFileUploaded($fileData)
    {
        \Log::info('onFileUploaded received: ' . json_encode($fileData));
        
        // Ensure gallery is always an array
        if (!is_array($this->gallery)) {
            $this->gallery = is_string($this->gallery) ? json_decode($this->gallery, true) : [];
        }
        
        $this->gallery[] = $fileData['url'];
        \Log::info('Gallery now has ' . count($this->gallery) . ' images');
    }
    
    // Listen for file-uploaded events
    #[On('file-uploaded')]
    public function handleFileUploaded($fileData)
    {
        \Log::info('handleFileUploaded received: ' . json_encode($fileData));
        
        // Ensure gallery is always an array
        if (!is_array($this->gallery)) {
            $this->gallery = is_string($this->gallery) ? json_decode($this->gallery, true) : [];
        }
        
        $this->gallery[] = $fileData['url'];
        \Log::info('Gallery now has ' . count($this->gallery) . ' images');
    }

    public function onFileRemoved($index)
    {
        \Log::info('onFileRemoved received for index: ' . $index);
        
        // Ensure gallery is always an array
        if (!is_array($this->gallery)) {
            $this->gallery = is_string($this->gallery) ? json_decode($this->gallery, true) : [];
        }
        
        if (isset($this->gallery[$index])) {
            // Delete file from storage
            $uploadService = app(\App\Services\FileUploadService::class);
            $imagePath = parse_url($this->gallery[$index], PHP_URL_PATH);
            if ($imagePath) {
                $relativePath = str_replace('/storage/', '', $imagePath);
                $uploadService->deleteFile($relativePath);
            }
            
            // Remove from gallery array
            unset($this->gallery[$index]);
            $this->gallery = array_values($this->gallery);
        }
    }

    public function render()
    {
        return view('livewire.admin.projects.projects-index');
    }
}
