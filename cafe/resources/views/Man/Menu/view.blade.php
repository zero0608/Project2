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