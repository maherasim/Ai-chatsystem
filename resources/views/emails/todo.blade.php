<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Todo Assigned</title>
</head>
<body style="margin:0; padding:0; background:#f5f7fa; font-family: Arial, sans-serif;">

    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f5f7fa; padding:20px 0;">
        <tr>
            <td align="center">

                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg,#4361ee,#3a0ca3); padding:30px 20px; text-align:center; color:#ffffff;">
                            <h1 style="margin:0; font-size:24px;">New Todo Assigned</h1>
                            <p style="margin:5px 0 0;">You have been assigned new Todo</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px; color:#212529;">

                            <span style="display:inline-block; background:#4bb543; color:#fff; padding:8px 16px; border-radius:20px; font-weight:bold;">
                                NEW Todo
                            </span>

                            <p style="margin-top:20px;">Hello <strong>{{$name}}</strong>,</p>

                            <p>You have been assigned new todo that require your attention:</p>

                            <!-- Task List -->
                            <div style="margin:25px 0;">
                                
                                <div style="padding:12px 0; border-bottom:1px solid #eaeaea; display:flex;">
                                    <div style="margin-right:12px;">⬜</div>
                                    <div>
                                        <strong>Complete your Todo</strong>
                                        <div style="font-size:12px; color:#6c757d;">Due: {{ $todo->end_date }} | Priority: {{ $todo->priority }}</div>
                                    </div>
                                </div>
              
                            </div>

                            <!-- Info Box -->
                            <div style="background:#e8f5e9; padding:15px; border-left:4px solid #4bb543; border-radius:6px;">
                                <p style="margin:0;"><strong>Todo Details:</strong></p>
                                <p style="margin-top:8px;">
                                    These tasks have been assigned to you by <strong>{{$from}}</strong>.
                                    Please review them and update their status as you progress.
                                </p>
                            </div>

                            <!-- Button -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="https://logiteam.it-supportline.de/todos" style="background:#4361ee; color:#fff; padding:12px 24px; text-decoration:none; border-radius:6px; font-weight:bold; display:inline-block;">
                                    View All Tasks
                                </a>
                            </div>

                            <p>
                                Best regards,<br>
                                <strong>Logiteam Inc.</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f8f9fa; text-align:center; padding:20px; font-size:14px; color:#6c757d;">
                            © 2025 Logiteam. All rights reserved.<br>
                            <a href="https://logiteam.it-supportline.de/" style="color:#4361ee; text-decoration:none;">Unsubscribe</a>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
