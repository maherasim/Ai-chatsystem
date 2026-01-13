<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Admin account
        \App\Models\User::create([
            'name' => 'Admin',
            'user_id' => 'admin_1000',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
        ]);

        // Create Developer account
        $developerUserId = $this->generateRoleBasedUserId('developer');
        \App\Models\User::create([
            'name' => 'John Doe',
            'user_id' => $developerUserId,
            'type' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('123456'), // Hash the password
            'active' => true,
            'permissions' => [],
        ]);

        // $this->call([
        //     KurdishKeywordsSeeder::class,
        // ]);
    }

    /**
     * Generate the next role-based user_id.
     * subadmin => sub_1000+n, developer => dev_1000+n, employee => emp_1000+n
     */
    private function generateRoleBasedUserId($type)
    {
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
}
