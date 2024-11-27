<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorry Message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 1000px;
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
            font-size: 32px;
            color: #ff4d4d;
            margin-bottom: 20px;
            font-weight: 700;
        }
        p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin: 15px 0;
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
            background-color: #ff4d4d;
            margin: 20px auto;
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
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="logo">
    
        <h1>We're Sorry, {{$user->name}}</h1>
        <div class="divider"></div>
        <p>We regret that we couldn't proceed with your registration at this time, but we hope to see you again soon.</p>
        <p>If you have any questions or would like to update your information, please don't hesitate to contact us.</p>
        <div class="footer">
            <p>Thank you for being a part of Code Playground!</p>
            <p>Best regards,<br> The Code Playground Team</p>
            <p><a href="#">Visit our website</a> to learn more about our services.</p>
        </div>
    </div>

</body>
</html>
