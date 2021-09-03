@extends('Man.index')
@section('content')
<div class="row customer-act act">
	<div class="col-md-5">
		<h2>Tạo phiếu chuyển <i class="fa fa-angle-double-right" aria-hidden="true"></i></h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
		<button class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i> Lưu & In</button>
		<button class="btn" onclick="cms_cancel_import();"><i class="fa fa-arrow-left" aria-hidden="true"></i> Hủy</button>
	</div>
</div>
<div class="row content-inport">
	<div class="col-md-8">
		<div class="form-group">
			<input type="text" name="txtsearchimport" placeholder="Nhập mã sản phẩm cần nhập" class="form-control">
		</div>
		<table class="table table-striped table-bordered">
		    <thead class="thead-light">
		      <tr>
		      	<th>Mã nhiếu chuyển</th>
		        <th>Kho nhập</th>
		        <th>Tình trạng</th>
		        <th>Ngày nhập</th>
		        <th>Người nhập</th>
		        <th>Tổng tiền</th>
		      </tr>
		    </thead>
		    <tbody>
		      	<td colspan="6" class="text-center">Không có dữ liệu</td>
		    </tbody>
		</table>
		<div class="alert alert-success">
			Gõ mã hoặc tên sản phẩm vào hộp tìm kiếm để thêm hàng vào đơn hàng
		</div>
	</div>
	<div class="col-md-4">
		<div class="row form-group">
			<div class="col-md-4 p-0">
				<strong>Kho cần chuyển</strong>
			</div>
			<div class="col-md-8">
				<div class="input-group">
			        <select class="form-control">
			        	<option>Kho Đà Nẵng</option>
			        </select>
			        <div class="input-group-prepend">
			          	<button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
			        </div>
      			</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4 p-0">
				<strong>Ngày chuyển</strong>
			</div>
			<div class="col-md-8">
			     <input type="date" class="form-control">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4 p-0">
				<strong>Người chuyển</strong>
			</div>
			<div class="col-md-8">
			    <select class="form-control">
			    	<option>Admmin</option>
			    </select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4 p-0">
				<strong>Ghi chú</strong>
			</div>
			<div class="col-md-8">
			    <textarea class="form-control" rows="3" placeholder="Ghi chú"></textarea>
			</div>
		</div>
	</div>
</div>
@endsection