<?php

if (!function_exists('storage_url')) {
    /**
     * Generate a URL for a file stored in Laravel storage.
     * Handles both relative and absolute paths correctly.
     * 
     * @param string|null $path The path to the file
     * @param string|null $fallback Fallback image path if the main path is empty
     * @return string The complete URL to the file
     */
    function storage_url($path = null, $fallback = null)
    {
        // If path is empty, use fallback or default avatar
        if (empty($path)) {
            return $fallback ? asset($fallback) : asset('build/img/profiles/avatar-16.jpg');
        }

        // Remove leading slashes and 'storage/' prefix if already present
        $path = ltrim($path, '/');
        $path = preg_replace('#^storage/#', '', $path);
        
        // Return the proper asset URL
        return asset('storage/' . $path);
    }
}

if (!function_exists('project_logo_url')) {
    /**
     * Generate a URL for a project logo.
     * 
     * @param object|null $project The project object
     * @param string|null $fallback Fallback logo path
     * @return string The complete URL to the logo
     */
    function project_logo_url($project = null, $fallback = null)
    {
        if ($project && !empty($project->logo_path)) {
            return storage_url($project->logo_path);
        }
        
        return $fallback ? asset($fallback) : asset('build/img/yekbon.svg');
    }
}

if (!function_exists('user_avatar_url')) {
    /**
     * Generate a URL for a user's profile image.
     * 
     * @param object|null $user The user object
     * @param string|null $fallback Fallback avatar path
     * @return string The complete URL to the avatar
     */
    function user_avatar_url($user = null, $fallback = null)
    {
        if ($user) {
            if (!empty($user->profile_image)) {
                return storage_url($user->profile_image);
            }
            if (!empty($user->image)) {
                return storage_url($user->image);
            }
        }
        
        return $fallback ? asset($fallback) : asset('build/img/profiles/avatar-16.jpg');
    }
}
