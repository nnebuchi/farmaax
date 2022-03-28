<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>A User has just set up a Farm Land</title>
</head>

<body>
    <h1>Hello Admin, </h1>
    <p>We are glad to let you know that you have a user has set up a {{ $data['nameOfFarm'] }} at the sum of
        {{ number_format(Str::substr($data['amount_paid'], 0, -2)) }} on Farmaax.
    </p>
    <br>
    <a href="{{ route('farms.show', $data['idOfFarm']) }}">View Farm On Farmaax</a>
    <br><br>
    <p>Thanks, <br>
        Team Farmaax.
    </p>
    <div class="" style="background-color: #f4f4f4;padding:15px">
        &copy; copyright 2020 Farmmax
    </div>
</body>

</html>
