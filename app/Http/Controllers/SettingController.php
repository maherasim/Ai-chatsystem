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
    $selected_login_background = $setting->selected_login_background ?? null;

    $chat_backgrounds = $setting && $setting->chat_backgrounds
        ? json_decode($setting->chat_backgrounds, true)
        : [];
    $selected_chat_background = $setting->selected_chat_background ?? null;

    return view('Chats.settings', compact('setting', 'images', 'chat_backgrounds','chat_sounds','selected_login_background', 'selected_chat_background'));
}
public function indexsetting()
{
    $headers = Setting::all();
    $setting = Setting::first();
    return view('index', compact('setting','headers'));
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
    //dd($request->all());
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

    $user = User::where('id', auth()->id())->first();
    // Upload image if provided
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        
        // Save directly to public/upload/users/
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.]/', '', $file->getClientOriginalName());
        $publicPath = 'upload/users/' . $filename;
        
        // Ensure directory exists
        if (!file_exists(public_path('upload/users'))) {
            mkdir(public_path('upload/users'), 0755, true);
        }
        
        // Move the uploaded file to public directory
        $file->move(public_path('upload/users'), $filename);
        
        $setting->image = $publicPath;
        $user->image = $publicPath;
        // Clear old profile_image to ensure consistency
        $user->profile_image = null;
    }

    $setting->first_name = $request->first_name;
    $setting->dob = $request->dob;
    $setting->save();

    
    $user->name = $request->first_name;
    $user->save();

    return back()->with('success', 'Settings updated!');
}
public function updateEmail(Request $request)
{
        $user = auth()->user();

        $request->validate([
            'new_email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($user) {
                    // Allow keeping the same email
                    if ($user && $user->email === $value) {
                        return;
                    }

                    try {
                        $objectId = new \MongoDB\BSON\ObjectId($user->_id ?? $user->id);
                        $exists = \App\Models\User::where('email', $value)
                            ->where('_id', '!=', $objectId)
                            ->exists();
                    } catch (\Throwable $e) {
                        $exists = \App\Models\User::where('email', $value)
                            ->where('_id', '!=', ($user->_id ?? $user->id))
                            ->exists();
                    }

                    if ($exists) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
        ]);

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
public function saveScreenLock(Request $request)
{
    $request->validate([
        'screen_lock' => 'nullable|in:on,1,true',
        'screen_lock_minutes' => 'nullable|integer|min:1|max:1440',
    ]);

    $setting = Setting::firstOrNew(['user_id' => auth()->id()]);
    $enabled = $request->has('screen_lock');
    $setting->screen_lock = $enabled;
    if ($enabled) {
        $minutes = $request->input('screen_lock_minutes');
        if ($minutes !== null) {
            $setting->screen_lock_minutes = (int) $minutes;
        }
    }
    $setting->save();

    return back()->with('success', 'Screen lock preferences saved.');
}

/**
 * Set server-side lock flag (called when client auto-locks).
 */
public function lockScreen(Request $request)
{
    if (!auth()->check()) {
        return response()->json(['ok' => false], 401);
    }
    $request->session()->put('screen_locked', true);
    return response()->json(['ok' => true]);
}

public function unlockScreen(Request $request)
{
    $request->validate([
        'password' => 'nullable|string',
        'pin' => 'nullable|string',
    ]);

    $user = auth()->user();
    if (!$user) {
        return response()->json(['ok' => false, 'message' => 'Unauthorized'], 401);
    }

    // Check password - PIN input is treated as password
    $passwordToCheck = $request->filled('pin') ? $request->pin : ($request->filled('password') ? $request->password : null);
    
    if ($passwordToCheck && \Illuminate\Support\Facades\Hash::check($passwordToCheck, $user->password)) {
        // clear server lock flag
        $request->session()->forget('screen_locked');
        return response()->json(['ok' => true]);
    }

    return response()->json(['ok' => false, 'message' => 'Invalid password'], 422);
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

    $userId = auth()->id();

    // Fetch existing settings to allow partial updates and replacements by index
    $setting = Setting::firstOrNew(['user_id' => $userId]);
    $existing = json_decode($setting->login_backgrounds ?? '[]', true);
    if (!is_array($existing)) {
        $existing = [];
    }

    $files = $request->file('images'); // expected associative array keyed by slot index
    $changes = 0;
    if (is_array($files)) {
        foreach ($files as $index => $file) {
            if ($file && $file->isValid()) {
                $filename = 'login_' . $userId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/login_backgrounds', $filename);
                $existing[(int)$index] = 'storage/login_backgrounds/' . $filename;
                $changes++;
            }
        }
    }

    if ($changes === 0) {
        return back()->with('info', 'No new login background images selected.');
    }

    $setting->login_backgrounds = json_encode($existing);
    $setting->save();

    return back()->with('success', 'Login background images updated successfully.');
}
public function selectLoginBackground(Request $request)
{
    $request->validate([
        'index' => 'required|integer|min:0|max:5',
    ]);
    $userId = auth()->id();
    $setting = Setting::firstOrNew(['user_id' => $userId]);
    $idx = (int)$request->input('index');
    $setting->selected_login_background = $idx;
    $setting->save();
    return back()->with('success', 'Login background selected.');
}

public function selectChatBackground(Request $request)
{
    $request->validate([
        'index' => 'required|integer|min:0|max:5',
    ]);
    $userId = auth()->id();
    $setting = Setting::firstOrNew(['user_id' => $userId]);
    $idx = (int)$request->input('index');
    $setting->selected_chat_background = $idx;
    $setting->save();
    return back()->with('success', 'Chat background selected.');
}
 public function uploadchatBackground(Request $request)
{
    $request->validate([
        'chat_images.*' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
    ]);

    $userId = auth()->id();

    $setting = Setting::firstOrNew(['user_id' => $userId]);
    $existing = json_decode($setting->chat_backgrounds ?? '[]', true);
    if (!is_array($existing)) {
        $existing = [];
    }

    $files = $request->file('chat_images'); // expected associative array keyed by slot index
    $changes = 0;
    if (is_array($files)) {
        foreach ($files as $index => $file) {
            if ($file && $file->isValid()) {
                $filename = 'chat_' . $userId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/chat_backgrounds', $filename);
                $existing[(int)$index] = 'storage/chat_backgrounds/' . $filename;
                $changes++;
            }
        }
    }

    if ($changes === 0) {
        return back()->with('warning', 'No chat background images were selected.');
    }

    $setting->chat_backgrounds = json_encode($existing);
    $setting->save();

    return back()->with('success', 'Chat background images updated successfully.');
}

 
public function savePolicy(Request $request) 
{
  //  dd($request->all());
    $validated = $request->validate([
        'policy_term' => 'required|string',
        'increment_version' => 'boolean',
        'require_accept' => 'nullable|boolean',
    ]);

    $setting = Setting::firstOrNew(['user_id' => auth()->id()]);
    $setting->policy_term = $validated['policy_term'];
    $setting->require_accept = $validated['require_accept'] ?? false;

    if ($validated['increment_version']) {
        $setting->policy_version = (int)($setting->policy_version ?? 0) + 1;
        $setting->require_accept = true; // force accept if version changed
    }

    $setting->save();

    return redirect()->back()->with('success', 'Policy updated successfully.');
}


public function saveAgreement(Request $request)
{
    //dd($request->all());
    $validated = $request->validate([
        'agreement_text' => 'required|string',
        'agreement_increment_version' => 'boolean',
        'agreement_require_accept' => 'nullable|boolean',
    ]);

    $setting = Setting::firstOrNew(['user_id' => auth()->id()]);
    $setting->agreement_text = $validated['agreement_text'];
    $setting->agreement_require_accept = $validated['agreement_require_accept'] ?? false;

    if ($validated['agreement_increment_version']) {
        $setting->agreement_version = (int)($setting->agreement_version ?? 0) + 1;
        $setting->agreement_require_accept = true;
    }

    $setting->save();

    return redirect()->back()->with('success', 'Agreement updated successfully.');
}
public function getPolicy(Request $request)
{
    // Fetch the latest record with relevant fields
    $setting = \App\Models\Setting::select([
        'policy_term',
        'require_accept',
        'policy_version'
    ])->latest('id')->first();

    return response()->json([
        'policy_term' => $setting->policy_term ?? '',
        'require_accept' => (bool)($setting->require_accept ?? false),
        'policy_version' => (int)($setting->policy_version ?? 0),
    ]);
}


// GET /api/settings/agreement
public function getAgreement(Request $request)
{
    // Get latest setting record with only the necessary fields
    $setting = \App\Models\Setting::select([
        'agreement_text',
        'agreement_require_accept',
        'agreement_version'
    ])->latest('id')->first();

    return response()->json([
        'agreement_text' => $setting->agreement_text ?? '',
        'agreement_require_accept' => (bool)($setting->agreement_require_accept ?? false),
        'agreement_version' => (int)($setting->agreement_version ?? 0),
    ]);
}


}
