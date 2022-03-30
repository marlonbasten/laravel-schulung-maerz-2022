<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Es wurde ein Post erstellt!</title>
</head>
<body>

    <h1>Juhu, es wurde ein Post erstellt!</h1>

    <p>
        ID: {{$post->id}}
        <br>
        Titel: {{$post->title}}
        <br>
        Ersteller: {{$post->user->name}}
    </p>

</body>
</html>
