@foreach($li as $row)

<tr class="not-detail">
	<td data-toggle="collapse" data-target="#collapse-<?php echo $row['id_bill']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['id_bill']; ?>">
		<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
	</td>
	<td><?php echo $row['id_bill']; ?></td>
	<td><?php echo $row['time']; ?></td>
	<td><?php echo number_format($row['price'],0); ?></td>
	<td><?php echo $row['note'];?></td>
	<td>Đã hoàn thành</td>
</tr>
<tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['id_bill']; ?>">
	<td colspan="8">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<div class="row">
					<div class="col-md-4">
						<div class="row form-group">
							<label class="col-md-4">
								Mã hóa đơn
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['id_bill']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Phòng/Bàn
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['tablename']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Thời gian
							</label>
							<div class="col-md-8">
								<input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['time']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row form-group">
							<label class="col-md-4">
								Nhân Viên
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['nameuser']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Khách hàng
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['namecus']; ?></strong>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<textarea rows="4" class="form-control"><?php echo $row['note'];?></textarea>
					</div>
				</div>
				<table class="table table-striped table-bordered">
					<thead class="table-success">
						<tr>
							<th>Mã Sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>ĐVT</th>
							<th>Gía bán</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						@foreach($row['detail'] as $rowdetail)
						<tr>
							<td><?php echo $rowdetail['idmenu']; ?></td>
							<td><?php echo $rowdetail['namemenu']; ?></td>
							<td><?php echo $rowdetail['quantity']; ?></td>
							<td><?php echo $rowdetail['unit']; ?></td>
							<td><?php echo number_format($rowdetail['price'],0); ?></td>
							<td><?php echo number_format($rowdetail['price']*$rowdetail['quantity'],0); ?></td>
						</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</td>
</tr>
@endforeach