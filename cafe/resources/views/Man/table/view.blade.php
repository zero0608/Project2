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