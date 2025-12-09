<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment</title>
</head>
<body style="margin: 0; padding: 20px; background-color: #f5f7fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #212529;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
        <div style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); color: white; padding: 30px 20px; text-align: center;">
            <h1 style="font-size: 24px; margin: 0 0 10px 0; font-weight: bold;">New Task Assigned</h1>
            <p style="margin: 0; font-size: 16px;">You have been assigned a new task</p>
        </div>
        
        <div style="padding: 30px;">
            <div style="display: inline-block; color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: bold; margin-bottom: 20px; background: #4bb543;">
                NEW TASK
            </div>
            
            <p style="margin: 0 0 15px 0; font-size: 16px; line-height: 1.6;">Hello <strong style="color: #212529;">{{ $developer->name }}</strong>,</p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; line-height: 1.6;">You have been assigned a new task that requires your attention:</p>
            
            <div style="background: #f8f9fa; border-left: 4px solid #4361ee; border-radius: 8px; padding: 20px; margin: 20px 0;">
                <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #212529;">
                    {{ $task->title ?? 'Task' }}
                    @if(!empty($priority))
                        <span style="display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: bold; margin-left: 10px; 
                            @if(strtolower($priority) === 'low')
                                background: #e8f5e9; color: #2e7d32;
                            @elseif(strtolower($priority) === 'medium')
                                background: #fff3e0; color: #e65100;
                            @else
                                background: #ffebee; color: #c62828;
                            @endif">
                            {{ ucfirst($priority) }} Priority
                        </span>
                    @endif
                </div>
                
                @if(!empty($task->description))
                    <div style="margin: 15px 0; color: #6c757d; line-height: 1.6; font-size: 14px;">
                        {{ $task->description }}
                    </div>
                @endif
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                    @if(!empty($teamTitle))
                        <div style="display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                            <strong style="color: #212529; margin-right: 5px;">Team:</strong> {{ $teamTitle }}
                        </div>
                    @endif
                    
                    @if($task->start_date)
                        <div style="display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                            <strong style="color: #212529; margin-right: 5px;">Start Date:</strong> {{ $task->start_date->format('M d, Y') }}
                        </div>
                    @endif
                    
                    @if($task->end_date)
                        <div style="display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                            <strong style="color: #212529; margin-right: 5px;">Due Date:</strong> {{ $task->end_date->format('M d, Y') }}
                        </div>
                    @endif
                    
                    @if($task->ticket)
                        <div style="display: flex; align-items: center; color: #6c757d; font-size: 14px;">
                            <strong style="color: #212529; margin-right: 5px;">Ticket:</strong> {{ $task->ticket->code ?? '' }} - {{ $task->ticket->title ?? '' }}
                        </div>
                    @endif
                </div>
            </div>
            
            <div style="background: #e8f5e9; border-radius: 8px; padding: 15px; margin: 20px 0; border-left: 4px solid #4bb543;">
                <p style="margin: 0 0 10px 0; font-weight: bold; color: #212529;"><strong>Task Details:</strong></p>
                <p style="margin: 0; color: #212529; line-height: 1.6;">This task has been assigned to you. Please review it and update its status as you progress.</p>
            </div>
            
            <div style="text-align: center; margin: 25px 0;">
                <a href="https://logiteam.it-supportline.de/tasks" style="display: inline-block; background: #4361ee; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px;">
                    View All Tasks
                </a>
            </div>
            
            <p style="margin: 0 0 25px 0; font-size: 14px; color: #6c757d; text-align: center;">Click the button above to access your tasks dashboard and view all assigned tasks.</p>
            
            <p style="margin: 25px 0 0 0; font-size: 14px; line-height: 1.6;">Best regards,<br>
            <strong style="color: #212529;">Your Team</strong></p>
        </div>
        
        <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #6c757d; border-top: 1px solid #eaeaea;">
            <p style="margin: 0 0 10px 0;">© {{ date('Y') }} Logiteam. All rights reserved.</p>
            <p style="margin: 0;">This is an automated notification. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
