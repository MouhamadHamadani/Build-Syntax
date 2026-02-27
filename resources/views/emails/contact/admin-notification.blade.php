<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Submission</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f4f4f5; font-family: Arial, sans-serif; }
        .wrapper { max-width: 640px; margin: 40px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .header { background-color: #1E40AF; padding: 28px 40px; }
        .header h1 { color: #ffffff; margin: 0; font-size: 20px; }
        .header p { color: #bfdbfe; margin: 4px 0 0; font-size: 14px; }
        .body { padding: 36px 40px; }
        .badge { display: inline-block; background: #dbeafe; color: #1E40AF; padding: 4px 12px; border-radius: 99px; font-size: 13px; font-weight: bold; margin-bottom: 24px; }
        .field { margin-bottom: 20px; }
        .field .label { font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; margin-bottom: 4px; }
        .field .value { font-size: 16px; color: #111827; line-height: 1.5; }
        .field .value a { color: #1E40AF; text-decoration: none; }
        .message-box { background: #f9fafb; border-left: 4px solid #1E40AF; padding: 16px 20px; border-radius: 0 6px 6px 0; margin-top: 4px; }
        .message-box p { margin: 0; font-size: 15px; color: #1f2937; line-height: 1.7; white-space: pre-wrap; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 28px 0; }
        .meta { display: flex; gap: 32px; }
        .footer { background: #f9fafb; padding: 20px 40px; color: #6b7280; font-size: 13px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>🔔 New Contact Submission</h1>
            <p>Received {{ $submission->created_at->format('M d, Y \a\t H:i') }} UTC</p>
        </div>

        <div class="body">
            <span class="badge">{{ $submission->priority }} priority</span>

            <div class="field">
                <div class="label">Name</div>
                <div class="value">{{ $submission->name }}</div>
            </div>

            <div class="field">
                <div class="label">Email</div>
                <div class="value">
                    <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                </div>
            </div>

            @if ($submission->phone)
            <div class="field">
                <div class="label">Phone</div>
                <div class="value">
                    <a href="tel:{{ $submission->phone }}">{{ $submission->phone }}</a>
                </div>
            </div>
            @endif

            @if ($submission->company)
            <div class="field">
                <div class="label">Company</div>
                <div class="value">{{ $submission->company }}</div>
            </div>
            @endif

            <hr class="divider">

            <div class="field">
                <div class="label">Project Type</div>
                <div class="value">{{ $projectType }}</div>
            </div>

            @if ($submission->budget_range)
            <div class="field">
                <div class="label">Budget Range</div>
                <div class="value">{{ $submission->budget_range }}</div>
            </div>
            @endif

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">
                    <p>{{ $submission->message }}</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Submission ID: #{{ $submission->id }} &mdash; Build Syntax Admin</p>
        </div>
    </div>
</body>
</html>