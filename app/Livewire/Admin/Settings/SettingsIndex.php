<?php

namespace App\Livewire\Admin\Settings;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;
use App\Services\FileUploadService;

#[Layout('layouts.admin')]
class SettingsIndex extends AdminComponent
{
    use WithFileUploads;
    
    public $loading = true;
    public $saving = false;
    public $uploading = null;
    
    public $company_name = '';
    public $company_email = '';
    public $company_phone = '';
    public $company_address = '';
    public $company_description = '';
    public $logo_type = 'text';
    public $logo_image = '';
    public $logo_image_url = '';
    public $logoImageFile = null;
    public $logoTab = 'upload';
    public $favicon = '';
    public $favicon_url = '';
    public $faviconFile = null;
    public $faviconTab = 'upload';
    public $facebook_url = '';
    public $twitter_url = '';
    public $linkedin_url = '';
    public $instagram_url = '';
    public $logo_text = '';

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = SiteSetting::all()->keyBy('setting_key');
        
        $this->company_name = $settings['company_name']->setting_value ?? '';
        $this->company_email = $settings['company_email']->setting_value ?? '';
        $this->company_phone = $settings['company_phone']->setting_value ?? '';
        $this->company_address = $settings['company_address']->setting_value ?? '';
        $this->company_description = $settings['company_description']->setting_value ?? '';
        $this->logo_type = $settings['logo_type']->setting_value ?? 'text';
        $this->logo_image = $settings['logo_image']->setting_value ?? '';
        $this->logo_image_url = $settings['logo_image']->setting_value ?? '';
        $this->favicon = $settings['favicon']->setting_value ?? '';
        $this->favicon_url = $settings['favicon']->setting_value ?? '';
        $this->facebook_url = $settings['facebook_url']->setting_value ?? '';
        $this->twitter_url = $settings['twitter_url']->setting_value ?? '';
        $this->linkedin_url = $settings['linkedin_url']->setting_value ?? '';
        $this->instagram_url = $settings['instagram_url']->setting_value ?? '';
        $this->logo_text = $settings['logo_text']->setting_value ?? '';
        
        $this->loading = false;
    }

    public function save()
    {
        $this->saving = true;
        
        // Process logo image
        if ($this->logoImageFile) {
            try {
                $uploadService = app(FileUploadService::class);
                $uploadedImage = $uploadService->uploadImage($this->logoImageFile, 'settings');
                $this->logo_image = $uploadedImage['url'];
            } catch (\Exception $e) {
                $this->dispatch('toast', ['message' => 'Failed to upload logo image', 'type' => 'error']);
                $this->saving = false;
                return;
            }
        } elseif ($this->logoTab === 'url' && $this->logo_image_url) {
            $this->logo_image = $this->logo_image_url;
        } elseif ($this->logoTab === 'upload' && !$this->logoImageFile) {
            // Keep existing logo_image value
        }
        
        // Process favicon
        if ($this->faviconFile) {
            try {
                $uploadService = app(FileUploadService::class);
                $uploadedImage = $uploadService->uploadImage($this->faviconFile, 'settings');
                $this->favicon = $uploadedImage['url'];
            } catch (\Exception $e) {
                $this->dispatch('toast', ['message' => 'Failed to upload favicon', 'type' => 'error']);
                $this->saving = false;
                return;
            }
        } elseif ($this->faviconTab === 'url' && $this->favicon_url) {
            $this->favicon = $this->favicon_url;
        } elseif ($this->faviconTab === 'upload' && !$this->faviconFile) {
            // Keep existing favicon value
        }
        
        $settings = [
            'company_name' => $this->company_name,
            'company_email' => $this->company_email,
            'company_phone' => $this->company_phone,
            'company_address' => $this->company_address,
            'company_description' => $this->company_description,
            'logo_type' => $this->logo_type,
            'logo_image' => $this->logo_image,
            'favicon' => $this->favicon,
            'facebook_url' => $this->facebook_url,
            'twitter_url' => $this->twitter_url,
            'linkedin_url' => $this->linkedin_url,
            'instagram_url' => $this->instagram_url,
            'logo_text' => $this->logo_text,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value]
            );
        }

        // Reset file inputs
        $this->logoImageFile = null;
        $this->faviconFile = null;
        
        $this->saving = false;
        $this->dispatch('toast', ['message' => 'Settings saved successfully!', 'type' => 'success']);
    }

    public function updatedLogoImageFile()
    {
        $this->validate([
            'logoImageFile' => 'image|max:10240',
        ]);
    }

    public function updatedLogoType($value)
    {
        if ($value === 'image') {
            $this->logoTab = 'upload';
        }
    }
    
    public function updatedFaviconFile()
    {
        $this->validate([
            'faviconFile' => 'image|max:10240',
        ]);
    }
    
    public function render()
    {
        return view('livewire.admin.settings.settings-index');
    }
}
