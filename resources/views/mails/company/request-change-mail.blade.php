<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, {{$user->name}}</h1>
    <span>We've taken a look at your information</span>
    <span>we noticed that there were a few areas that needed to be edited</span>
    <p>Below are the positions that need to be edited</p>
    <label for="">Nội dung</label>
    <strong>{{$change_required}}</strong>
    </div>
    <p>Kindly make the necessary changes.</p>
    <p>Thank you</p>
    <p>Best Regards</p>
</body>
</html>