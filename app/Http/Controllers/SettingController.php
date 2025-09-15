<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;


class SettingController extends Controller
{

public function showSettingsForm()
{
    $setting = Setting::where('user_id', auth()->id())->first();
    $chat_sounds = $setting && $setting->chat_sounds
        ? json_decode($setting->chat_sounds, true)
        : [];
    $images = $setting && $setting->login_backgrounds
        ? json_decode($setting->login_backgrounds, true)
        : [];

    $chat_backgrounds = $setting && $setting->chat_backgrounds
        ? json_decode($setting->chat_backgrounds, true)
        : [];

    return view('Chats.settings', compact('setting', 'images', 'chat_backgrounds','chat_sounds'));
}
 public function uploadChatSounds(Request $request) 
{
    //dd($request->all());
    $request->validate([
        'chat_sounds.*' => 'required|file|mimes:mp3,wav,ogg|max:2048',
    ]);

    $userId = $request->input('user_id');
    $chatSounds = $request->file('chat_sounds'); // Note: plural

    $storedPaths = [];

    foreach ($chatSounds as $file) {
        if ($file && $file->isValid()) {
            $filename = 'sound_' . $userId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/chat_sounds', $filename);
            $storedPaths[] = str_replace('public/', 'storage/', $path);
        }
    }

    // Store all in one field as JSON, if needed
    Setting::updateOrCreate(
        ['user_id' => $userId],
        ['chat_sounds' => json_encode($storedPaths)]
    );

    return back()->with('success', 'Chat sounds uploaded successfully.');
}

public function uploadNotificationSounds(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'notification_sounds.*' => 'nullable|file|mimes:mp3,wav,ogg|max:20480',
    ]);

    $userId = $request->input('user_id');
    $files = $request->file('notification_sounds', []);

    // Fetch existing setting and sounds
    $setting = \App\Models\Setting::firstOrNew(['user_id' => $userId]);
    $existing = json_decode($setting->notification_sounds ?? '[]', true);
    if (!is_array($existing)) {
        $existing = [];
    }

    // Preserve index association for 4 slots
    for ($index = 0; $index < 4; $index++) {
        if (isset($files[$index]) && $files[$index] && $files[$index]->isValid()) {
            $file = $files[$index];
            $filename = 'notif_' . $userId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/notification_sounds', $filename);
            $existing[$index] = str_replace('public/', 'storage/', $path);
        }
    }

    $setting->notification_sounds = json_encode($existing);
    $setting->save();

    return back()->with('success', 'Notification sounds uploaded.');
}



