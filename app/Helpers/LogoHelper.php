<?php
use App\Models\Setting;

if (!function_exists('getLogoUrl')) {
    function getLogoUrl() {
        $setting = Setting::first();
        // $logo = $setting->images;
        // return $logo; // Return the logo URL from the database

        if ($setting) {
            $logo = $setting->image;
            return $logo; // Return the logo URL from the database
        } else {
            return asset('public/image/default.jpg'); // Return a default image URL if no logo is found in the database
        }
    }
}
