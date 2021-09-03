@extends('Man.index')
@section('content')
<div class="row">
	<div class="col-md-5">
		<h2>Danh sách thực đơn</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddMenu"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Món ăn</button>

		<button class="btn btn-success" data-toggle="modal" data-target="#AddCategoryModal"><i class="fa fa-th-list" aria-hidden="true"></i> Thêm danh mục</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtproductname" placeholder="Nhập tên sản phẩm" class="form-control" id="mymenu" onkeyup="myMenu()">
	</div>
	<div class="col-md-2 form-group p-0">
		<button class="form-control" onclick="dropFunction()">Chọn danh mục</button>
		<div class="w3-dropdown-content w3-bar-block w3-card w3-light-grey form-control" id="myDIV">
			<a class="form-control" onclick="cms_searchmenu(0)">Tất cả các danh mục</a>
			@foreach($cate as $rowcate)
			<a class="form-control" onclick="cms_searchmenu({{$rowcate->Idcate}})">{{$rowcate->CateName}}</a>
			@endforeach
		</div>
	</div>
	{{-- <div class="col-md-2 form-group">
		<select class="form-control">
			<option>Đồ ăn</option>
			<option>Thức uống</option>
		</select>
	</div> --}}
	{{-- <div class="col-md-2 form-group">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div> --}}
