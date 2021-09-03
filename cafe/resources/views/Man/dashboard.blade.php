@extends('Man.index')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h3 class="dashboard-title">BÁO CÁO KẾT QUẢ BÁN HÀNG HÔM NAY</h3>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-blue">
			<div class="resport-icon">
				<i class="fa fa-usd" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				
				<p> Hóa đơn đã thanh toán</p>
				<h4> đ</h4>
				<span>Hôm qua 1,700,000</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-green">
			<div class="resport-icon">
				<i class="fa fa-pencil" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>1 Hóa đơn đang phục vụ</p>
				<h4>1,500,000 </h4>
				<span>Hôm qua 1,700,000</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="resport-box resport-red">
			<div class="resport-icon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Khách hàng</p>
				<h4>0</h4>
				<span>Hôm qua 0</span>
			</div>
		</div>
	</div>
</div>
</div>
<div class="row">
	<canvas class="col-md-10" id="myChart"></canvas>
</div>
@endsection