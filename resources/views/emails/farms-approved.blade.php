<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Farm Has Been Approved</title>
</head>

<body>
    <h1>Hello {{ $user['firstName'] }},</h1>
    <p> Your farm has been approved on Farmaax.
    </p>
    <br>
    <a href="{{ route('farms.show', $farm['id']) }}">View your Farm</a>
    <br><br>
    <p>Thanks, <br>
        Team Farmaax.
    </p>
    <div class="" style="background-color: #f4f4f4;padding:15px">
        &copy; copyright 2020 Farmmax
    </div>
</body>

</html>
