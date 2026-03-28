<?php

namespace App\Livewire\Admin\Settings;

use App\Livewire\Admin\AdminComponent;
use Livewire\Attributes\Layout;
use App\Models\SiteSetting;

#[Layout('layouts.admin')]
class SettingsIndex extends AdminComponent
{
    public $loading = true;
    public $saving = false;
    
    public $company_name = '';
    public $company_email = '';
    public $company_phone = '';
    public $company_address = '';
    public $company_description = '';
    public $logo_type = 'text';
    public $logo_image = '';
    public $favicon = '';
    public $facebook_url = '';
    public $twitter_url = '';
    public $linkedin_url = '';
    public $instagram_url = '';

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = SiteSetting::all()->keyBy('key');
        
        $this->company_name = $settings['company_name']->value ?? '';
        $this->company_email = $settings['company_email']->value ?? '';
        $this->company_phone = $settings['company_phone']->value ?? '';
        $this->company_address = $settings['company_address']->value ?? '';
        $this->company_description = $settings['company_description']->value ?? '';
        $this->logo_type = $settings['logo_type']->value ?? 'text';
        $this->logo_image = $settings['logo_image']->value ?? '';
        $this->favicon = $settings['favicon']->value ?? '';
        $this->facebook_url = $settings['facebook_url']->value ?? '';
        $this->twitter_url = $settings['twitter_url']->value ?? '';
        $this->linkedin_url = $settings['linkedin_url']->value ?? '';
        $this->instagram_url = $settings['instagram_url']->value ?? '';
        
        $this->loading = false;
    }

    public function save()
    {
        $this->saving = true;
        
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
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->saving = false;
        $this->dispatch('toast', ['message' => 'Settings saved successfully!', 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.admin.settings.settings-index');
    }
}
