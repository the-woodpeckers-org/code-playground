<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($status == 'approved') Congratulations @elseif($status == 'rejected') Sorry @else Application Status @endif</title>
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

        @if($status === 'approved' || $status === 'active')
        <h1>Congratulations, {{$user->name}}!</h1>
        <h2> Your
            {{ $problem ? 'Problem: ' . $problem->title : 
       ($contest ? 'Contest: ' . $contest->title : 
       ($job ? 'Job: ' . $job->title : 'application')) }}
            is approved
        </h2>
        @elseif($status === 'rejected')
        <h1>Sorry, {{$user->name}}!</h1>
        <h2>Your
            {{
        $problem ? 'Problem: ' . $problem->title : 
       ($contest ? 'Contest: ' . $contest->title : 
       ($job ? 'Job: ' . $job->title : 'application')) }} is rejected
        </h2>
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