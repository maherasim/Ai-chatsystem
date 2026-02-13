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

if (!function_exists('storage_base_url')) {
    /**
     * Base URL for storage and download links (admin vs team domain).
     * When APP_USE_STATIC_STORAGE=true use APP_STORAGE_STATIC_URL (admin);
     * otherwise use current app URL (team domain).
     *
     * @return string Base URL without trailing slash
     */
    function storage_base_url()
    {
        if (config('app.use_static_storage') && config('app.storage_static_url')) {
            return config('app.storage_static_url');
        }
        return rtrim(config('app.url'), '/');
    }
}

if (!function_exists('todo_file_url')) {
    /**
     * Full URL for a todo attachment (or any storage file) for display/download.
     * Uses static URL on admin domain, current base URL on team domain.
     *
     * @param string $path Relative path (e.g. uploads/todos/xxx.png)
     * @return string Full URL to the file
     */
    function todo_file_url($path)
    {
        if (empty($path)) {
            return asset('build/img/profiles/avatar-16.jpg');
        }
        $path = ltrim($path, '/');
        $path = preg_replace('#^storage/#', '', $path);
        $base = storage_base_url();
        return $base . '/storage/' . $path;
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
