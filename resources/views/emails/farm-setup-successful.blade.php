<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Farm Setup on Farmaax is successful</title>
</head>

<body>
    <h1>Hello, </h1>
    <p>We are glad to let you know that your  {{ $data['nameOfFarm'] }} Set up at the sum of    {{ number_format(Str::substr($data['amount_paid'], 0, -2)) }} is successful on Farmaax.
    </p>
    <p>We will get in touch with you as soon as possible,    Thanks for choosing Us
    </p>
    <a href="{{ route('farms.show', $data['idOfFarm']) }}">View Farm On Farmaax</a>
    <br><br>
    <br>
    <br><br>
    <p>Thanks, <br>
        Team Farmaax.
    </p>
    <div class="" style="background-color: #f4f4f4;padding:15px">
        &copy; copyright 2020 Farmmax
    </div>
</body>

</html>
