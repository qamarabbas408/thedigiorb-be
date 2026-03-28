<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\FileUploadService;

class FileUpload extends Component
{
    use WithFileUploads;
    
    public $files = [];
    public $uploadedFiles = [];
    public $maxFiles = 5;
    public $accept = 'image/*';
    public $directory = 'uploads';
    public $previewImages = true;
    public $showProgress = true;
    
    protected FileUploadService $fileUploadService;
    
    public function boot()
    {
        $this->fileUploadService = app(FileUploadService::class);
    }
    
    public function updatedFiles()
    {
        $this->validate([
            'files.*' => 'image|max:10240', // 10MB max per file
        ]);
        
        $this->uploadFiles();
    }
    
    public function uploadFiles()
    {
        foreach ($this->files as $key => $file) {
            if ($file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                try {
                    $uploadedFile = $this->fileUploadService->uploadImage($file, $this->directory);
                    
                    // Add to uploaded files array
                    $this->uploadedFiles[] = $uploadedFile;
                    
                    // Remove from temporary files
                    unset($this->files[$key]);
                    
                    // Dispatch event for parent component
                    $this->dispatch('fileUploaded', $uploadedFile);
                    
                } catch (\Exception $e) {
                    $this->addError('files.' . $key, $e->getMessage());
                }
            }
        }
        
        // Reset files array
        $this->files = array_values($this->files);
        
        // Check if max files reached
        if (count($this->uploadedFiles) >= $this->maxFiles) {
            $this->files = [];
        }
    }
    
    public function removeUploadedFile(int $index)
    {
        if (isset($this->uploadedFiles[$index])) {
            $file = $this->uploadedFiles[$index];
            
            // Delete from storage
            $this->fileUploadService->deleteFile($file['path']);
            
            // Remove from array
            unset($this->uploadedFiles[$index]);
            $this->uploadedFiles = array_values($this->uploadedFiles);
            
            // Dispatch event for parent component
            $this->dispatch('fileRemoved', $index);
        }
    }
    
    public function removeTemporaryFile(int $index)
    {
        if (isset($this->files[$index])) {
            unset($this->files[$index]);
            $this->files = array_values($this->files);
        }
    }
    
    public function getCanUploadMoreProperty()
    {
        return count($this->uploadedFiles) + count($this->files) < $this->maxFiles;
    }
    
    public function getUploadProgressProperty()
    {
        $total = count($this->uploadedFiles) + count($this->files);
        return $total > 0 ? ($total / $this->maxFiles) * 100 : 0;
    }
    
    /**
     * Format file size for display
     */
    public function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }
    
    public function render()
    {
        return view('livewire.admin.components.file-upload');
    }
}
