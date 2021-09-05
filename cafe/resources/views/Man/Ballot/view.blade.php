@foreach($li as $row)
<tr class="not-detail">
	<td data-toggle="collapse" data-target="#collapse-<?php echo $row['Idreceipt']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['Idreceipt']; ?>">
		<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
	</td>
	<td><?php echo $row['Idreceipt']; ?></td>
	<td><?php echo $row['IdUser']; ?></td>
	<td><?php echo $row['IdSupplier']; ?></td>
	<td>Tiền mặt</td>
	<td><?php echo number_format($row['Totalprice'],0); ?></td>
</tr>
<tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['Idreceipt']; ?>">
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
								Mã phiếu nhập
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['Idreceipt']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Người nhập
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['IdUser']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Thời gian
							</label>
							<div class="col-md-8">
								<input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['Time']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row form-group">
							<label class="col-md-4">
								NCC
							</label>
							<div class="col-md-8">
								<strong><?php echo $row['IdSupplier']; ?></strong>
							</div>
						</div>
						<div class="row form-group">
							<label class="col-md-4">
								Thanh toán
							</label>
							<div class="col-md-8">
								<strong>Tiền mặt</strong>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<textarea rows="4" class="form-control"><?php echo $row['Note'];?></textarea>
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
							<td><?php echo $rowdetail['DetaiId']; ?></td>
							<td><?php echo $rowdetail['IdProduct']; ?></td>
							<td><?php echo $rowdetail['Quantity']; ?></td>
							<td><?php echo $rowdetail['Unit']; ?></td>
							<td><?php echo number_format($rowdetail['Price'],0); ?></td>
							<td><?php echo number_format($rowdetail['Price']*$rowdetail['Quantity'],0); ?></td>
						</tr>	
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</td>
</tr>
@endforeach