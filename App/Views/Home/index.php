<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="/Login">Login</a>
        <a href="/Register">Cadastro</a>

    </nav>
    <h1>Home</h1>
    <p>This is home view</p>
    <p><?= $data[0] ?? "" ?></p>

</body>

</html>
