<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application Notification</title>
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
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            color: #28a745;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin: 15px 0;
        }

        .letter-content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            border: 1px solid #ddd;
            margin-top: 20px;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
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
        <div class="email-header">
            <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="h-12" style="max-width: 120px;">
            </div>

        <h2>Hello, {{$user_company->name}}</h2>

        <div class="divider"></div>

        <p>You have received a new application from <a href="http://live-code-editor.test/View-User/{{ $userProfile->id }}" target="_blank"><strong>{{ $userApply->name }}</strong></a>.</p>

        <p><strong>Application Letter:</strong></p>

        <div class="letter-content">
            <p>{{$application}}</p>
        </div>

        <div class="footer">
            <p>Thank you for your attention!</p>
            <p>If you have any questions or need further information, please feel free to reach out.</p>
        </div>
    </div>

</body>

</html>
