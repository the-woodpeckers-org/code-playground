<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 5px;">
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #007BFF; color: #ffffff; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                <h1 style="margin: 0; font-size: 24px;">Notification</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h2 style="font-size: 20px; color: #007BFF;">Hello, {{ $user->name }}</h2>
                <p style="font-size: 16px; line-height: 1.5;">
                    We've reviewed your information and noticed a few areas that require edits.
                </p>
                <p style="font-size: 16px; line-height: 1.5;">
                    Below are the positions that need to be edited:
                </p>
                <div style="margin: 10px 0; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
                    <label style="font-size: 16px; font-weight: bold;">Content:</label>
                    <strong style="font-size: 16px; color: #333;">{{ $change_required }}</strong>
                </div>
                <p style="font-size: 16px; line-height: 1.5;">
                    Kindly make the necessary changes at your earliest convenience.
                </p>
                <p style="font-size: 16px; line-height: 1.5;">
                    Thank you!
                </p>
                <p style="font-size: 16px; line-height: 1.5;">
                    Best Regards, <br>
                    Code Playground
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f4f4f4; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="h-12" style="max-width: 120px;">
                <h3 style="font-size: 20px; color: #007BFF; margin-top: 10px;">Code Playground</h3>
            </td>
        </tr>

        <tr>
            <td style="padding: 10px; text-align: center; background-color: #f4f4f4; color: #666; font-size: 14px;">
                &copy; 2024 Code Playground. All rights reserved.
            </td>
        </tr>
    </table>

</body>
</html>