</div>
<div class="row content-product">
	<div class="col-md-12">
		<table class="table table-striped table-bordered" valign="middle" id="menu">
			<thead class="table-primary">
				<tr>
					<th>Mã</th>
					<th>Tên món ăn</th>
					<th>Gía bán</th>
					<th>Hình ảnh</th>
					<th>ĐVT</th>
					<th>Danh mục</th>
					<th width="120px">Hành động</th>
					<th width="70px">Sửa</th>
				</tr>
			</thead>
			<tbody id="load_pagination_menu">
				@foreach($menu as $row)
				<tr>

					<td>{{$row->IdMenu}}</td>
					<td>{{$row->NameMenu}}</td>
					<td>{{number_format($row->Price,0)}}đ</td>
					<td><img width="50px" height="50px" src="{{asset('storage')}}/assets/images/{{$row->Images}}"></td>
					<td>{{$row->Unit}}</td>
					<td>{{$row->check}}</td>
					<td>
						<button class="btn btn-danger" onclick="cms_off_menu({{$row->active}},'{{$row->IdMenu}}')">{{$row->check1}}</button>
					</td>
					<td>
						<button class="btn btn-success "  data-toggle="modal" data-target="#ModelEditTable-{{$row->IdMenu}}">
							Sửa
						</button>

						<div class="modal fade" id="ModelEditTable-{{$row->IdMenu}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Sửa Menu</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{route('menure.destroy',$row->IdMenu)}}" method="post" enctype="multipart/form-data">
         							 @csrf
         							 @method("put")
										<div class="row form-group">
											<div class="col-md-4">
												<b>Mã khách hàng</b>
											</div>
											<div class="col-md-8">
												<input type="text" name="code" placeholder="Mã mặc định" class="form-control" readonly value="{{$row->IdMenu}}">
												{{-- <span class="text-danger error-text code_error"></span> --}}
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-4">
												<b>Tên món</b>
											</div>
											<div class="col-md-8">
												<input type="text" name="name" class="form-control" value="{{$row->NameMenu}}">
												<span class="text-danger error-text name_error"></span>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-4">
												<b>Giá</b>
											</div>
											<div class="col-md-8">
												<input type="text" name="price" class="form-control" value="{{$row->Price}}">
												<span class="text-danger error-text price_error"></span>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-4">
												<b>ĐVT</b>
											</div>
											<div class="col-md-8">
												<input type="text" name="unit" class="form-control" value="{{$row->Unit}}">
												<span class="text-danger error-text unit_error"></span>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-4">
												<b>Danh mục</b>
											</div>
											<div class="col-md-8">
												<select class="form-control" name="cate" id="tableselect">
													<option value="0">Chọn phòng bàn</option>
													@foreach($cate as $rowcate)
													<option value="{{$rowcate->Idcate}}" 
														@if($rowcate->Idcate==$row->Idcate)
														selected 
														@endif
														>{{$rowcate->CateName}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12 text-center">
													<div class="jumbotron">
														<h3>Upload hình ảnh nhà cung cấp</h3>
														<p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
														<input type="file" class="form-control-file" id="exampleFormControlFile1" name="product_image">  
													</div>
												</div>
											</div>
											 {{-- <div id="img-holder-{{$row->IdMenu}}"></div> --}}
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit"  class="btn btn-primary">Lưu</button>
											</div>
										</form>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<ul class="pagination">
						@php
						$limit=6;
						$totalpage = ceil($count/$limit);
						@endphp
						@for($i=1; $i <=$totalpage ; $i++)
						<li class="page-item"><a class="page-link" onclick="cms_pagination_menu({{$i}})" href="#">{{$i}}</a></li>
						@endfor
					</ul>
				</div>
			</div>



			<div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Thêm danh mục</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#listcategory" role="tab" aria-selected="true"><i class="fa fa-list" aria-hidden="true"></i> Tất cả danh mục</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#addcategory" role="tab" aria-selected="false"><i class="fa fa-plus" aria-hidden="true"></i> Thêm danh mục</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade show active" id="listcategory" role="tabpanel">
									<table class="table table-bordered" id="load_menu">
				      	@foreach($cate as $row1)
				      	<tr id="list-{{$row1->Idcate}}">
				      		<td>{{$row1->Idcate}}</td>
				      		<td>{{$row1->CateName}}</td>
				      		<td>
				      			<i class="fa fa-trash" aria-hidden="true" onclick="cms_delete_cate({{$row1->Idcate}})"></i>
				      		</td>
				      	</tr>
				      	@endforeach

				      </tbody>
				    </table>
				  </div>
				  <div class="tab-pane fade" id="addcategory" role="tabpanel">
				  	<div class="row p-1">
				  		<div class="col-md-4">
				  			<label>Tên danh mục</label>
				  		</div>
				  		<div class="col-md-8">
				  			<div class="form-group">
				  				<input type="text" name="menu" class="form-control" placeholder="Nhập tên danh mục">
				  			</div>
				  		</div>
				  		<div class="col-md-12 text-right">
				  			<div class="form-group">
				  				<button class="btn btn-primary" onclick="cms_addcatemenu()"><i class="fa fa-check" aria-hidden="true"></i> Lưu</button>
				  			</div>
				  		</div>
				  	</div>
				  </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="AddMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Thêm món ăn</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
			</div>
		</div>
	</div>
</div>

{{-- model --}}
<div class="modal fade" id="ModalAddMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Thêm Món Ăn</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				 <form action="{{route('admin.product')}}" method="post" enctype="multipart/form-data" id="form">
          @csrf
				<div class="row form-group">
					<div class="col-md-4">
						<b>Mã khách hàng</b>
					</div>
					<div class="col-md-8">
						<input type="text" name="code" placeholder="ví dụ :M001" class="form-control">
						<span class="text-danger error-text code_error"></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<b>Tên món</b>
					</div>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" >
						<span class="text-danger error-text name_error"></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<b>Giá</b>
					</div>
					<div class="col-md-8">
						<input type="text" name="price" class="form-control" >
						<span class="text-danger error-text price_error"></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<b>ĐVT</b>
					</div>
					<div class="col-md-8">
						<input type="text" name="unit" class="form-control" >
						<span class="text-danger error-text unit_error"></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<b>Danh mục</b>
					</div>
					<div class="col-md-8">
						<select class="form-control" name="cate" id="tableselect">
							@foreach($cate as $rowcate)
							<option value="{{$rowcate->Idcate}}" 
								>{{$rowcate->CateName}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12 text-center">
							<div class="jumbotron">
								<h3>Upload hình ảnh nhà cung cấp</h3>
								<p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
								<input type="file" class="form-control-file" id="exampleFormControlFile1" name="product_image"> 
								<span class="text-danger error-text product_image_error"></span> 
							</div>
						</div>
					</div>
					 <div class="img-holder"></div>
					<div class="modal-footer">
						<button type="reset" class="btn">Reset</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" {{-- onclick="cms_addmenu('{{$row->IdMenu}}')" --}} class="btn btn-primary">Lưu</button>
					</div>
				</form>
				</div>
			</div>
<script>
	
	
	function cms_pagination_menu($current_page){
		$param = {
			type:'GET',
			url:'{{route('admin.pagination_menu')}}',
			data:{
				current_page:$current_page,
			},
			dataType:'html',
			callback:function(result){
				$('#load_pagination_menu').html(result);
			}
		}
		ajax_adapter($param);
	}

	function cms_searchmenu($option){
		$param = {
			type:'GET',
			url:'{{route('admin.searchmenu')}}',
			data:{
				option:$option,
			},
			dataType:'html',
			callback:function(result){
				$('#load_pagination_menu').html(result);
				// $(".w3-show").hide();
			}
		}
		ajax_adapter($param);
	}

	function cms_off_menu(status,id){
		$param = {
			type:'POST',
			url:'{{route('admin.keymenu')}}',
			data:{
				status:status,
				id:id
			},
			dataType:'html',
			callback:function(result){
				cms_pagination_menu(1);
			}
		}
		ajax_adapter($param);
	}


	function myMenu() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("mymenu");
		filter = input.value.toUpperCase();
		table = document.getElementById("menu");
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


	//img
	$(function(){
		$('#form').on('submit', function(e){
			e.preventDefault();
			var form = this;
			$.ajax({
				url:$(form).attr('action'),
				method:$(form).attr('method'),
				data:new FormData(form),
				processData:false,
				dataType:'json',
				contentType:false,
				beforeSend:function(){
					$(form).find('span.error-text').text('');
				},
				success:function(data){
					if(data.code == 0){
						$.each(data.error, function(prefix,val){
							$(form).find('span.'+prefix+'_error').text(val[0]);
							 
							});
					}else{
						
						alert(data.msg);
						$('.img-holder').html('');
						cms_pagination_menu(1);
					}
					if(data.code==2){
							$(form)[0].reset();
							alert(data.msg);
					}
				}
			});
		});

		$('input[type="file"][name="product_image"]').val('');
            //Image preview
            $('input[type="file"][name="product_image"]').on('change', function(){
            	var img_path = $(this)[0].value;
            	var img_holder = $('.img-holder');
            	var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            	if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
            		if(typeof(FileReader) != 'undefined'){
            			img_holder.empty();
            			var reader = new FileReader();
            			reader.onload = function(e){
            				$('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
            			}
            			img_holder.show();
            			reader.readAsDataURL($(this)[0].files[0]);
            		}else{
            			$(img_holder).html('This browser does not support FileReader');
            		}
            	}else{
            		$(img_holder).empty();
            	}
            });
          })



		function cms_delete_cate(idgroup){
		$param = {
			type:'DELETE',
			url:'http://127.0.0.1:8000/cate/'+idgroup,
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không thể xóa </p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Đã xóa </p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					$('#AddCategoryModal').modal('hide');
					$('#list_'+$idgroup).remove();
				}
			}
		}
	ajax_adapter($param);
	}


	function cms_addcatemenu(){

		var namegroup = $('input[name="menu"]').val();
	if(namegroup==''){
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên danh mục không để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	}else{
		$param = {
			type:'POST',
			url:'{{route('cate.store')}}',
			data:{
				namegroup:namegroup
			},
			dataType:'html',
			callback:function(result){
				if(result=='0'){
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên danh mục đã tồn tại</p>').fadeIn().delay(1000).fadeOut('slow');
				}else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
					$('#AddCategoryModal').modal('hide');
					$('#load_menu').prepend(result);
				}
			}
		}
	ajax_adapter($param);
	}
	}


</script>
@endsection