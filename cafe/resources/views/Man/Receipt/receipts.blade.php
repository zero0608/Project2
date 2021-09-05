@extends('Man.index')
@section('content')
<div class="row act">
	<div class="col-md-5">
		<h2>Phiếu thu</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddMenu"><i class="fa fa-plus" aria-hidden="true"></i> Thêm phiếu</button>
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
					<th>Người lập</th>
					<th>Tiền nhận</th>
					<th>Note</th>
					<th>Liên kết</th>
					<th>Ngày lập</th>
				</tr>
			</thead>
			<tbody id="load_pagination_menu">
				@foreach($re as $row)
				<tr>
					<td>{{$row->IdReceipt}}</td>
					<td>{{$row->UserId}}</td>
					<td>{{number_format($row->Totalprice,0)}}đ</td>
					<td>{{$row->Note}}</td>
					<td>
						<a href="">{{$row->Format}}</a>
					</td>
					<td>{{$row->created_at}}
					</td>
					@endforeach
				</tbody>
			</table>

					<ul class="pagination">
						@php
						$limit=6;
						$totalpage = ceil($count/$limit);
						@endphp
						@for($i=1; $i <=$totalpage ; $i++)
						<li class="page-item"><a class="page-link" onclick="cms_pagination_re({{$i}})" href="#">{{$i}}</a></li>
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
							<form action="{{route('receipt.store')}}" method="post" enctype="multipart/form-data" id="form">
								@csrf
								<div class="row form-group">
									<div class="col-md-4">
										<b>Lý do tạo</b>
									</div>
									<div class="col-md-8">
										<textarea class="form-control" name="note"></textarea>
										<span class="text-danger error-text note_error"></span>
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
										<b>Người tạo</b>
									</div>
									<div class="col-md-8">
										<select class="form-control" name="user" id="tableselect">
											@foreach($user as $rowcate)
											<option value="{{$rowcate->UserId}}" 
												>{{$rowcate->UserName}}</option>
												@endforeach
											</select>
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

							function cms_pagination_re($current_page){
								$param = {
									type:'GET',
									url:'{{route('admin.pagination_re')}}',
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
												cms_pagination_re(1);
											}
											if(data.code==2){
												$(form)[0].reset();
												alert(data.msg);
											}
										}
									});
								});
							})
						</script>
						@endsection