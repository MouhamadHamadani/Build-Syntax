<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Subscription</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f4f4f5; font-family: Arial, sans-serif; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background-color: #1E40AF; padding: 32px 40px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 0.5px; }
        .body { padding: 40px; color: #1f2937; }
        .body p { font-size: 16px; line-height: 1.7; margin: 0 0 20px; }
        .btn { display: inline-block; background-color: #1E40AF; color: #ffffff !important; padding: 14px 32px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 16px; margin: 8px 0 24px; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 32px 0; }
        .footer { padding: 0 40px 32px; color: #6b7280; font-size: 13px; line-height: 1.6; }
        .footer a { color: #1E40AF; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Build Syntax</h1>
        </div>

        <div class="body">
            <p>Hi {{ $name }},</p>

            <p>Thanks for subscribing to the <strong>Build Syntax Newsletter</strong>! We share insights on web development, design, and growing your business online.</p>

            <p>Please confirm your email address by clicking the button below:</p>

            <a href="{{ $confirmUrl }}" class="btn">Confirm My Subscription</a>

            <p style="color: #6b7280; font-size: 14px;">
                This link will activate your subscription. If you didn't sign up, you can safely ignore this email — or
                <a href="{{ $unsubscribeUrl }}" style="color: #6b7280;">unsubscribe here</a>.
            </p>

            <hr class="divider">

            <p style="font-size: 14px; color: #6b7280;">
                If the button above doesn't work, copy and paste this link into your browser:<br>
                <a href="{{ $confirmUrl }}" style="color: #1E40AF; word-break: break-all;">{{ $confirmUrl }}</a>
            </p>
        </div>

        <div class="footer">
            <p>You're receiving this because you signed up at <strong>buildsyntax.dev</strong>.</p>
            <p>Build Syntax &mdash; Beirut, Lebanon</p>
        </div>
    </div>
</body>
</html>