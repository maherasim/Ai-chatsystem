<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} - Welcome</title>
  <style>
    /* Basic, inline-safe email styles */
    .wrapper { width: 100%; background: #f5f7fb; padding: 24px 0; }
    .container { width: 100%; max-width: 640px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 6px 24px rgba(0,0,0,0.05); }
    .header { background: #111827; color: #ffffff; padding: 20px 24px; font-family: Arial, Helvetica, sans-serif; }
    .brand { font-size: 20px; font-weight: 700; letter-spacing: .3px; }
    .content { padding: 24px; color: #1f2937; font-family: Arial, Helvetica, sans-serif; line-height: 1.6; }
    .h1 { margin: 0 0 8px; font-size: 22px; color: #111827; }
    .muted { color: #6b7280; font-size: 14px; margin-top: 0; }
    .card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin: 16px 0; }
    .row { display: block; margin: 8px 0; }
    .label { color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: .3px; }
    .value { color: #111827; font-size: 14px; font-weight: 600; }
    .btn { display: inline-block; background: #10b981; color: #ffffff !important; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: 700; font-size: 14px; }
    .footer { padding: 16px 24px; color: #6b7280; font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
    .hr { border: 0; height: 1px; background: #e5e7eb; margin: 20px 0; }
  </style>
  <!--[if mso]>
  <style>
    .content, .header, .footer { font-family: Arial, sans-serif !important; }
  </style>
  <![endif]-->
  </head>
  <body style="margin:0; padding:0;">
    <div class="wrapper">
      <div class="container">
        <div class="header">
          <div class="brand">{{ config('app.name') }}</div>
        </div>
        <div class="content">
          <h1 class="h1">Welcome {{ $user->name }}!</h1>
          <p class="muted">Your account has been created{{ $isSubadmin ? ' (Subadmin)' : '' }}. Below are your credentials and a quick link to sign in.</p>

          <div class="card">
            <div class="row"><span class="label">Role</span><br><span class="value">{{ ucfirst($user->type ?? 'user') }}</span></div>
            @if(!$isSubadmin)
            <div class="row"><span class="label">User ID</span><br><span class="value">{{ $user->user_id }}</span></div>
            @endif
            <div class="row"><span class="label">Email</span><br><span class="value">{{ $user->email }}</span></div>
            <div class="row"><span class="label">Temporary Password</span><br><span class="value">{{ $rawPassword }}</span></div>
          </div>

          <p style="margin: 16px 0;">Use the button below to access your dashboard:</p>
          <p>
            <a href="{{ $loginLink }}" class="btn" target="_blank" rel="noopener">Go to Login</a>
          </p>

          <hr class="hr" />
          <p class="muted">For security, please change your password after your first login.</p>
        </div>
        <div class="footer">
          &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
      </div>
    </div>
  </body>
  </html>

