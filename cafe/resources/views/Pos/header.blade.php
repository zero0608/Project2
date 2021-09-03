<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('fontend')}}/css/style.css">
	<link rel="stylesheet" type="text/css" href="{{asset('fontend')}}/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('fontend')}}/bootstrap/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{asset('fontend')}}/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{asset('fontend')}}/js/clickevent.js"></script>
	<script>
	
</script>
</head>
<body>
	<div class="header-cashier">
		<div class="container-fluid">
			<div class="row ft-tabs">
				<div class="col-md-3">
					<ul class="tabs-list">
						<li><a href="#" class="active" onclick="cms_load_table(0)" data="listtable">Phòng Bàn</a></li>
						<li><a href="#" data="pos">Thực đơn</a></li>
					</ul>
				</div>
				<div class="col-md-4 cashier-search">
					<input type="text" name="txtnamemenu" id="search-menu" placeholder="Nhập tên mặt hàng" class="form-control">
					<div id="result-menu-post">
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		@yield('content')
	</div>
</body>
<script>
	$('#search-menu').keyup(function(){
		var menuname = $(this).val();
		var _token=$('meta[name="csrf-token"]').attr('content');
		if(menuname==''){
			$('#result-menu-post').css('display','none');
		}
		else{
			$param = {
				type:'POST',
				url:'{{route('searchmenu')}}',
				dataType:'html',
				data:
				{
					menuname:menuname
				},
				callback: function(data){
					$('#result-menu-post').html(data);
					$('#result-menu-post').css('display','block');
				}
			}
			ajax_adapter($param);
		}
	});


$('#customer-infor').keyup(function(){
		var customer = $(this).val();
		if(customer==''){
			$('#result-customer').css('display','none');
		}else{
			$param = {
				type:'POST',
				url:'{{route('kaka')}}',
				dataType:'html',
				data:
				{
					customer:customer
				},
				callback: function(data){
					$('#result-customer').html(data);
					$('#result-customer').css('display','block');
				}
			}
			ajax_adapter($param);
		}
	});


function cms_load_table($id_table){
	var $param={
		type:'POST',
		url:'{{route('table')}}',
		dataType:'html',
		data:
		{
			id_table:$id_table
		},
		callback: function(data){
			$('.table-list').html(data);
		}
	}
	ajax_adapter($param);
	$('#table-list').attr('hidden',false);
			// $('#table-list').load('table.php');
			$('#pos').attr('hidden',true);
	}

	function cms_load_cate($id_cate){
	var $param={
		type:'POST',
		url:'{{route('load_cate')}}',
		dataType:'html',
		data:
		{
			id_cate:$id_cate
		},
		callback: function(data){
			$('.product-list-content').html(data);
		}
	}
	ajax_adapter($param);
	}




function cms_select_menu($id_menu){
			if($('#pro_search_append tr').length != 0){
				var flag= 0;
				$('#pro_search_append tr').each(function(){
					var id_temp = $(this).attr('data-id');
					if($id_menu==id_temp){
						var value_input = $(this).find('input.quantity-product-oders');
						value_input.val(parseInt(value_input.val()) + 1);
						flag = 1;
						cms_load_infor_order();
						cms_load_Excesscash();
					}
				});
				if(flag==0){
					var $param={
						type:'POST',
						url:'{{route('append')}}',
						dataType:'html',
						data:
						{
							id_menu:$id_menu
						},
						callback: function(data){
							$('#pro_search_append').prepend(data);
							cms_load_infor_order();
							cms_load_Excesscash();
						}
					}
					ajax_adapter($param);
				}
			}else{
				var $param={
					type:'POST',
					url:'{{route('append')}}',
					dataType:'html',
					data:
					{
						id_menu:$id_menu
					},
					callback: function(data){
						$('#pro_search_append').prepend(data);
						cms_load_infor_order();
					}
				}
				ajax_adapter($param);
			}
		}


		function cms_load_pos($id_table){
	$param={
		type:'GET',
		url:'{{route('load_pos')}}',
		dataType:'html',
		data:
		{
			id_table:$id_table
		},
		callback: function(data){
			$('#content-listmenu').html(data);
			cms_load_infor_order();
			cms_load_Excesscash();
		}
	}
	ajax_adapter($param);
	$('#table-list').attr('hidden',true);
	$('#pos').attr('hidden',false);
	$('.table_infor').html('<strong data-id="'+$id_table+'" id="table_id">Bàn '+$id_table+'</strong>');
}


