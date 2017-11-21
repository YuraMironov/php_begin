<?php ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php include 'view/php/links.php'?>
</head>
<body>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" required/>
        <label>Пароль:</label>
        <input type="password" name="password" required/>
        <button type="submit"> Войти </button>
    </form>
    <a href="/twitter"><button>Twitter.com</button></a>
</body>
</html>
