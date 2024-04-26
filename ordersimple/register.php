<?php
session_start();
$_SESSION['id'] = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['id'] = 'some_user_id'; 
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Source Code Pro' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>

    <div class="termin_box">
        <div class="header_form_container"></div>
    
        <div class="header_2">
            <a href="../index.php">
                <img src="../assets/img/form/logo.png" alt="">
            </a>
        </div>

        <div class="form_link">
            <a class="menu_link" href="login.php">
                Вход
            </a>
            <a class="menu_link col" href="register.php">
                Регистрация
            </a>
        </div>  <br>
    </div>

    <div class="form_container">
    <form action="./registration.php" method="post">
        <div class="underline-input">
            <p>
                Почта
            </p>
            <input type="email" name="email" required placeholder="Dosamarvis@gmail.com">
        </div>

        <div class="underline-input">
            <p>
                Имя и фамилия
            </p>
            <input type="text" name="first_name" required placeholder="Мартыненко Дмитрий">
        </div>

        <div class="underline-input">
            <p>
                Телефон
            </p>
            <input type="text" name="phone_number" required placeholder="+7 987 654 32 01">
        </div>

        <div class="underline-input">
            <p>
                Пароль
            </p>
            <input type="password" name="password" required placeholder="12345678">
        </div>
        <div class="main_form_button">
            <input type="submit" name="submit" value="Регистрация">
        </div>
    </form>
        </form>
    </div>
    
</body>
</html>
