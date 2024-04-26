<?php
include('header.php');
include('navbar.php');

// Establishing database connection
$conn = new mysqli('localhost', 'root', '', 'delivery');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$time = time();
$current_time = strtotime('+5 hour', $time);
$current_time = strtotime('+30 minutes', $current_time);

// Определяем начальное и конечное время с округлением до ближайших 30 минут
$start_time = ceil($current_time / (30 * 60)) * (30 * 60);
$end_time = strtotime('23:30');

// Создаем массив для хранения временных значений
$time_options = array();

// Заполняем массив временными значениями с интервалом в 30 минут от текущего времени до 23:30
while ($start_time <= $end_time) {
    $time_options[] = date('H:i', $start_time);
    $start_time += (30 * 60); // Добавляем интервал в 30 минут
}

?>

<div class="container">
    <h1 class="page-header text-center">ЗАКАЗ</h1>
    <form method="POST" action="purchase.php">
        <table class="table table-striped table-bordered">
            <thead>
                <th class="text-center"><input type="checkbox" id="checkAll"></th>
                <th>КАТЕГОРИЯ</th>
                <th>НАЗВАНИЕ ПРОДУКТА</th>
                <th>ЦЕНА</th>
                <th>КОЛИЧЕСТВО</th>
            </thead>
            <tbody>
                <?php
                    $sql="select * from product left join category on category.categoryid=product.categoryid order by product.categoryid asc, productname asc";
                    $query=$conn->query($sql);
                    $iterate=0;
                    while($row=$query->fetch_array()){
                        ?>
                        <tr>
                            <td class="text-center"><input type="checkbox" value="<?php echo $row['productid']; ?>||<?php echo $iterate; ?>" name="productid[]" style=""></td>
                            <td><?php echo $row['catname']; ?></td>
                            <td><?php echo $row['productname']; ?></td>
                            <td class="text-right">&#8381; <?php echo number_format($row['price'], 2); ?></td>
                            <td><input type="text" class="form-control" name="quantity_<?php echo $iterate; ?>"></td>
                        </tr>
                        <?php
                        $iterate++;
                    }
                ?>
            </tbody>
        </table>

        <div class="container text-center" >
        <div class="input-group">
            <div class="row" style=" align-items: center;">
                <input type="text" class="form-control" id="comment_text" name="comment_text" placeholder="Комментарий" style="margin-bottom: 20px;">
                <input type="text" class="form-control" id="address_text" name="address_text" placeholder="Адрес доставки" required style="margin-bottom: 20px;">
                <div class="row" style="margin-bottom: 20px;">
                    <p>Во сколько привезти?</p>
                    <?php foreach ($time_options as $time_option): ?>
                    <button class="btn btn-primary" type="button" onclick="setValue('<?php echo $time_option; ?>')" style="margin-top: 5px;"><?php echo $time_option; ?></button>
                    <?php endforeach; ?>
                </div>

                <div class="row">
                <input type="hidden" id="hiddenInput" name="time_pick" value="">
                <input type="hidden" name="customer" value="<?php if($first_name=="") {echo "Unknown";} else {echo $first_name;} ?>"> <!-- Используется значение $customer вместо ввода с именем покупателя -->
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> СОХРАНИТЬ</button>
            </div>
        </div>

        </div>

    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });

    function setValue(value) {
        document.getElementById('hiddenInput').value = value;
    }
</script>
