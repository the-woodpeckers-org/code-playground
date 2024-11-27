<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #28a745;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #999;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://res.cloudinary.com/dazvvxymm/image/upload/v1726071143/CP-Photoroom_1_vl6kzc.png" alt="Company Logo" class="h-12" style="max-width: 120px;">
        </div>
        @if($status == 'approved')
        <h1>Congratulations, {{$userApply->name}}!</h1>
        <p>Your application has been approved! We are excited to have you as part of our team at <strong>{{$user_company->name}}</strong>.</p>
        <p>You have successfully applied for the position of <strong>{{$job->location}}</strong>. The recruiter will be in touch with you soon to discuss the next steps.</p>
        <p>We look forward to working with you and seeing all the great contributions you'll make. Please click below to proceed with the next steps.</p>
        @elseif($status == 'rejected')
        <h1>Sorry, {{$userApply->name}}!</h1>
        <p>We regret to inform you that your application for the position of <strong>{{$job->location}}</strong> at <strong>{{$user_company->name}}</strong> has been rejected.</p>
        <p>While we were impressed with your qualifications, we have decided to move forward with other candidates for this position.</p>
        <p>Thank you for your time and effort in applying, and we encourage you to apply again in the future for other openings at <strong>{{$user_company->name}}</strong>.</p>
        @else
        <h1>Application Status</h1>
        <p>We have not yet made a decision regarding your application. Please check back later for an update.</p>
        @endif
        <div class="footer">
            <p>Best Regards, <br> Code Playground Team</p>
        </div>
    </div>
</body>

</html>