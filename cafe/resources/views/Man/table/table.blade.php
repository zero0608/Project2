@extends('Man.index')
@section('content')
<div class="row act">
	<div class="col-md-5">
		<h2>Phòng/Bàn</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddTable"><i class="fa fa-plus" aria-hidden="true"></i> Thêm bàn</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#ModalAddGroup"><i class="fa fa-list" aria-hidden="true"></i> Thêm phòng</button>
		<button class="btn btn-success">
			<i class="fa fa-sign-in" aria-hidden="true"></i> Nhập file
		</button>
		<button class="btn btn-success">
			<i class="fa fa-sign-out" aria-hidden="true"></i> Xuất file
		</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-5 form-group">
		<input type="text" name="txtproductname" placeholder="Nhập mã hoặc tên bàn" class="form-control" id="myInput" onkeyup="myFunction()">
	</div>
	{{-- <div  onclick="cms_searchtable(17)">test</div> --}}
	<div class="col-md-2 form-group p-0">
		<button class="form-control" onclick="dropFunction()">Chọn Phòng</button>
		<div class="w3-dropdown-content w3-bar-block w3-card w3-light-grey form-control" id="myDIV">
			<a class="form-control" onclick="cms_searchtable(0)">Tất cả các phòng</a>
			@foreach($area as $rowarea)
					<a class="form-control" onclick="cms_searchtable({{$rowarea->IdArea}})">{{$rowarea->BranchName}}</a>
			@endforeach
		</div>
	</div>
	{{-- <div class="col-md-3 form-group">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div> --}}
