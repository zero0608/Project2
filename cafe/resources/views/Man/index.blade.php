	<!DOCTYPE html>
<html>
<head>
	<title>Phần mềm quản lý bán hàng</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('fontend')}}/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('fontend')}}/css/style.css">
	<link rel="stylesheet" href="{{asset('fontend')}}/font-awesome/css/font-awesome.min.css">
	<script type="text/javascript" src="{{asset('fontend')}}/js/jquery.min.js"></script>
	<script type="text/javascript" src="{{asset('fontend')}}/js/popper.min.js"></script>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	{{-- <script type="text/javascript" src="{{asset('fontend')}}/js/jquery.pjax.js"></script> --}}
	<script type="text/javascript" src="{{asset('fontend')}}/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{asset('fontend')}}/js/load.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	{{-- <script src="{{asset('fontend')}}js/Chart.min.js"></script> --}}
	{{-- <script src="{{asset('fontend')}}/js/chartdoashboad.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" integrity="sha512-7G7ueVi8m7Ldo2APeWMCoGjs4EjXDhJ20DrPglDQqy8fnxsFQZeJNtuQlTT0xoBQJzWRFp4+ikyMdzDOcW36kQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.js" integrity="sha512-THe9Z0v2MIJ3CmLR4JhxZkArrsI9wP7ENJ59DGbn9bvcf06w1JqWV9ol7OfyNkAC5r02F49rG/zm5Z9TiPH32Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="crossbar" id="haha">
	<div class="header-admin" style=" position: fixed;width: 100%;z-index:9999">
		<div class="container-fluid">
			<div class="row"> 
				<div class="col-md-12">
					<ul class="nav navbar-nav float-right">
						<li class=" dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Xin chào Admin</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="logout.php">Đăng xuất</a>
				          <a class="dropdown-item" href="#">Tài khoản</a>
				        </div>
      					</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
		<div class="row" style="position: relative;top: 37px;">
			<div class="col-md-2">
				<div class="sidebar sidebar-fixed" id="sidebar" style=" position: fixed;">
					<ul class="list-group">
						<li class="list-group-item"><a href="{{route('admin.das')}}" class="active"><i class="fa fa-eye" aria-hidden="true"></i>Tổng quan</a>
						</li>
						<li class="list-group-item"><a href="{{route('admin.bill')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Hóa đơn</a></li>
						<li class="list-group-item"><a href="{{route('admin.merc')}}"><i class="fa fa-barcode" aria-hidden="true"></i>Hàng hóa</a></li>
						<li class="list-group-item"><a href="{{route('admin.table')}}"><i class="fa fa-table" aria-hidden="true"></i>Phòng/Bàn</a></li>
						<li class="list-group-item"><a href="{{route('admin.cus')}}"><i class="fa fa-users" aria-hidden="true"></i>Khách hàng / NCC</a></li>
						<li class="list-group-item"><a href="{{route('admin.product1')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Thực đơn</a></li>
						<li class="list-group-item"><a href="{{route('admin.ware')}}"><i class="fa fa-truck" aria-hidden="true"></i>Nhập kho</a></li>
						<li class="list-group-item"><a href="{{route('admin.receipts')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Phiếu thu</a></li>
						<li class="list-group-item"><a href="{{route('admin.payment')}}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Phiếu chi</a></li>
						<li class="list-group-item"><a href=""><i class="fa fa-signal" aria-hidden="true"></i>Doanh thu</a></li>
						<li class="list-group-item"><a href="{{route('admin.das')}}"><i class="fa fa-cogs" aria-hidden="true"></i></i>Thiết lập</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-10" >
				<div class="result-content" id="hihi">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	<div class="alert-login">
		
	</div>
	</body>
	<script>
	$(document).ready(function(){
	$(document).pjax('a', '#hihi')
	 if ($.support.pjax) {
    	$.pjax.defaults.timeout = 2000; // time in milliseconds
    }
	});
    // does current browser support PJAX
    // if ($.support.pjax) {
    // 	$.pjax.defaults.timeout = 1000; // time in milliseconds
    // }

    function cms_add_table(){
	var tablename = $('input[name="tablename"]').val();
	var idarea = $('select[name="areas-id"]').val();
	if(tablename==''){
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên phòng/bàn không để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	}else{
		$param = {
			type:'POST',
			url:'{{route('tab.store')}}',
			data:{
				tablename:tablename,
				idarea:idarea
			},
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên bàn đã tồn tại</p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					$('#ModalAddTable').modal('hide');
					// $('.result-content').load(view('Man.table.table'));
					cms_pagination(1);
				}
			}
		}
	ajax_adapter($param);
	}
}

 function cms_update_table($id){
	var tablename = $('input[name="tablename-'+$id+'"]').val();
	var idarea = $('select[name="areas-id-'+$id+'"]').val();
	if(tablename==''){
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên phòng/bàn không để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	}else{
		$param = {
			type:'PUT',
			url:'http://127.0.0.1:8000/tab/'+$id,
			data:{
				tablename:tablename,
				idarea:idarea
			},
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên bàn đã tồn tại</p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					cms_pagination(1);
					$('#ModelEditTable-'+$id).modal('hide');
					// $('.result-content').load(view('Man.table.table'));
					
				}
			}
		}
	ajax_adapter($param);
	}
}

function cms_add_grouptable(){
	var namegroup = $('input[name="namgrouptable"]').val();
	if(namegroup==''){
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên nhóm không để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	}else{
		$param = {
			type:'POST',
			url:'{{route('are.store')}}',
			data:{
				namegroup:namegroup
			},
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên nhóm đã tồn tại</p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					$('#ModalAddGroup').modal('hide');
					$('#load_table').prepend(result);
				}
			}
		}
	ajax_adapter($param);
	}
}

function cms_delete_grouptable($idgroup){
		$param = {
			type:'DELETE',
			url:'http://127.0.0.1:8000/are/'+$idgroup,
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không thể xóa </p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Đã xóa </p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					$('#ModalAddGroup').modal('hide');
					$('#list_'+$idgroup).remove();
				}
			}
		}
	ajax_adapter($param);
	}


function cms_pagination($current_page){
	$param = {
			type:'GET',
			url:'{{route('admin.pagination')}}',
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

function cms_searchtable($option){
	$param = {
			type:'GET',
			url:'{{route('admin.searchtab')}}',
			data:{
				option:$option,
			},
			dataType:'html',
			callback:function(result){
				$('#load_pagination_table').html(result);
			}
		}
	ajax_adapter($param);
}

function cms_off($status,$idtable){
	$param = {
			type:'POST',
			url:'{{route('admin.key')}}',
			data:{
				status:$status,
				id:$idtable
			},
			dataType:'html',
			callback:function(result){
					cms_pagination(0);
			}
		}
	ajax_adapter($param);
}

function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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


function dropFunction() {
  var x = document.getElementById("myDIV");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}


function reload(){
	$param = {
			type:'GET',
			url:'{{route('admin.das')}}',
			dataType:'html',
			callback:function(result){
					$('#haha').html(result);
					$('.alert-login').html('<h3>Thông báo !</h3><p>Đã cập nhật dữ liệu mới nhất</p>').fadeIn().delay(1000).fadeOut('slow');
			}
		}
	ajax_adapter($param);
}
</script>
</html>