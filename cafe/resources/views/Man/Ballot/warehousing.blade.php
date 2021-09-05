@extends('Man.index')
@section('content')
<div class="row customer-act act">
	<div class="col-md-5">
		<h2>Danh sách phiếu nhập</h2>
	</div>
	<div class="col-md-7 text-right action">
		<a class="btn btn-success" href="{{route('admin.kk')}}"><i class="fa fa-plus" aria-hidden="true"></i> Tạo phiếu nhập</a>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-4 form-group">
		<input type="text" name="txtwarehousing" class="form-control" placeholder="Nhập mã phiếu nhập để tìm kiếm" id="myBallot" onkeyup="search_ballot()">
	</div>
	<div class="col-md-4 p-0">
		<div class="input-group">
			<input type="date" class="form-control">
			<div class="input-group-prepend">
				<span class="input-group-text" id="inputGroupPrepend">Đến</span>
			</div>
			<input type="date" class="form-control" aria-describedby="inputGroupPrepend">
		</div>
	</div>
	<div class="col-md-1 form-group">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
</div>
<div class="row content-ware">
	<div class="col-md-12">
		<table class="table table-striped table-bordered" id="Ballot">
			<thead class="table-primary">
				<tr><th></th>
					<th>Mã nhiếu nhập</th>
					<th>Người nhập</th>
					<th>NCC</th>
					<th>Thanh toán</th>
					<th>Tổng tiền</th>
				</tr>
			</thead>
			<tbody id="load_pagination_table">
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
			</tbody>
		</table>
		<ul class="pagination">
			@php
			$limit=10;
			$totalpage = ceil($count/$limit);
			@endphp
			@for($i=1; $i <=$totalpage ; $i++)
			<li class="page-item"><a class="page-link" onclick="cms_pagination_ballot({{$i}})" href="#">{{$i}}</a></li>
			@endfor

		</ul>
	</div>
</div>

<script>
	
function cms_pagination_ballot($current_page){
	$param = {
			type:'GET',
			url:'{{route('admin.pagination_ballot')}}',
			data:{
				current_page:$current_page,
			},
			dataType:'html',
			callback:function(result){
				$('#load_pagination_table').html(result);
			}
		}
	ajax_adapter($param);
}

function search_ballot() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myBallot");
  filter = input.value.toUpperCase();
  table = document.getElementById("Ballot");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
@endsection