public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Get setting for the current user (1 setting per user)
    $setting = Setting::where('user_id', auth()->id())->first();

    if (!$setting) {
        $setting = new Setting();
        $setting->user_id = auth()->id();
    }

    // Upload image if provided
    if ($request->hasFile('image')) {
        $setting->image = $request->file('image')->store('uploads/chat_users', 'public');
    }

    $setting->first_name = $request->first_name;
    $setting->dob = $request->dob;
    $setting->save();

    return back()->with('success', 'Settings updated!');
}
public function updateEmail(Request $request)
{
    $request->validate([
        'new_email' => 'required|email|unique:users,email',
    ]);

    $user = auth()->user();
    $user->email = $request->new_email;
    $user->save();

    return back()->with('success', 'Email updated successfully.');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->old_password, $user->password)) {
        return back()->with('error', 'Old password is incorrect.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}
public function toggleScreenLock(Request $request)
{
    $user = auth()->user();
    $user->screen_lock = $request->has('screen_lock');
    $user->save();

    return back()->with('success', 'Screen lock setting updated.');
}

public function toggleTwoFactor(Request $request)
{
    $user = auth()->user();
    $user->two_factor_auth = $request->has('two_factor_auth');
    $user->save();

    return back()->with('success', 'Two-factor authentication setting updated.');
}
public function uploadAppLogo(Request $request)
{
    $request->validate([
        'app_logo' => 'required|mimes:png,svg|max:2048',
    ]);

    $userId = auth()->id();

    // Get or create setting for the logged-in user
    $setting = Setting::where('user_id', $userId)->first();
    if (!$setting) {
        $setting = new Setting();
        $setting->user_id = $userId;
    }

    if ($request->hasFile('app_logo')) {
        $file = $request->file('app_logo');
        $filename = 'app_logo_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads/settings', $filename);
        $setting->app_logo = 'storage/uploads/settings/' . $filename;
    }

    $setting->save();

    return back()->with('success', 'App logo updated successfully.');
}
public function uploadFavIcon(Request $request)
{
    $request->validate([
        'favicon' => 'required|mimes:png,svg|max:2048',
    ]);

    $userId = auth()->id();

    // Fetch or create setting for user
    $setting = Setting::where('user_id', $userId)->first();
    if (!$setting) {
        $setting = new Setting();
        $setting->user_id = $userId;
    }

    if ($request->hasFile('favicon')) {
        $file = $request->file('favicon');
        $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads/settings', $filename);
        $setting->favicon = 'storage/uploads/settings/' . $filename;
    }

    $setting->save();

    return back()->with('success', 'FavIcon updated successfully.');
}
public function updateAppTitle(Request $request)
{
    $request->validate([
        'app_name' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ]);

    $setting = Setting::firstOrNew(['user_id' => $request->user_id]);
    $setting->app_name = $request->app_name;
    $setting->user_id = $request->user_id;
    $setting->save();

    return back()->with('success', 'App name updated successfully.');
}

public function toggleReactionNotification(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $setting = Setting::firstOrNew(['user_id' => $request->user_id]);
    $setting->show_reaction_notifications = $request->has('show_reaction_notifications');
    $setting->user_id = $request->user_id;
    $setting->save();

    return back()->with('success', 'Reaction notification setting updated.');
}
 public function uploadLoginBackground(Request $request)
{
    $request->validate([
        'images.*' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
    ]);

    $userId = auth()->id(); // Ensure the user is authenticated
    $storedImages = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            if ($file) {
                $filename = 'login_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/login_backgrounds', $filename);
                $storedImages[] = 'storage/login_backgrounds/' . $filename;
            } else {
                $storedImages[] = null;
            }
        }
    }

    // Save to settings table for this user
    Setting::updateOrCreate(
        ['user_id' => $userId],
        ['login_backgrounds' => json_encode($storedImages)]
    );

    return back()->with('success', 'Login background images updated successfully.');
}
 public function uploadchatBackground(Request $request)
{
    $request->validate([
        'chat_images.*' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
    ]);

    $userId = auth()->id();
    $storedImages = [];

    if ($request->hasFile('chat_images')) {
        foreach ($request->file('chat_images') as $file) {
            if ($file) {
                $filename = 'chat_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/chat_backgrounds', $filename);
                $storedImages[] = 'storage/chat_backgrounds/' . $filename;
            }
        }
    }

    // Optional: if no new images, don’t overwrite
    if (empty($storedImages)) {
        return back()->with('warning', 'No chat background images were selected.');
    }

    Setting::updateOrCreate(
        ['user_id' => $userId],
        ['chat_backgrounds' => json_encode($storedImages)]
    );

    return back()->with('success', 'Chat background images updated successfully.');
}

public function savePolicy(Request $request)
{
    $request->validate([
        'html' => 'required|string',
        'increment_version' => 'boolean',
    ]);
    $setting = Setting::firstOrNew(['user_id' => auth()->id()]);
    $setting->policy_html = $request->html;
    if ($request->boolean('increment_version')) {
        $setting->policy_version = (int)($setting->policy_version ?? 0) + 1;
        $setting->require_accept_on_next_login = true;
    }
    $setting->save();
    return response()->json(['ok' => true, 'version' => (int)($setting->policy_version ?? 0)]);
}
public function saveAgreement(Request $request)
{
    $request->validate([
        'html' => 'required|string',
        'increment_version' => 'boolean',
    ]);
    $setting = Setting::firstOrNew(['user_id' => auth()->id()]);
    $setting->agreement_html = $request->html;
    if ($request->boolean('increment_version')) {
        $setting->agreement_version = (int)($setting->agreement_version ?? 0) + 1;
        $setting->require_accept_on_next_login = true;
    }
    $setting->save();
    return response()->json(['ok' => true, 'version' => (int)($setting->agreement_version ?? 0)]);
}


}
