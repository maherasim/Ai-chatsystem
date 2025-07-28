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
    $security = User::where('user_id', auth()->id())->first();
    return view('Chats.settings', compact('setting'));
}

public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'dob' => 'required|date',
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

    // Save to database (single row, JSON field recommended)
    Setting::updateOrCreate([], [
        'login_backgrounds' => json_encode($storedImages),
    ]);

    return back()->with('success', 'Login background images updated.');
}




}
