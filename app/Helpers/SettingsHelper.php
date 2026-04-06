<?php

namespace App\Helpers;

use App\Models\SiteSetting;

class SettingsHelper
{
    public static function getAll(): array
    {
        $settings = SiteSetting::all()->keyBy('setting_key');
        
        return [
            'company_name' => $settings['company_name']->setting_value ?? 'DigitalOrb',
            'company_email' => $settings['company_email']->setting_value ?? '',
            'company_phone' => $settings['company_phone']->setting_value ?? '',
            'company_address' => $settings['company_address']->setting_value ?? '',
            'company_description' => $settings['company_description']->setting_value ?? '',
            'logo_type' => $settings['logo_type']->setting_value ?? 'text',
            'logo_image' => $settings['logo_image']->setting_value ?? '',
            'favicon' => $settings['favicon']->setting_value ?? '',
            'facebook_url' => $settings['facebook_url']->setting_value ?? '',
            'twitter_url' => $settings['twitter_url']->setting_value ?? '',
            'linkedin_url' => $settings['linkedin_url']->setting_value ?? '',
            'instagram_url' => $settings['instagram_url']->setting_value ?? '',
            'logo_text' => $settings['logo_text']->setting_value ?? '',
        ];
    }

    public static function get(string $key, $default = null)
    {
        $settings = self::getAll();
        return $settings[$key] ?? $default;
    }
}
