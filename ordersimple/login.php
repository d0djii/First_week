<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connectMySQL = new mysqli('localhost', 'root', '', 'foodsys');

    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $query = $connectMySQL->prepare("SELECT * FROM users WHERE phone_number=? AND password=?");
    $query->bind_param("ss", $phone_number, $password);
    $query->execute();

    $result = $query->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION['id'] = $data['id'];
            $_SESSION['role'] = $data['role'];
            header("Location: ./index.php");
            exit();
        } 
    } else {
        echo "Ошибка выполнения запроса";
    }

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        header("Location: ./index.php");
        exit();
    } else {
        $error_message = "Неверный номер телефона или пароль";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="assets/css/style.css">
<link href='https://fonts.googleapis.com/css?family=Source Code Pro' rel='stylesheet'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
    <style>
    </style>
</head>
<body>

    <div class="termin_box">
        <div class="header_form_container">
        </div>
    
        <div class="header_2">
            <a href="../index.html">
                <img src="../assets/img/form/logo.png" alt="">
            </a>
        </div>

        <div class="form_link">
            <a class="menu_link col" href="login.php">
                Вход
            </a>
            <a class="menu_link" href="register.php">
                Регистрация
            </a>
        </div> <br>

    </div>

    <div class="form_container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="underline-input">
                <p>Номер Телефона</p>
                <input type="text" name="phone_number" required placeholder="+7982186084">
            </div>

            <div class="underline-input">
                <p>Пароль</p>
                <input type="password" name="password" required placeholder="12345678">
            </div>
            <div class="main_form_button">
                <button type="submit">Войти</button>
            </div>
            <?php if(isset($error_message)) { ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
                <?php } ?>
        </form>
    </div>
    
</body>
</html>