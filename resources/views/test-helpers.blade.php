<!DOCTYPE html>
<html>
<head>
    <title>Helper Test</title>
</head>
<body>
    <h1>Testing Helper Functions</h1>
    
    <h2>1. storage_url() test:</h2>
    <p><?php echo storage_url('upload/users/test.png'); ?></p>
    
    <h2>2. user_avatar_url() test:</h2>
    <p><?php echo user_avatar_url(auth()->user()); ?></p>
    
    <h2>3. project_logo_url() test:</h2>
    <p><?php echo project_logo_url(null); // Should show fallback ?></p>
    
    <hr>
    <p>If you see URLs above without errors, helpers are working!</p>
</body>
</html>
