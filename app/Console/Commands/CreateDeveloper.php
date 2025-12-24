<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateDeveloper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:developer 
                            {--name=Developer : Developer name}
                            {--email=developer@gmail.com : Developer email}
                            {--password=123456 : Developer password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a developer account in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Check if developer with this email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $this->error("Developer with email '{$email}' already exists!");
            return 1;
        }

        // Generate role-based user_id for developer
        $userId = $this->generateRoleBasedUserId('developer');

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

            $this->info("✓ Developer account created successfully!");
            $this->line("  Name: {$developer->name}");
            $this->line("  Email: {$developer->email}");
            $this->line("  User ID: {$developer->user_id}");
            $this->line("  Password: {$password}");
            $this->newLine();
            $this->comment("You can now login with these credentials.");

            return 0;
        } catch (\Exception $e) {
            $this->error("Failed to create developer account: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Generate the next role-based user_id for developer.
     * developer => dev_1000+n
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

