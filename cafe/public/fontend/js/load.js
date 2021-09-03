$(document).ready(function(){
	// $('.result-content').load('dashboard.php');
	// $('#sidebar ul li a').click(function(){
	// 	$('#sidebar ul li a').removeClass('active');
	// 	$(this).addClass('active');
	// 	return false;
	// });
	$('#searchproduct').keyup(function(){
		var key = $(this).val();
		$param = {
			type:'POST',
			url:'backend/searchproduct.php',
			data:{
				key:key
			},
			dataType:'html',
			callback:function(result){
				alert(result);
			}
		}
		ajax_adapter($param);
	});
});
function ajax_adapter($param){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var _token=$('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type:$param.type,
		url:$param.url,
		data:$param.data,
		dataType:$param.dataType,
		async:true,
		success:$param.callback
	});
}

function cms_addcateproduct(){
	var name = $('input[name="txtcategory"]').val();
	$param = {
		type:'POST',
		url:'controller/addcategorymenu.php',
		data:{
			name:name
		},
		dataType:'html',
		callback:function(result){
			if(result=='1'){
				$('.result-content').load('product.php');
			}else{

			}
		}
	}
	ajax_adapter($param);

}
function tab_click_act(act){
	$('.act').not(this).hide();
	$('.'+act+'-act').show();
}
// function cms_load_importware(){
// 	$('.result-content').load('importwarehosing.php');
// }
// function cms_load_stockimport(){
// 	$('.result-content').load('stockimport.php');
// }


// function cms_del_pro_order(){
	$(document).on('click', '.del-pro-order', function () {
		$(this).parents('tr').remove();
		cms_load_infor_order();
		cms_load_Excesscash();
	});
// }

function cms_decode_currency_format(obs) {
	if (obs == '')
		return 0;
	else
		return parseInt(obs.replace(/,/g, ''));
}

function cms_encode_currency_format(obs) {
	return obs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function cms_load_infor_order(){
	var $total_money=0;
	$('tbody#pro_search_append tr').each(function () {
		$quantity_product = $(this).find('input.quantity-product-oders').val();
		$price = cms_decode_currency_format($(this).find('input.price-order').val());
		$total = $price * $quantity_product;
		$total_money += $total;
		$(this).find('td.total-money').html(cms_encode_currency_format($total));
		$('input.total-pay').val(cms_encode_currency_format($total_money));
	});
}

function cms_load_Excesscash(){
	$('.customer-pay').keyup(function(){
		var customer_pay;
		if($(this).val()==''){
			customer_pay=0;
		}else{
			customer_pay = cms_decode_currency_format($(this).val());
		}
		var total_pay = cms_decode_currency_format($('.total-pay').val());
		var debt = customer_pay - total_pay;
		$(this).val(cms_encode_currency_format(customer_pay));
		$('.excess-cash').html(cms_encode_currency_format(debt));
	});
}



