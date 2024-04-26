<?php
include('header.php');
include('navbar.php');

// Проверяем, роль пользователя
//if ($role == 'user') {
   // header("Location: index.php");
    ////exit();
//}

// Обработка отправки формы для добавления категории
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    // Проверяем, установлено ли название категории
    if(isset($_POST['category_name']) && !empty($_POST['category_name'])) {
        // Открываем соединение с базой данных
        $conn = new mysqli('localhost', 'root', '', 'delivery');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Получаем название категории из формы
        $category_name = $_POST['category_name'];

        // Готовим и выполняем запрос на добавление категории
        $sql = "INSERT INTO category (catname) VALUES ('$category_name')";
        if ($conn->query($sql) === TRUE) {
            // Перенаправляем пользователя после успешного добавления категории
            header("Location: category.php");
            exit();
        } else {
            // Выводим сообщение об ошибке, если что-то пошло не так
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Закрываем соединение с базой данных
        $conn->close();
    } else {
        // Выводим сообщение, если название категории не было введено
        echo "Название категории не было введено";
    }
}
?>

<div class="container">
    <h1 class="page-header text-center">CRUD КАТЕГОРИЙ</h1>
    <!-- Форма для добавления категории -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="category_name">Название категории:</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <button type="submit" name="add_category" class="btn btn-primary">Добавить категорию</button>
    </form>

    <div style="margin-top:10px;">
        <table class="table table-striped table-bordered">
            <thead>
                <th>НАЗВАНИЕ КАТЕГОРИИ</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    // Открываем соединение с базой данных (необходимо для вывода существующих категорий)
                    $conn = new mysqli('localhost', 'root', '', 'delivery');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    // Выводим существующие категории
                    $sql="select * from category order by categoryid asc";
                    $query=$conn->query($sql);
                    while($row=$query->fetch_array()){
                        ?>
                        <tr>
                            <td><?php echo $row['catname']; ?></td>
                            <td>
                                <a href="#editcategory<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> ИЗМЕНИТЬ</a> || <a href="#deletecategory<?php echo $row['categoryid']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> УДАЛИТЬ</a>
                                <?php include('category_modal.php'); ?>
                            </td>
                        </tr>
                        <?php
                    }
                    // Закрываем соединение с базой данных
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('modal.php'); ?>
</body>
</html>
