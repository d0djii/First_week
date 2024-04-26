<?php
session_start();

// Проверяем, авторизован ли пользователь
if(isset($_SESSION['id'])) {
    // Создаем подключение к базе данных
    $conn = new mysqli('localhost', 'root', '', 'delivery');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получаем имя пользователя из базы данных
    $user_id = $_SESSION['id'];

    // Используем подготовленный запрос
    $stmt = $conn->prepare("SELECT first_name, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id); // 'i' означает integer (целое число)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row["first_name"];
        $role = $row["role"];
    } else {
        $first_name = "Пользователь";
        $role = "user"; // По умолчанию установим роль 'user'
    }

    $stmt->close();
    $conn->close();
}
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header" >
            <a class="navbar-brand" href="index.php" style="max-height: 50px; display: inline-block;"><img src="assets/img/form/logo.png" style="height: 25px; max-width: 100%; "></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['id'])) { ?>
                <li><a>Привет, <?php echo $first_name; ?></a></li>
                <li><a href="./logout.php">Выйти</a></li>
                <?php if($role == "user") { ?>
                    <!-- Эти ссылки будут видны только для пользователей с ролью 'user' -->
                    <li><a href="index.php">МЕНЮ</a></li>
                    <li><a href="order.php">ЗАКАЗАТЬ</a></li>
                    <li><a href="sales.php">ЗАКАЗЫ</a></li>
                <?php } ?>
                <?php if($role == "manager") { ?>
                    <!-- Эти ссылки будут видны только для пользователей с ролью 'manager' -->
                    <li><a href="index.php">МЕНЮ</a></li>
                    <li><a href="sales.php">ЗАКАЗЫ</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ДЛЯ СОТРУДНИКОВ <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="product.php">Продукты</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="ingredient.php">Ингредиенты</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="category.php">Категории</a></li>
                    </li>
                    
                <?php } ?>
                <?php if($role == "courier") { ?>
                    <!-- Эти ссылки будут видны только для пользователей с ролью 'courier' -->
                    <li><a href="sales.php">ЗАКАЗЫ</a></li>
                    
                <?php } ?>
                <?php if($role == "cook") { ?>
                    <!-- Эти ссылки будут видны только для пользователей с ролью 'cook' -->
                    <li><a href="index.php">МЕНЮ</a></li>
                    <li><a href="sales.php">ЗАКАЗЫ</a></li>
                <?php } ?>
            <?php } else { ?>
                <li><a href="./login.php">Вход</a></li>
                <li><a href="./register.php">Регистрация</a></li> 
            <?php } ?>
        </ul>
    </div>
</nav>
