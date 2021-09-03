@extends('Man.index')
@section('content')
<div class="row customer-act act">
	<div class="col-md-5">
		<h2>Tạo phiếu nhập <i class="fa fa-angle-double-right" aria-hidden="true"></i></h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
		{{-- <button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Lưu & In</button> --}}
		<button class="btn" onclick="cms_cancel_import();"><i class="fa fa-arrow-left" aria-hidden="true"></i> Hủy</button>
	</div>
</div>
<div class="row content-inport">
	<div class="col-md-8">
		<div class="form-group cashier-search header-cashier" style="padding:0px;background: none;">
			<input type="text" {{-- onkeyup="cms_search_import()" --}} id="search-menu" name="" placeholder="Nhập mã sản phẩm cần nhập" class="form-control">
			<div id="result-menu-post">

			</div>
		</div>
		<div class="form-group bill-detail-content" style="height:150px">
		<table class="table table-striped table-bordered">
			<thead class="thead-light">
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Giá bán</th>
					<th>Thành tiền</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="pro_search_append">
				
			</tbody>
		</table>
		</div>
		<div class="alert alert-success">
			Gõ mã hoặc tên sản phẩm vào hộp tìm kiếm để thêm hàng vào đơn hàng
		</div>

		<div class="container-fluid">
			<div class="row content">
				<div class="row product-list">
					<div class="col-md product-list-content">
						<ul>
									@foreach($pro as $row)
									<li><a href="#" onclick="cms_select_menu('{{$row->IdProduct}}')" title="{{$row->NameProduct}}">
										<div class="img-product">
											<img src="{{asset('storage')}}/assets/images/{{$row->Images}}">
										</div>
										<div class="product-info">
											<span class="product-name">{{$row->NameProduct}}</span><br>
											<strong>{{number_format($row->CostPrice,3)}}</strong>
										</div>
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
</div>
<div class="alert-login">
</div>
<div class="modal fade" id="ModelAddcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-md-4">
	<div class="row form-group">
		<div class="col-md-4 p-0">
			<strong>Nhà cung cấp</strong>
		</div>
		<div class="col-md-8">
			<div class="input-group">
				<select class="form-control" name="areas-id-{{$row->IdTable}}" id="tableselect">
					@foreach($sup as $row1)
					<option value="{{$row1->IdSupplier}}" 
						>{{$row1->Namesupplier}}
					</option>
					@endforeach
				</select>
				</div>
			</div>
	</div>
	<div class="row form-group">
		<div class="col-md-4 p-0">
			<strong>Ngày nhập</strong>
		</div>
		<div class="col-md-8">
			<input type="date" class="form-control">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-4 p-0">
			<strong>Người nhập</strong>
		</div>
		<div class="col-md-8">
			<select class="form-control" name="user-id-{{$row->IdTable}}" id="tableselect">
				@foreach($user as $row2)
				<option value="{{$row2->UserId}}" 
					>{{$row2->UserName}}
				</option>
				@endforeach
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
	<div class="row">
		<div class="col-md-12">
			<h4 class="lighter"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin thanh toán</h4>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-4 p-0">
			<strong>Hình thức</strong>
		</div>
		<div class="col-md-8 form-inline">
			<div class="form-check">
				<label class="form-check-label">Tiền mặt</label>
			</div>
			
		</div>
	</div>
	<div class="col-md-12">
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
<script>
	

// 	function cms_cancel_import(){
// 	$('.result-content').load('warehousing.php');
// }
$('#search-menu').keyup(function(){
	var menuname = $(this).val();
	if(menuname==''){
		$('#result-menu-post').css('display','none');
	}
	else{
		$param = {
			type:'POST',
			url:'{{route('admin.pro_searchmenu')}}',
			dataType:'html',
			data:
			{
				menuname:menuname
			},
			callback: function(data){
				$('#result-menu-post').html(data);
				$('#result-menu-post').css('display','block');
				cms_load_infor_order();
				cms_load_Excesscash();
			}
		}
		ajax_adapter($param);
	}
});

function cms_select_menu($id_menu){
	if($('#pro_search_append tr').length != 0){
		var flag= 0;
		$('#pro_search_append tr').each(function(){
			var id_temp = $(this).attr('data-id');
			if($id_menu==id_temp){
				var value_input = $(this).find('input.quantity-product-oders');
				value_input.val(parseInt(value_input.val()) + 1);
					$('#result-menu-post').css('display','none');
				flag = 1;
				cms_load_infor_order();
				cms_load_Excesscash();
			}
		});
		if(flag==0){
			var $param={
				type:'POST',
				url:'{{route('admin.pro_append')}}',
				dataType:'html',
				data:
				{
					id_menu:$id_menu
				},
				callback: function(data){
					$('#pro_search_append').prepend(data);
						$('#result-menu-post').css('display','none');
					cms_load_infor_order();
					cms_load_Excesscash();
				}
			}
			ajax_adapter($param);
		}
	}else{
		var $param={
			type:'POST',
			url:'{{route('admin.pro_append')}}',
			dataType:'html',
			data:
			{
				id_menu:$id_menu
			},
			callback: function(data){
				$('#pro_search_append').prepend(data);
					$('#result-menu-post').css('display','none');
				cms_load_infor_order();
			}
		}
		ajax_adapter($param);
	}
}
//xóa

	// $(document).on('click', '.del-pro-order', function () {
	// 	cms_load_infor_order();
	// 	cms_load_Excesscash();
	// 	$(this).parents('tr').remove();
		
	// });
//nút cộng trừ
$( document ).on('click','.btn-number',function(e){       
	e.preventDefault();                
	var fieldName = $(this).attr('data-field');        
	var type      = $(this).attr('data-type');        
	var input = $("input[name='"+fieldName+"']");        
	var currentVal = parseInt(input.val());        
	if (!isNaN(currentVal)) {            
		if(type == 'minus') {                
			var minValue = parseInt(input.attr('min'));                 
			if(!minValue) minValue = 1;                
			if(currentVal > minValue) {                    
				input.val(currentVal - 1).change();     
				cms_load_infor_order();
				cms_load_Excesscash();               
			}                 
			if(parseInt(input.val()) == minValue) {                    
				$(this).attr('disabled', true);                
			}                
		} 
		else if(type == 'plus') {                
			var maxValue = parseInt(input.attr('max'));                
			if(!maxValue) maxValue = 50;                
			if(currentVal < maxValue) {                    
				input.val(currentVal + 1).change();
				cms_load_infor_order();
				cms_load_Excesscash();                
			}                
			if(parseInt(input.val()) == maxValue) {                    
				$(this).attr('disabled', true);                
			}                
		}        
	} 
	else {            
		input.val(0);        
	}      

	$('.input-number').focusin(function(){       
		$(this).data('oldValue', $(this).val());    
	});    
	$('.input-number').change(function() {                
		var minValue =  parseInt($(this).attr('min'));        
		var maxValue =  parseInt($(this).attr('max'));        
		if(!minValue) minValue = 1;        
		if(!maxValue) maxValue = 50;        
		var valueCurrent = parseInt($(this).val());                
		var name = $(this).attr('name');        
		if(valueCurrent >= minValue) {            
			$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')        
		} 
		else {            
			alert('Sorry, the minimum value was reached');            
			$(this).val($(this).data('oldValue'));        
		}        
		if(valueCurrent <= maxValue) {            
			$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')        
		} else {            
			alert('Sorry, the maximum value was reached');            
			$(this).val($(this).data('oldValue'));        
		}                    
	});    

});

</script>
@endsection