function cms_save_oder(){
				if($('tbody#pro_search_append tr').length !=0){
					var customer_id = $('#customer-infor').attr('data-id');
					var table_id = $('#table_id').attr('data-id');
					if (typeof table_id !== 'undefined' && table_id !== false) {
						var note = $('#note-order').val();
						var customer_id = typeof $('#customer-infor').attr('data-id') === 'undefined' ? 0 : $('#customer-infor').attr('data-id');
						var customer_pay = cms_decode_currency_format($('input.total-pay').val());
						var detail = [];
						$('tbody#pro_search_append tr').each(function () {
							var id = $(this).attr('data-id');
							var quantity = $(this).find('input.quantity-product-oders').val();
							var price = cms_decode_currency_format($(this).find('input.price-order').val());
							detail.push(
								{id: id, quantity: quantity, price: price}
								);
						});
						var $data ={
							'data':{
								'table_id':table_id,
								'customer_id':customer_id,
								'note':note,
								'customer_pay':customer_pay,
								'detai_oder':detail
							}
						}
						var $param={
							type:'POST',
							url:'{{route('save')}}',
							dataType:'html',
							data:$data,
							callback: function(data){
								$('.alert-login').html(data).fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
								cms_load_pos(table_id);
							}
						}
						ajax_adapter($param);
	// 	$('#table-list').attr('hidden',true);
	// $('#pos').attr('hidden',false);

}else{
	$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn bàn</p>').fadeIn().delay(1000).fadeOut('slow');
}}else{
	$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi lưu</p>').fadeIn().delay(1000).fadeOut('slow');
}
	// location.reload();
	
}




function cms_save_table(){
			if($('tbody#pro_search_append tr').length !=0){
				var customer_id = $('#customer-infor').attr('data-id');
				var table_id = $('#table_id').attr('data-id');
				if (typeof table_id !== 'undefined' && table_id !== false) {
					var note = $('#note-order').val();
					var customer_id = typeof $('#customer-infor').attr('data-id') === 'undefined' ? 0 : $('#customer-infor').attr('data-id');
					var customer_pay = cms_decode_currency_format($('input.total-pay').val());
					var detail = [];
					$('tbody#pro_search_append tr').each(function () {
						var id = $(this).attr('data-id');
						var quantity = $(this).find('input.quantity-product-oders').val();
						var price = cms_decode_currency_format($(this).find('input.price-order').val());
						detail.push(
							{id: id, quantity: quantity, price: price}
							);
					});
					var $data ={
						'data':{
							'table_id':table_id,
							'customer_id':customer_id,
							'note':note,
							'customer_pay':customer_pay,
							'detai_oder':detail
						}
					}
					var $param={
						type:'POST',
						url:'{{route('pay')}}',
						dataType:'html',
						data:$data,
						callback: function(data){
							var mywindow = window.open('', 'In hóa đơn', 'height=500,width=1000');
							if (mywindow == null) {
								alert('Trình duyệt đã ngăn không cho phần mềm In. Vui lòng mở khóa hiển thị In ở góc phải phía trên của trình duyệt');
							} else {
								mywindow.document.writeln(data);
								mywindow.document.close();
								mywindow.focus();
								mywindow.print();
								mywindow.close();
								location.reload();
							}
						}
					}
					ajax_adapter($param);

				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn bàn</p>').fadeIn().delay(1000).fadeOut('slow');
				}}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi lưu</p>').fadeIn().delay(1000).fadeOut('slow');
				}
			}

</script>
</html>