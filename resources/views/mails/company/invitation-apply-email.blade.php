<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 30px;
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin: 15px 0;
        }

        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .divider {
            width: 50px;
            height: 3px;
            background-color: #28a745;
            margin: 20px auto;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <!-- Logo at the top -->
        <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="logo">

        <h1>Invitation to Join {{$user_company->name}}</h1>
        <p>Dear {{ $invited_user->name }},</p>
        <p>
            Through the recent <strong>[{{ $job->location}}/{{$contest->title}}]</strong>, we were very impressed by your skills and performance.
            We would like to invite you to join us at <strong>{{$user_company->name}}</strong> as a <strong>{{$job->title }}</strong>.
        </p>
        <p>
            If you’re interested, please apply via
            <a href="http://live-code-editor.test/Job-detail/{{$job->id}}" target="_blank">this link</a> at your earliest convenience.
        </p>
        <p>We look forward to your response!</p>
        <p>Best regards,</p>
        <div class="footer">
            <p>
                [{{ $user_company->name }}] <br>
                [{{ $job->title }}] <br>
                [{{$user_company->name}}]
            </p>
        </div>

    </div>

</body>

</html>