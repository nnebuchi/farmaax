<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A User has just Purchased a Land</title>
</head>

<body>
    <h1>Hello Admin, </h1>
    <p>We are glad to let you know that you have a user has purchased {{ $data['landTitle'] }} at the sum of
        {{ number_format($data['price']) }} on Farmaax.
    </p>
    <br>
    <a href="{{ route('lands.show', $data['id']) }}">View Land On Farmaax</a>
    <br><br>
    <p>Thanks, <br>
        Team Farmaax.
    </p>
    <div class="" style="background-color: #f4f4f4;padding:15px">
        &copy; copyright 2020 Farmmax
    </div>
</body>

</html>
