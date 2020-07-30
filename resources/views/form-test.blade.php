<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Contact</h1>

    <form action="/contact/store" method="POST">
        {{ csrf_field() }}
        <input type="text" name="full_name" placeholder="nama">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="phone" placeholder="phone">
        <button type="submit">Kirim</button>
    </form>
</body>
</html>