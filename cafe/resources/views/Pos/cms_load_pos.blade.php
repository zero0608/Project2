
	@if($flag == 1)
		<div class="row" id="bill-info">
			<div class="col-md-2 table-infor">
				<strong data-id="{{$id_table}}"id="table_id">Bàn {{$id_table}}</strong> 
			</div>
			<div class="col-md-5">
				<div class="col-md-12 p-0 input-group"> 
					<input type="text" id="customer-infor" placeholder="Tìm khách hàng" class="form-control"
					value="{{$cus}}">
					<div class="input-group-append">
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModelAddcustomer"><i class="fa fa-plus"
							aria-hidden="true"></i></button>
						</div> 
						<div id="result-customer"></div>
						<span class="del-customer"></span> 
					</div> 
				</div>
				<div class="col-md-5">
					<select class="form-control">
						<option value="1">ghep order</option> 
					</select>
				</div>
			</div> 

			<div class="row bill-detail"> 
				<div class="col-md-12 bill-detail-content"> 
					<table class="table table-bordered">
						<thead class="thead-light">
							<tr> 
								<th scope="col">STT</th>
								<th scope="col">Tên sản phẩm</th> 
								
								<th scope="col">Số lượng</th> 
								<th scope="col">Gía bán</th> 
								<th scope="col">Thành Tiền</th>
								<th scope="col"></th> 
							</tr> 
							<tbody id="pro_search_append">
					<!-- <td class="text-center">
						<i class="fa fa-times-circle del-pro-order"></i>
					</td> --> 
					{{-- {{$rows-> --}}
					@foreach($data as $rows)
						<tr data-id="0"> 
							<td>{{$rows->IdMenu}}</td>
							<td>{{$rows->NameMenu}}</td>
							<td> <div class="input-group"> 
								<span class="input-group-btn"><button type="button" class="btn btn-light btn-number"><span class="fa fas fa-minus"></span></button></span> 
								<input name="" class="form-control quantity-product-oders" value="{{$rows->Quantity}}" type="text"> <span class="input-group-btn"> 
									<button type="button" class="btn btn-light btn-number"> 
										<span class="fa fas fa-plus"></span></button></span> </div> 
							</td> 
							<td><input type="text" class="form-control price-order" disabled="disabled" name="" value="{{$rows->Price}}"></td> 
							<td class="text-center total-money">{{number_format($rows->Price,0)}}
							</td>
						</tr>
					@endforeach
				
		</tbody>
	</table>
</div>
</div>
<div class="row bill-action">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12 p-1">
				<textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3">
					{{-- <?php echo $bill['Note'];?> --}}
				</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-6 p-1">
				<button type="button" class="btn-print" onclick="cms_save_table()"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)</button>
			</div>
			<div class="col-md-6 col-xs-6 p-1" >
				<button type="button" class="btn-pay" onclick="cms_save_oder()" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu (F10)</button>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row form-group">
			<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
			<div class="col-md-8">
				<input type="text" value="0" class="form-control total-pay" disabled="disabled">
			</div>
		</div>
		<div class="row form-group">
			<label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
			<div class="col-md-8">
				<input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
			</div>
		</div>
		<div class="row form-group">
			<label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
			<div class="col-md-8 excess-cash">
				0
			</div>
		</div>
	</div>
</div>
</div>

</div>

</div>
@else
	<div class="row" id="bill-info">
		<div class="col-md-2 table-infor">
			<strong data-id="{{$id_table}}" id="table_id">Bàn {{$id_table}}</strong>
		</div>
		<div class="col-md-5">
			<div class="col-md-12 p-0 input-group">
				<input type="text" id="customer-infor" placeholder="Tìm khách hàng" class="form-control">
				<div class="input-group-append">
					<button class="btn btn-primary" data-toggle="modal" data-target="#ModelAddcustomer"><i class="fa fa-plus" aria-hidden="true"></i></button>
				</div>
				<div id="result-customer"></div>
				<span class="del-customer"></span>
			</div>
		</div>
		<div class="col-md-5">
			<select class="form-control">
				<option value="1">ghep order</option>
			</select>
		</div>
	</div>
	<div class="row bill-detail">
		<div class="col-md-12 bill-detail-content">
			<table class="table table-bordered">
				<thead class="thead-light">
					<tr>
						<th scope="col">STT</th>
						<th scope="col">Tên sản phẩm</th>
						<th scope="col">Số lượng</th>
						<th scope="col">Gía bán</th>
						<th scope="col">Thành Tiền</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody id="pro_search_append">

				</tbody>
			</table>
		</div>
	</div>
	<div class="row bill-action">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12 p-1">
					<textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3">
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-xs-6 p-1">
					<button type="button" class="btn-print" onclick="cms_save_table()"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)</button>
				</div>
				<div class="col-md-6 col-xs-6 p-1" >
					<button type="button" class="btn-pay" onclick="cms_save_oder()" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu (F10)</button>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row form-group">
				<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
				<div class="col-md-8">
					<input type="text" value="0" class="form-control total-pay" disabled="disabled">
				</div>
			</div>
			<div class="row form-group">
				<label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
				<div class="col-md-8">
					<input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
				</div>
			</div>
			<div class="row form-group">
				<label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
				<div class="col-md-8 excess-cash">
					0
				</div>
			</div>
		</div>
	</div>
</div>

</div>

</div>
@endif
