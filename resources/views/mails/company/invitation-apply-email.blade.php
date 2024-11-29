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
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto 20px;
        }

        h1 {
            font-size: 28px;
            color: #28a745;
            margin-bottom: 15px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin: 10px 0;
        }

        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-weight: 600;
        }

        .cta-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .divider {
            width: 60px;
            height: 4px;
            background-color: #28a745;
            margin: 20px auto;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="logo">

        <h1>You're Invited to Join {{$user_company->name}}</h1>
        <div class="divider"></div>

        <p>Dear {{ $invited_user->name }},</p>
        <p>We were highly impressed by your skills showcased during <strong>[{{ $job->location }}]</strong>. </p>
        <p>It is our pleasure to invite you to join <strong>{{$user_company->name}}</strong> as a <strong>{{$job->title }}</strong>.</p> 
        <p>If you’re interested, kindly apply through the link below at your earliest convenience.</p>

        <a href="http://live-code-editor.test/Job-detail/{{$job->id}}" target="_blank" class="cta-button">Apply Now</a>

        <p>We are eager to have you on board. Looking forward to your response!</p>
        <p>Warm regards,</p>

        <div class="footer">
            <p>
                <strong>{{$user_company->name}}</strong> <br>
                {{$job->title}} <br>
                {{$user_company->name}}
            </p>
            <p><a href="http://live-code-editor.test" target="_blank">Visit our website</a></p>
        </div>
    </div>

</body>

</html>
