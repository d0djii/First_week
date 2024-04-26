<?php
include('header.php');
include('navbar.php');

// Проверяем, роль пользователя
if ($role == 'user') {
    header("Location: index.php");
    exit();
}

// Создаем подключение к базе данных
$conn = new mysqli('localhost', 'root', '', 'foodsys');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<div class="container">
    <h1 class="page-header text-center">CRUD ИНГРЕДИЕНТОВ</h1>
    <div class="row">
        <div class="col-md-12">
            <select id="catList" class="btn btn-default">
                <option value="0">ВСЕ КАТЕГОРИИ</option>
                <?php
                    $sql="select * from category";
                    $catquery=$conn->query($sql);
                    while($catrow=$catquery->fetch_array()){
                        $catid = isset($_GET['category']) ? $_GET['category'] : 0;
                        $selected = ($catid == $catrow['categoryid']) ? " selected" : "";
                        echo "<option$selected value=".$catrow['categoryid'].">".$catrow['catname']."</option>";
                    }
                ?>
            </select>
            <a href="#addproduct" data-toggle="modal" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-plus"></span> ПРОДУКТ</a>
        </div>
    </div>
    <div style="margin-top:10px;">
        <table class="table table-striped table-bordered">
            <thead>
                <th>НАЗВАНИЕ ИНГРЕДИЕНТА</th>
                <th>ЦЕНА</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    $where = "";
                    if(isset($_GET['category'])) {
                        $catid=$_GET['category'];
                        $where = " WHERE ingridients.categoryid = $catid";
                    }
                    $sql="select * from ingridients left join category on category.categoryid=ingridients.category_id $where order by ingridients.category_id asc, name asc";
                    $query=$conn->query($sql);
                    while($row=$query->fetch_array()){
                        ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td>&#8381; <?php echo number_format($row['price'], 2); ?></td>
                            <td>
                                <a href="#editproduct<?php echo $row['ingridient_id']; ?>" data-toggle="modal" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> ИЗМЕНИТЬ</a> || <a href="#deleteproduct<?php echo $row['ingridient_id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> УДАЛИТЬ</a>
                                <?php include('product_modal.php'); ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('modal.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#catList").on('change', function(){
            if($(this).val() == 0) {
                window.location = 'product.php';
            } else {
                window.location = 'product.php?category='+$(this).val();
            }
        });
    });
</script>
</body>
</html>
