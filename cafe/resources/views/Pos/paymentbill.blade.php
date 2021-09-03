<?php
	session_start();
	require_once('../connection.php');
	if(isset($_POST['data'])){
		$user = $_SESSION['uid'];
		$json =$_POST['data'];
		$table_id= $json['table_id'];
		$customer_id = $json['customer_id'];
		$customer_pay = $json['customer_pay'];
		$note = $json['note'];
		$sql = "SELECT * FROM Bill WHERE IdTable ='$table_id' AND StatusB=0";
		$result=mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)>0){
			$bill = mysqli_fetch_assoc($result);
		$idbill = $bill['IdBill'];
		$updatebill = "UPDATE Bill SET StatusB ='1' WHERE IdBill = '$idbill'";
		$result2=mysqli_query($conn,$updatebill);
		if(isset($result2)){
			$updatetable = "UPDATE tables SET Status ='0' WHERE IdTable ='$table_id'";
			$result3=mysqli_query($conn,$updatetable);
		}
			echo '
			<h2 style="text-align:center">HÓA ĐƠN BÁN HÀNG</h2>
			<table class="table" style="width:100%">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Gía bán</th>
				</tr>
			</thead>
			<tbody>';
			$selectoder = "SELECT * FROM billdetail
			INNER JOIN 	menus ON billdetail.IdMenu = menus.IdMenu WHERE IdBill ='$idbill'";
			$resultdetail = mysqli_query($conn,$selectoder);
			$stt=0;
			while ($rows = mysqli_fetch_array($resultdetail)) {
				$stt++;
			?>
				<tr align="center">
					<td><?php echo $stt; ?></td>
					<td><?php echo $rows['NameMenu'];?></td>
					<td><?php echo $rows['Quantity']; ?></td>
					<td><?php echo number_format($rows['Price'],0);?></td>
				</tr>
		<?php }
			echo '<tr>
					<td colspan="3">Tổng cộng:</td>
					<td align="center">'.number_format($bill['Totalprice']).'</td>
				</tr>
			</tbody></table>';
		}else{
			echo "HIỆN CHƯA CÓ GÌ CHƯA THỂ THANH TOÁN";
			}
		}
?>