<?php

/**
 * Standalone script to create a developer account
 * 
 * Usage: php create-developer.php
 * 
 * Or with custom values:
 * php create-developer.php "Developer Name" "developer@example.com" "password123"
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Get parameters from command line or use defaults
$name = $argv[1] ?? 'Developer';
$email = $argv[2] ?? 'developer@gmail.com';
$password = $argv[3] ?? '123456';

echo "Creating developer account...\n";
echo "Name: {$name}\n";
echo "Email: {$email}\n\n";

// Check if developer with this email already exists
$existingUser = User::where('email', $email)->first();
if ($existingUser) {
    echo "❌ Error: Developer with email '{$email}' already exists!\n";
    exit(1);
}

// Generate role-based user_id for developer
function generateRoleBasedUserId($type) {
    $map = [
        'subadmin' => 'sub',
        'developer' => 'dev',
        'employee' => 'emp',
    ];
    $prefix = $map[$type] ?? 'emp';

    $existingIds = User::where('type', $type)
        ->whereNotNull('user_id')
        ->pluck('user_id')
        ->toArray();

    $maxNumber = 999; // so first becomes 1000
    foreach ($existingIds as $eid) {
        if (is_string($eid) && strpos($eid, $prefix . '_') === 0) {
            $numPart = substr($eid, strlen($prefix) + 1);
            if (ctype_digit($numPart)) {
                $num = (int) $numPart;
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
            }
        }
    }

    $next = $maxNumber + 1;
    return $prefix . '_' . $next;
}

$userId = generateRoleBasedUserId('developer');

// Create developer account
try {
    $developer = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'type' => 'developer',
        'user_id' => $userId,
        'active' => true,
        'permissions' => [],
    ]);

    echo "✅ Developer account created successfully!\n\n";
    echo "Details:\n";
    echo "  Name: {$developer->name}\n";
    echo "  Email: {$developer->email}\n";
    echo "  User ID: {$developer->user_id}\n";
    echo "  Password: {$password}\n\n";
    echo "You can now login with these credentials.\n";
    
    exit(0);
} catch (\Exception $e) {
    echo "❌ Failed to create developer account: " . $e->getMessage() . "\n";
    exit(1);
}

