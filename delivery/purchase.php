<?php
	include('conn.php');
	if(isset($_POST['productid'])){
 
		$customer=$_POST['customer'];
		$address=$_POST['address_text'];
		$comment=$_POST['comment_text'];
		$time =$_POST['time_pick'];
		$sql="insert into purchase (customer, date_purchase, comment, address, how_fast) values ('$customer', NOW(), '$comment', '$address', '$time')";
		$conn->query($sql);
		$pid=$conn->insert_id;
 
		$total=0;
 
		foreach($_POST['productid'] as $product):
		$proinfo=explode("||",$product);
		$productid=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="select * from product where productid='$productid'";
		$query=$conn->query($sql);
		$row=$query->fetch_array();
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=$row['price']*$_POST['quantity_'.$iterate];
			$total+=$subt;

			$sql="insert into purchase_detail (purchaseid, productid, quantity) values ('$pid', '$productid', '".$_POST['quantity_'.$iterate]."')";
			$conn->query($sql);
		}
		endforeach;
 		
 		$sql="update purchase set total='$total' where purchaseid='$pid'";
 		$conn->query($sql);
		header('location:index.php');		
	}
	else{
		?>
		<script>
			window.alert('ПОЖАЛУЙСТА ВЫБЕРИТЕ ЧТО-НИБУДЬ ДЛЯ ВАШЕГО ЗАКАЗА');
			window.location.href='order.php';
		</script>
		<?php
	}
?>