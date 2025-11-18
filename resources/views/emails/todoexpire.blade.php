<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $subject ?? 'ToDo Expired' }}</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family: Arial, Helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
  <!-- outer wrapper -->
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#f5f7fa;padding:20px 0;">
    <tr>
      <td align="center">

        <!-- main card (600px) -->
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e9e9e9;">
          
          <!-- header -->
          <tr>
            <td align="center" style="padding:28px 20px;background-color:#4361ee;background-image:none;color:#ffffff;">
              <h1 style="margin:0;font-size:22px;line-height:26px;font-weight:700;">ToDo Expired</h1>
              <p style="margin:6px 0 0;font-size:14px;line-height:20px;">One of your tasks is now due</p>
            </td>
          </tr>

          <!-- content -->
          <tr>
            <td style="padding:22px 26px;color:#212529;font-size:15px;line-height:22px;">
              
              <!-- badge -->
              <table role="presentation" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
                <tr>
                  <td style="background:#17a2b8;color:#ffffff;padding:7px 14px;border-radius:18px;font-weight:700;font-size:13px;display:inline-block;">
                    NOTIFICATION
                  </td>
                </tr>
              </table>

              <!-- greeting -->
              <p style="margin:0 0 12px;">Hello <strong>{{ $name }}</strong>,</p>

              <p style="margin:0 0 16px;">This is an automatic notification that one of your ToDo tasks has expired:</p>

              <!-- todo card -->
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #eaeaea;border-radius:6px;background:#ffffff; border-left: 4px solid #4361ee; background: #f8f9fa;">
                <tr>
                  <td style="padding:16px;">

                    <!-- Title -->
                    <div style="font-size:18px;font-weight:700;color:#212529;margin-bottom:8px;">
                      {{ $todo->title }}
                    </div>

                    <!-- Description -->
                    <div style="font-size:14px;color:#444;margin-bottom:14px;">
                      @if(!empty($todo->description) && is_array($todo->description))
                            <ul>
                                @foreach($todo->description as $desc)
                                    <li>{{ $desc }}</li>
                                @endforeach
                            </ul>
                        @else
                            
                        @endif
                    </div>

                    <!-- details grid (2 columns) -->
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="font-size:14px;color:#6c757d;  ">
                      <tr>
                        <!-- left column -->
                        <td valign="top" style="padding:6px 8px; width:50%; border-right:1px solid #f1f1f1;">
                          <div style="margin-bottom:8px;">
                            <strong style="color:#212529;font-weight:600;"><i>📅</i> &nbsp;&nbsp;Due on:</strong>
                            <span style="margin-top:4px;color:#6c757d;">{{ $todo->end_date ?? ($todo['end_date'] ?? '[Due Date]') }}</span>
                          </div>
</td>
<td valign="top" style="padding:6px 8px; width:50%; border-right:1px solid #f1f1f1;">
                         

                          <div>
                            <strong style="color:#212529;font-weight:600;"><i>⏰</i> &nbsp;&nbsp;Priority:</strong>
                            <span style="margin-top:4px;color:#6c757d;">{{ ucfirst($todo->priority ?? ($todo['priority'] ?? 'low')) }}</span>
                          </div>
                        </td>

                        
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>

              <!-- info box -->
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;">
                <tr>
                  <td style="background:#e3f2fd;padding:12px;border-left:4px solid #4cc9f0;border-radius:4px;">
                    <p style="margin:0;font-size:14px;color:#212529;"><strong>Next steps:</strong></p>
                    <p style="margin:8px 0 0;color:#6c757d;font-size:14px;">Please review this task and update its status or adjust the due date if necessary.</p>
                  </td>
                </tr>
              </table>

              <!-- button -->
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:18px;">
                <tr>
                  <td align="center">
                    <a href="https://teams.it-supportline.de/todos" target="_blank" style="background:#4361ee;color:#ffffff;padding:12px 22px;text-decoration:none;border-radius:6px;display:inline-block;font-weight:700;">
                      Open ToDo
                    </a>
                  </td>
                </tr>
              </table>

              <!-- closing -->
              <p style="margin:20px 0 0;color:#212529;font-size:15px;">
                Best regards,<br>
                <strong>Logiteam</strong>
              </p>

            </td>
          </tr>

          <!-- footer -->
          <tr>
            <td align="center" style="background:#f8f9fa;padding:14px 16px;font-size:13px;color:#6c757d;">
              © {{ date('Y') }} Logiteam. All rights reserved.
              <br>
              <a href="https://teams.it-supportline.de/todos" style="color:#4361ee;text-decoration:none;">Unsubscribe</a>
            </td>
          </tr>

        </table>
        <!-- /main card -->

      </td>
    </tr>
  </table>
</body>
</html>