</div>
<div class="row content-table">
	<div class="col-md-12">
		<table class="table table-striped table-bordered" id="myTable">
			<thead class="table-primary">
				<tr>
					<th>Tên phòng/bàn</th>
					{{-- <th>Ghi chú</th> --}}
					<th>Nhóm</th>
					{{-- <th>Số ghế</th> --}}
					<th>Trạng thái</th>
					<th>Tình Trạng</th>
				</tr>
			</thead>
			<tbody id="load_pagination_table">
				@if($table===null)
				<td colspan="6" class="text-center">Chưa có bàn nào</td>
				@else
				@foreach($table as $row)
				<tr data-toggle="collapse" data-target="#collapse-{{$row->IdTable}}" aria-expanded="false" aria-controls="collapse-DH001">
					<td>{{$row->TableName}}</td>
					{{-- <td></td> --}}
					<td>{{$row->BranchName}}</td>
					{{-- <td></td> --}}
					<td>{{$row->check}}</td>
					<td>{{$row->check2}}</td>
				</tr>
				<tr class="collapse tr-detail table-detail" id="collapse-{{$row->IdTable}}">
					<td colspan="5">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="row form-group">
									<div class="col-md-4">
										Tên phòng/Bàn
									</div>
									<div class="col-md-8">
										{{$row->TableName}}
									</div>
								</div>
								{{-- <div class="row form-group">
									<div class="col-md-4">
										Shố ghế
									</div>
									<div class="col-md-8">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-4">
										Ghi chú
									</div>
									<div class="col-md-8">
									</div>
								</div> --}}
								<div class="row form-group">
									<div class="col-md-4">
										Nhóm
									</div>
									<div class="col-md-8">
										{{$row->BranchName}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-right">
										<button class="btn btn-success" data-toggle="modal" data-target="#ModelEditTable-{{$row->IdTable}}"><i class="fa fa-check-square" aria-hidden="true"></i>Cập nhật</button>
										<button class="btn btn-danger" onclick="cms_off({{$row->active}},'{{$row->IdTable}}')"><i class="fa fa-lock" aria-hidden="true"></i>{{$row->button}}</button>
										{{-- <button class="btn btn-danger" data-toggle="modal" data-target="#ModelDelTable-{{$row->IdTable}}"><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button> --}}
									</div>
								</div>
							</div>
						</div>
						{{-- <div class="modal fade" id="ModelDelTable-{{$row->IdTable}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Đồng ý xóa bàn này</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" onclick="cms_del_table({{$row->IdTable}})" class="btn btn-primary">Đồng Ý</button>
									</div>
								</div>
							</div>
						</div> --}}
						<div class="modal fade" id="ModelEditTable-{{$row->IdTable}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin bàn</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row form-group">
											<div class="col-md-4">
												<label>Tên phòng/Bàn <span style="color:red;">(*)</span></label>
											</div>
											<div class="col-md-8">
												<input type="text" name="tablename-{{$row->IdTable}}" placeholder="Nhập tên phòng/bàn" class="form-control" value="{{$row->TableName}}">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-4">
												<label>Nhóm</label>
											</div>
											<div class="col-md-8">
												<select class="form-control" name="areas-id-{{$row->IdTable}}" id="tableselect">
													<option value="0">Chọn phòng bàn</option>
													@foreach($area as $rowarea)
													<option value="{{$rowarea->IdArea}}" 
														@if($rowarea->IdArea==$row->IdArea)
														selected 
														@endif
														>{{$rowarea->BranchName}}</option>
													@endforeach
												</select>
											</div>
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" onclick="cms_update_table({{$row->IdTable}})" class="btn btn-primary">Lưu</button>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>

		<ul class="pagination">
			@php
			$limit=10;
			$totalpage = ceil($count/$limit);
			@endphp
			@for($i=1; $i <=$totalpage ; $i++)
			<li class="page-item"><a class="page-link" onclick="cms_pagination({{$i}})" href="#">{{$i}}</a></li>

			@endfor

		</ul>
	</div>
</div>

<!-- Modal add group -->
<div class="modal fade" id="ModalAddGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Thêm phòng</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#listcategory" role="tab" aria-selected="true"><i class="fa fa-list" aria-hidden="true"></i> Tất cả phòng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#addcategory" role="tab" aria-selected="false"><i class="fa fa-plus" aria-hidden="true"></i> Thêm phòng</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane fade show active" id="listcategory" role="tabpanel">
						<table class="table table-bordered">
							<thead>
							</thead>
							<tbody id="load_table">
								@if($area===null)
								<td colspan="6" class="text-center">Chưa có phòng nào</td>
								@else
								@foreach($area as $rowarea)
								{{-- <td></td> --}}
								<tr id="list_{{$rowarea->IdArea}}"><td>{{$rowarea->BranchName}}</td>
									<td><i class="fa fa-trash" aria-hidden="true" onclick="cms_delete_grouptable({{$rowarea->IdArea}})"></i></td>
								</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>

						<div class="tab-pane fade" id="addcategory" role="tabpanel">
							<div class="modal-body">
								<div class="row form-group">
									<div class="col-md-4">
										<label>Tên phòng</label>
									</div>
									<div class="col-md-8">
										<input type="text" name="namgrouptable" placeholder="Nhập tên phòng" class="form-control">
									</div>
								</div>
								<div class="col-md-12 text-right">
									<button type="button" onclick="cms_add_grouptable()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
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


	<!-- Modal add table -->
	<div class="modal fade" id="ModalAddTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Thêm Bàn</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row form-group">
						<div class="col-md-4">
							<label>Tên phòng/Bàn <span style="color:red;">(*)</span></label>
						</div>
						<div class="col-md-8">
							<input type="text" name="tablename" placeholder="Nhập tên phòng/bàn" class="form-control">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-4">
							<label>Nhóm</label>
						</div>
						<div class="col-md-8">
							<select class="form-control" name="areas-id" id="tableselect">
								<option value="0">Chọn phòng bàn</option>
								@foreach($area as $rowarea)
								<option value="{{$rowarea->IdArea}}">{{$rowarea->BranchName}}</option>
								@endforeach
							</select>
						</div>
					</div>
				{{-- <div class="row form-group">
					<div class="col-md-4">
						<label>Số ghế</label>
					</div>
					<div class="col-md-8">
						<input type="" name="" placeholder="Số ghế" class="form-control">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Ghi chú</label>
					</div>
					<div class="col-md-8">
						<textarea class="form-control" rows="3"></textarea>
					</div>
				</div> --}}
			</div>
			<div class="modal-footer">
				<button type="button" onclick="cms_add_table()" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
			</div>
		</div>
	</div>
</div>
@endsection