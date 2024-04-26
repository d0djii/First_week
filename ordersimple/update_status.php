<?php
// Подключение к базе данных и проверка соединения

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $purchase_id = $_POST['purchase_id'];
    $new_status = $_POST['new_status'];
    
    // Обновление статуса заказа в базе данных
    $conn = new mysqli('localhost', 'root', '', 'foodsys');
    $sql = "UPDATE purchase SET status_id = $new_status WHERE purchaseid = $purchase_id";
    $result = $conn->query($sql);
    
    if ($result) {
        header("Location: sales.php");
        exit();
    } else {
        echo "Ошибка при обновлении статуса заказа: " . $conn->error;
    }
    
    // Закрытие соединения с базой данных
    $conn->close();
}
?>
