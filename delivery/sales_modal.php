
<div class="modal fade" id="details<?php echo $row['purchaseid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">ДЕТАЛИ ЗАКАЗА</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <h5>ПОКУПАТЕЛЬ <b><?php echo $row['customer']; ?></b>
                        <span class="pull-right">
                            <?php echo date('M d, Y h:i A', strtotime($row['date_purchase'])) ?>
                        </span>
                    </h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>НАЗВАНИЕ ПРОДУКТА</th>
                            <th>ЦЕНА</th>
                            <th>КОЛИЧЕСТВО</th>
                            <th>ЦЕНА</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql="select * from purchase_detail left join product on product.productid=purchase_detail.productid where purchaseid='".$row['purchaseid']."'";
                                $dquery=$conn->query($sql);
                                while($drow=$dquery->fetch_array()){
                                    ?>
                                    <tr>
                                        <td><?php echo $drow['productname']; ?></td>
                                        <td class="text-right">&#8381; <?php echo number_format($drow['price'], 2); ?></td>
                                        <td><?php echo $drow['quantity']; ?></td>
                                        <td class="text-right">&#8381;
                                            <?php
                                                $subt = $drow['price']*$drow['quantity'];
                                                echo number_format($subt, 2);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            ?>
                            <tr>
                                <td colspan="3" class="text-right"><b>ОБЩАЯ ЦЕНА</b></td>
                                <td class="text-right">&#8381; <?php echo number_format($row['total'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ЗАКРЫТЬ</button>
            </div>
        </div>
    </div>
</div>
