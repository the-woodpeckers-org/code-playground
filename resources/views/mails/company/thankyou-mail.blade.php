<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        table {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        td {
            padding: 20px;
            line-height: 1.6;
        }

        h1, h2, h3 {
            margin: 0;
            font-weight: normal;
        }

        .header {
            background-color: #007BFF;
            color: #ffffff;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            padding: 30px 20px;
        }

        .content {
            font-size: 16px;
            color: #555;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
            color: #666;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .company-logo {
            max-width: 100px;
            margin-top: 10px;
        }

        .company-name {
            font-size: 18px;
            color: #007BFF;
            margin-top: 10px;
        }

        .cta {
            font-size: 16px;
            color: #007BFF;
            font-weight: bold;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .header h1 {
                font-size: 20px;
            }

            .content, .footer {
                padding: 15px;
            }

            .company-name {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <table cellpadding="0" cellspacing="0">
        <tr class="header">
            <td>
                <h1>Notification</h1>
            </td>
        </tr>

        <tr>
            <td class="content">
                <h2>Hello, {{ $user->name }}</h2>
                <p>Thank you for registering with Code Playground! We will review your profile and send feedback once the procedure is completed.</p>
                <p>This is an automated message.</p>
                <p>If you have any questions, feel free to reach out to us at any time.</p>
                <p>Thank you!</p>
                <p class="cta">Best Regards,<br>Code Playground Team</p>
            </td>
        </tr>

        <tr class="footer">
            <td>
                <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="company-logo">
                <h3 class="company-name">Code Playground</h3>
                <p>&copy; 2024 Code Playground. All rights reserved.</p>
            </td>
        </tr>
    </table>

</body>

</html>
