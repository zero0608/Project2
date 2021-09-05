
@extends('Man.index')
@section('content')
<div class="row act">
	<div class="col-md-5">
		<h2>Hàng hóa</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddMenu"><i class="fa fa-plus" aria-hidden="true"></i> Thêm sản phẩm</button>
	</div>
</div>

<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtproductname" placeholder="Nhập tên sản phẩm" class="form-control" id="myPro" onkeyup="myPro()">
	</div>
</div>
<div class="row content-product">
	<div class="col-md-12">
		<table class="table table-striped table-bordered" valign="middle" id="Pro">
			<thead class="table-primary">
				<tr>
					<th>Mã</th>
					<th>Tên sản phẩm</th>
					<th>Gía bán</th>
					<th>ĐVT</th>
					<th>Hình ảnh</th>
					<th>NCC</th>
					<th width="120px">Hành động</th>
					<th width="70px">Sửa</th>
				</tr>
			</thead>
			<tbody id="load_pagination_menu">
				@foreach($pro as $row)
				<tr>

					<td>{{$row->IdProduct}}</td>
					<td>{{$row->NameProduct}}</td>
					<td>{{number_format($row->CostPrice,0)}}đ</td>
					<td>{{$row->Unit}}</td>
					<td><img width="50px" height="50px" src="{{asset('storage')}}/assets/images/{{$row->Images}}"></td>
					<td>{{$row->IdSupplier}}</td>
					<td>
						<button class="btn btn-danger" onclick="cms_off_pro({{$row->active}},'{{$row->IdProduct}}')">{{$row->check1}}</button>
					</td>
					<td>
						<button class="btn btn-success "  data-toggle="modal" data-target="#ModelEditTable-{{$row->IdProduct}}">
							Sửa
						</button>

						<div class="modal fade" id="ModelEditTable-{{$row->IdProduct}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Sửa sản phẩm</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{route('pro.update',$row->IdProduct)}}" method="post" enctype="multipart/form-data">
											@csrf
											@method("put")
											<div class="row form-group">
												<div class="col-md-4">
													<b>Mã sản phẩm</b>
												</div>
												<div class="col-md-8">
													<input type="text" name="code" placeholder="Mã mặc định" class="form-control" readonly value="{{$row->IdProduct}}">
													{{-- <span class="text-danger error-text code_error"></span> --}}
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-4">
													<b>Tên sản phẩm</b>
												</div>
												<div class="col-md-8">
													<input type="text" name="name" class="form-control" value="{{$row->NameProduct}}">
													<span class="text-danger error-text name_error"></span>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-4">
													<b>Giá</b>
												</div>
												<div class="col-md-8">
													<input type="text" name="price" class="form-control" value="{{$row->CostPrice}}">
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
													<b>NCC</b>
												</div>
												<div class="col-md-8">
													<select class="form-control" name="sup" id="tableselect">
														@foreach($sup as $rowcate)
														<option value="{{$rowcate->IdSupplier}}" 
															@if($rowcate->IdSupplier==$row->IdSupplier)
															selected 
															@endif
															>{{$rowcate->Namesupplier}}</option>
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
						<li class="page-item"><a class="page-link" onclick="cms_pagination_pro({{$i}})" href="#">{{$i}}</a></li>
						@endfor
					</ul>
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
							<form action="{{route('admin.pro')}}" method="post" enctype="multipart/form-data" id="form">
								@csrf
								<div class="row form-group">
									<div class="col-md-4">
										<b>Mã sản phẩm</b>
									</div>
									<div class="col-md-8">
										<input type="text" name="code" placeholder="ví dụ :CF~cafe" class="form-control">
										<span class="text-danger error-text code_error"></span>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-4">
										<b>Tên sản phẩm</b>
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
										<b>NCC</b>
									</div>
									<div class="col-md-8">
										<select class="form-control" name="sup" id="tableselect">
											@foreach($sup as $rowcate)
											<option value="{{$rowcate->IdSupplier}}" 
												>{{$rowcate->Namesupplier}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-12 text-center">
											<div class="jumbotron">
												<h3>Upload hình ảnh sản phẩm </h3>
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
							
							function cms_pagination_pro($current_page){
								$param = {
									type:'GET',
									url:'{{route('admin.pagination_pro')}}',
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
							function cms_off_pro(status,id){
								$param = {
									type:'POST',
									url:'{{route('admin.keypro')}}',
									data:{
										status:status,
										id:id
									},
									dataType:'html',
									callback:function(result){
										cms_pagination_pro(1);
									}
								}
								ajax_adapter($param);
							}

							function myPro() {
								var input, filter, table, tr, td, i;
								input = document.getElementById("myPro");
								filter = input.value.toUpperCase();
								table = document.getElementById("Pro");
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
												cms_pagination_pro(1);
											}
											if(data.code==2){
												$(form)[0].reset();
												alert(data.msg);
											}
										}
									});
								});

								$('input[type="file"][name="product_image"]').val('');

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
						</script>
						@endsection