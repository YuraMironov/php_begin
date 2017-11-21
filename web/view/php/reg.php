<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
    $errPass = isset($_SESSION['errPass']) ? $_SESSION['errPass'] : "";
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <?php include 'view/php/links.php'?>
</head>
<body>
<form method="post">
    <?php
    if (isset($_COOKIE['suc_reg']) && $_COOKIE['suc_reg'] == true) {
        echo '<label class="success">Регистрация пройдена успешно</label><br><label><a href="/login">login</a><br></label>';
    } else {
        if (!$success) {
            echo '<label class="error">Регистрация не пройдена<br>';
            if ($errPass) echo('Неправильный пароль<br>');
            echo('</label>');
        }
    }
    ?>
    <label>Имя пользователя:</label>
    <input type="text" minlength="5" name="name" placeholder="Ваше имя" <?php if($name != '' && !$success) echo('value='.$name.' ')?> required/>
    <label>E-mail пользователя</label>
    <input type="email" name="email" placeholder="Электронная почта" <?php if($email != '' && !$success) echo('value='.$email.' ')?> required/>
    <label>Пароль:</label>
    <input type="password" name="password" placeholder="Ваш пароль" required/>
    <label>Проверка пароля:</label>
    <input type="password" name="password2" placeholder="Ваш пароль" required/>
    <button type="submit"> Отправить</button>
</form>
<!-- <div class="form"><a href="/twitterOAuth">twitter</a></div> -->
</body>
</html>
