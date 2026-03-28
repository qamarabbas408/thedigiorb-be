<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    /**
     * Upload and process an image file
     */
    public function uploadImage(UploadedFile $file, string $directory = 'uploads', int $maxWidth = 1920, int $maxHeight = 1080): array
    {
        // Validate file
        $this->validateImageFile($file);
        
        // Generate unique filename
        $filename = $this->generateUniqueFilename($file);
        $path = $directory . '/' . $filename;
        
        // Process and optimize image
        $imageData = $this->processImage($file, $maxWidth, $maxHeight);
        
        // Store the file
        Storage::disk('public')->put($path, $imageData);
        
        return [
            'filename' => $filename,
            'path' => $path,
            'url' => '/storage/' . $path,
            'size' => Storage::disk('public')->size($path),
            'mime_type' => 'image/webp',
            'original_name' => $file->getClientOriginalName()
        ];
    }
    
    /**
     * Upload multiple images (gallery)
     */
    public function uploadGallery(array $files, string $directory = 'uploads/gallery'): array
    {
        $uploadedFiles = [];
        
        foreach ($files as $index => $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $uploadedFiles[] = $this->uploadImage($file, $directory);
            }
        }
        
        return $uploadedFiles;
    }
    
    /**
     * Delete a file from storage
     */
    public function deleteFile(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
    
    /**
     * Validate image file
     */
    protected function validateImageFile(UploadedFile $file): void
    {
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 10 * 1024 * 1024; // 10MB
        
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw new \InvalidArgumentException('Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');
        }
        
        if ($file->getSize() > $maxSize) {
            throw new \InvalidArgumentException('File size too large. Maximum size is 10MB.');
        }
    }
    
    /**
     * Generate unique filename
     */
    protected function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = 'webp'; // Always convert to webp
        $basename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $timestamp = time();
        $random = Str::random(6);
        
        return "{$basename}-{$timestamp}-{$random}.{$extension}";
    }
    
    /**
     * Process image using GD
     */
    protected function processImage(UploadedFile $file, int $maxWidth, int $maxHeight): string
    {
        $imageInfo = getimagesize($file->getPathname());
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $mimeType = $imageInfo['mime'];
        
        // Create image resource based on mime type
        $image = $this->createImageResource($file->getPathname(), $mimeType);
        
        // Calculate new dimensions
        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = (int)($width * $ratio);
            $newHeight = (int)($height * $ratio);
            
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $newImage;
        }
        
        // Convert to WebP
        ob_start();
        imagewebp($image, null, 90);
        $imageData = ob_get_contents();
        ob_end_clean();
        
        imagedestroy($image);
        
        return $imageData;
    }
    
    /**
     * Create image resource from file
     */
    protected function createImageResource(string $filepath, string $mimeType)
    {
        switch ($mimeType) {
            case 'image/jpeg':
                return imagecreatefromjpeg($filepath);
            case 'image/png':
                return imagecreatefrompng($filepath);
            case 'image/gif':
                return imagecreatefromgif($filepath);
            case 'image/webp':
                return imagecreatefromwebp($filepath);
            default:
                throw new \InvalidArgumentException('Unsupported image type: ' . $mimeType);
        }
    }
    
    /**
     * Get image dimensions
     */
    public function getImageDimensions(string $path): array
    {
        if (!Storage::disk('public')->exists($path)) {
            return ['width' => 0, 'height' => 0];
        }
        
        $fullPath = Storage::disk('public')->path($path);
        $imageInfo = getimagesize($fullPath);
        
        if ($imageInfo === false) {
            return ['width' => 0, 'height' => 0];
        }
        
        return [
            'width' => $imageInfo[0],
            'height' => $imageInfo[1]
        ];
    }
}
