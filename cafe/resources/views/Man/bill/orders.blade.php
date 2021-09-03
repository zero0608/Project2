@extends('Man.index')
@section('content')
<div class="row customer-act act">
	{{-- {{$all}} --}}
	{{-- {{$li}} --}}
	{{-- @php
	echo "<pre>";
	var_dump($li);
	@endphp --}}
	<div class="col-md-5">
		<h2>Danh sách hóa đơn</h2>
	</div>
	<div class="col-md-7 text-right action">
		<button class="btn btn-primary" onclick="cms_load_importware()"><i class="fa fa-desktop" aria-hidden="true"></i> Bán hàng</button>
		<button class="btn btn-success"><i class="fa fa-sign-out" aria-hidden="true"></i> Xuất file</button>
	</div>
</div>
<div class="row filter-search">
	<div class="col-md-4 form-group">
		<input type="text" name="txtwarehousing" class="form-control" placeholder="Nhập mã phiếu nhập để tìm kiếm">
	</div>
	<div class="col-md-4 p-0">
		<div class="input-group">
			<input type="date" class="form-control">
	        <div class="input-group-prepend">
	          <span class="input-group-text" id="inputGroupPrepend">Đến</span>
	        </div>
        	<input type="date" class="form-control" aria-describedby="inputGroupPrepend">
      	</div>
	</div>
	<div class="col-md-1 form-group">
		<button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
	</div>
	<div class="col-md-3">
		<div class="btn-group" role="group">
  			<button type="button" class="btn btn-outline-primary">Tuần</button>
  			<button type="button" class="btn btn-outline-primary">Qúy</button>
  			<button type="button" class="btn btn-outline-primary">Năm</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered" id="table-child-event">
            <thead class="table-primary">
                <tr>
                	<th></th>
                  	<th>Mã Hóa Đơn</th>
					<th>Thời gian</th>
                  	<th>Tổng tiền</th>
                  	<th>Ghi chú</th>
                  	<th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
            {{-- <?php
                include('connection.php');
                $sql = "SELECT * FROM bill
                	INNER JOIN users ON users.UserId = bill.IdUser
                	INNER JOIN tables ON tables.IdTable =bill.IdTable
                	INNER JOIN customers ON customers.IdCustomer =bill.IdCustomer";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while ($row = mysqli_fetch_array($result)) { ?> --}}
                    @foreach($li as $row)
                   
                        <tr class="not-detail">
                        	<td data-toggle="collapse" data-target="#collapse-<?php echo $row['id_bill']; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $row['id_bill']; ?>">
                        		<i class="fa fa-plus-circle text-success" aria-hidden="true"></i>
                        	</td>
	                        <td><?php echo $row['id_bill']; ?></td>
	                        <td><?php echo $row['time']; ?></td>
	                        <td><?php echo number_format($row['price'],0); ?></td>
	                        <td><?php echo $row['note'];?></td>
	                        <td>Đã hoàn thành</td>
                        </tr>
                        <tr class="collapse tr-detail td-detail "id="collapse-<?php echo $row['id_bill']; ?>">
                        	<td colspan="8">
                        		<ul class="nav nav-tabs" id="myTab" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chi tiết</a>
								  </li>
								</ul>
								<div class="tab-content" id="myTabContent">
								  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								  	<div class="row">
	                        			<div class="col-md-4">
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Mã hóa đơn
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['id_bill']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Phòng/Bàn
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['tablename']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Thời gian
	                        					</label>
	                        					<div class="col-md-8">
	                        						<input type="text" name="" disabled="disabled" class="form-control" value="<?php echo $row['time']; ?>">
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<div class="col-md-4">
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Nhân Viên
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['nameuser']; ?></strong>
	                        					</div>
	                        				</div>
	                        				<div class="row form-group">
	                        					<label class="col-md-4">
	                        						Khách hàng
	                        					</label>
	                        					<div class="col-md-8">
	                        						<strong><?php echo $row['namecus']; ?></strong>
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<div class="col-md-4">
	                        				<textarea rows="4" class="form-control"><?php echo $row['note'];?></textarea>
	                        			</div>
                        			</div>
								  	<table class="table table-striped table-bordered">
							            <thead class="table-success">
							                <tr>
							                  <th>Mã Sản phẩm</th>
							                  <th>Tên sản phẩm</th>
							                  <th>Số lượng</th>
							                  <th>ĐVT</th>
							                  <th>Gía bán</th>
							                  <th>Thành tiền</th>
							                </tr>
							            </thead>
							            <tbody>
							            	{{-- <?php 
			                        		$seletdetail = "SELECT * FROM billdetail INNER JOIN menus ON billdetail.IdMenu = menus.IdMenu WHERE IdBill ='".$row['IdBill']."'";
			                        		$resultdetail = mysqli_query($conn,$seletdetail);
			                        		while ($rowdetail = mysqli_fetch_array($resultdetail)) { ?> --}}
			                        		@foreach($row['detail'] as $rowdetail)
			                        			<tr>
			                        				<td><?php echo $rowdetail['idmenu']; ?></td>
			                        				<td><?php echo $rowdetail['namemenu']; ?></td>
			                        				<td><?php echo $rowdetail['quantity']; ?></td>
			                        				<td><?php echo $rowdetail['unit']; ?></td>
			                        				<td><?php echo number_format($rowdetail['price'],0); ?></td>
			                        				<td><?php echo number_format($rowdetail['price']*$rowdetail['quantity'],0); ?></td>
			                        			</tr>	
			                        		@endforeach
							            </tbody>
							        </table>
								</div>
								</div>
	                       	</td>
	                    </tr>
	                    @endforeach
                    {{-- <?php }
                }else{
                    echo '<td colspan="6" class="text-center">Chưa có thực đơn nào</td>';
                }
            ?> --}}
            </tbody>
        </table>
	</div>
</div>
@endsection