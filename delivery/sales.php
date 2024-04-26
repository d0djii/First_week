<?php 
// Подключаем файлы header.php и navbar.php
include('header.php');
include('navbar.php');

?>
<div class="container">
    <h1 class="page-header text-center">ЗАКАЗЫ</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <th>ДАТА И ВРЕМЯ</th>
            <th>ПОКУПАТЕЛЬ</th>
            <th>ОБЩАЯ ЦЕНА</th>
            <th>КОММЕНТАРИЙ</th>
            <th>АДРЕС</th>
            <th>СТАТУС</th>
            <th>ВРЕМЯ ДОСТАВКИ</th>
            <th>ДЕТАЛИ</th>
            <?php if ($role == 'manager' || $role == 'cook' || $role == 'courier'): ?> <!-- Показывать кнопку только для менеджера, повара и курьера -->

            <th>ОБНОВИТЬ СТАТУС</th>
            
            <?php endif; ?>
        </thead>
        <tbody>
            <?php 
            // Открываем соединение с базой данных
            $conn = new mysqli('localhost', 'root', '', 'delivery');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if($role == 'user') {
                $sql = "SELECT purchase.*, purchase_status.name FROM purchase LEFT JOIN purchase_status ON purchase.status_id=purchase_status.status_id WHERE customer = '$first_name' ORDER BY purchaseid DESC";
            }
            else {
                $sql = "SELECT purchase.*, purchase_status.name FROM purchase LEFT JOIN purchase_status ON purchase.status_id=purchase_status.status_id ORDER BY purchaseid DESC";
            }
            
            $query = $conn->query($sql);
            while ($row = $query->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?></td>
                    <td><?php echo $row['customer']; ?></td>
                    <td class="text-right">&#8381; <?php echo number_format($row['total'], 2); ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['how_fast']; ?></td>
                    <td>
                        <a href="#details<?php echo $row['purchaseid']; ?>" data-toggle="modal" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-search"></span> ПОСМОТРЕТЬ
                        </a>
                        <?php include('sales_modal.php'); ?>
                    </td>
                    <?php if ($role == 'manager' || ($role == 'cook' && $row['status_id'] == 1) || ($role == 'cook' && $row['status_id'] == 2 ) || ($role == 'cook' && $row['status_id'] == 5 ) || ($role == 'courier' && $row['status_id'] == 5) || ($role == 'courier' && $row['status_id'] == 4) || ($role == 'courier' && $row['status_id'] == 3)): ?>
                    <td>
                        <form method="post" action="update_status.php">
                            <input type="hidden" name="purchase_id" value="<?php echo $row['purchaseid']; ?>">
                            <select class="form-control" name="new_status">
                                <?php if ($role == 'manager'): ?> <!-- Для менеджера отображать все статусы -->
                                <option value="0">В обработке</option>
                                <option value="1">Принят</option>
                                <option value="2">На кухне</option>
                                <option value="3">В пути</option>
                                <option value="4">Доставлен</option>
                                <option value="5">Ожидает курьера</option>
                                <?php elseif ($role == 'cook'): ?> <!-- Для повара отображать только статусы "На кухне" и "Ожидает курьера" -->
                                <option value="2">На кухне</option>
                                <option value="5">Ожидает курьера</option>
                                <?php elseif ($role == 'courier'): ?> <!-- Для курьера отображать только статусы "В пути" и "Доставлен" -->
                                <option value="3">В пути</option>
                                <option value="4">Доставлен</option>
                                <?php endif; ?>
                            </select>
                            <button type="submit" class="btn btn-primary">Обновить статус</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
