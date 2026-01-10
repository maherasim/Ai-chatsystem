<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Notification;

class GenerateTestNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:generate-test 
                            {--count=5 : Number of notifications to generate per user}
                            {--read=false : Whether notifications should be marked as read}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test notifications for admin and developer users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = (int) $this->option('count');
        $read = filter_var($this->option('read'), FILTER_VALIDATE_BOOLEAN);

        $this->info("Generating {$count} test notifications per user (read: " . ($read ? 'true' : 'false') . ")...");

        // Find admin user (by email)
        $admin = User::where('email', 'admin@gmail.com')->first();
        if (!$admin) {
            $this->error("Admin user not found (email: admin@gmail.com)");
            return 1;
        }

        // Find developer user (by email or type)
        $developer = User::where('email', 'developer@gmail.com')
            ->orWhere('type', 'developer')
            ->first();
        
        if (!$developer) {
            $this->error("Developer user not found");
            return 1;
        }

        $this->info("Found Admin: {$admin->name} (ID: {$admin->_id})");
        $this->info("Found Developer: {$developer->name} (ID: {$developer->_id})");

        // Notification types that are used in the system
        $notificationTypes = [
            'task_assigned',
            'task_started',
            'task_on_hold',
            'task_checked',
            'task_delayed',
            'task_rejected',
            'task_completed',
            'task_status_updated',
        ];

        // Sample messages
        $messages = [
            'Task assigned' => 'A new task has been assigned to you',
            'Task started' => 'Task has been started',
            'Task on hold' => 'Task has been put on hold',
            'Task checked' => 'Task has been checked',
            'Task delayed' => 'Task has been delayed',
            'Task rejected' => 'Task has been rejected',
            'Task completed' => 'Task has been completed',
            'Task status updated' => 'Task status has been updated',
        ];

        $created = 0;

        // Generate notifications for admin
        $this->info("\nGenerating notifications for Admin...");
        for ($i = 0; $i < $count; $i++) {
            $type = $notificationTypes[array_rand($notificationTypes)];
            $title = ucfirst(str_replace('_', ' ', $type));
            $message = $messages[$title] ?? "Test notification #{$i}";

            try {
                Notification::create([
                    'user_id' => (string) $admin->_id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message . " - Admin Notification #" . ($i + 1),
                    'data' => [
                        'project' => 'Test Project ' . ($i + 1),
                        'project_name' => 'Test Project ' . ($i + 1),
                        'ticket_code' => 'TKT-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                        'ticket_id' => 'ticket_' . ($i + 1),
                        'status' => 'new',
                        'old_status' => null,
                    ],
                    'read' => $read,
                    'created_by' => (string) $developer->_id,
                    'task_id' => 'task_' . ($i + 1),
                ]);
                $created++;
            } catch (\Exception $e) {
                $this->error("Failed to create notification for admin: " . $e->getMessage());
            }
        }

        // Generate notifications for developer
        $this->info("Generating notifications for Developer...");
        for ($i = 0; $i < $count; $i++) {
            $type = $notificationTypes[array_rand($notificationTypes)];
            $title = ucfirst(str_replace('_', ' ', $type));
            $message = $messages[$title] ?? "Test notification #{$i}";

            try {
                Notification::create([
                    'user_id' => (string) $developer->_id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message . " - Developer Notification #" . ($i + 1),
                    'data' => [
                        'project' => 'Test Project ' . ($i + 1),
                        'project_name' => 'Test Project ' . ($i + 1),
                        'ticket_code' => 'TKT-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                        'ticket_id' => 'ticket_' . ($i + 1),
                        'status' => 'new',
                        'old_status' => null,
                    ],
                    'read' => $read,
                    'created_by' => (string) $admin->_id,
                    'task_id' => 'task_' . ($i + 1),
                ]);
                $created++;
            } catch (\Exception $e) {
                $this->error("Failed to create notification for developer: " . $e->getMessage());
            }
        }

        $this->info("\n✅ Successfully created {$created} test notifications!");
        $this->info("   - Admin: {$count} notifications");
        $this->info("   - Developer: {$count} notifications");
        $this->info("   - Read status: " . ($read ? 'Read' : 'Unread'));

        return 0;
    }
}

