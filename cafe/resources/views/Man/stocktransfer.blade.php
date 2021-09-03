@extends('Man.index')
@section('content')
<div class="row customer-act act">
	<div class="col-md-5">
		<h2>Danh sách phiếu chuyển kho</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" onclick="cms_load_stockimport()"><i class="fa fa-plus" aria-hidden="true"></i> Tạo phiếu chuyển</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-4 form-group">
		<input type="text" name="txtwarehousing" class="form-control" placeholder="Nhập mã phiếu xuất để tìm kiếm">
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
	<div class="col-md-3">
		<div class="btn-group" role="group">
  			<button type="button" class="btn btn-outline-primary">Tuần</button>
  			<button type="button" class="btn btn-outline-primary">Qúy</button>
  			<button type="button" class="btn btn-outline-primary">Năm</button>
		</div>
	</div>
</div>
<div class="row content-ware">
	<div class="col-md-12">
		<table class="table table-striped table-bordered">
		    <thead class="table-primary">
		      <tr>
		      	<th>Mã nhiếu chuyển</th>
		        <th>Kho xuất</th>
		        <th>Kho Nhận</th>
		        <th>Ngày chuyển</th>
		        <th>Người nhận</th>
		        <th>Người chuyển</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<td colspan="6" class="text-center">Không có dữ liệu</td>
		    </tbody>
		</table>
	</div>
</div>
@endsection