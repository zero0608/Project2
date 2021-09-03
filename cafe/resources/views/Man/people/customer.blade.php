@extends('Man.index')
@section('content')
<div class="row customer-act act">
    <div class="col-md-5">
        <h2>Khách hàng</h2>
    </div>
    <div class="col-md-7 text-right action">
        <button class="btn btn-success" data-toggle="modal" data-target="#AddCustomerModal"><i class="fa fa-plus" aria-hidden="true"></i> Tạo KH</button>
    </div>
</div>
<div class="row supplier-act act" style="display:none;">
    <div class="col-md-5">
        <h2>Nhà cung cấp</h2>
    </div>
    <div class="col-md-7 text-right action">
      <button class="btn btn-success" data-toggle="modal" data-target="#AddSupplierModal"><i class="fa fa-plus" aria-hidden="true"></i> Tạo NCC</button>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" onclick="tab_click_act('customer')">
                <a class="nav-link active" data-toggle="tab" href="#cus" role="tab" aria-selected="true"><i class="fa fa-users" aria-hidden="true"></i> Khách hàng</a>
            </li>
            <li class="nav-item" onclick="tab_click_act('supplier')">
                <a class="nav-link" data-toggle="tab" href="#sup" role="tab" aria-selected="false"><i class="fa fa-truck" aria-hidden="true"></i> Nhà cung cấp</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="cus" role="tabpanel">
                <div class="row filter-search">
                    <div class="col-md-5 form-group">
                        <input type="text" name="txtcustomer" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Nhập mã khách hàng">
                    </div>
                   {{--  <div class="col-md-3 form-group">
                        <select class="form-control">
                            <option>Tất cả</option>
                            <option>Còn nợ</option>
                       </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead class="table-primary">
                                <tr>
                                  <th>Mã KH</th>
                                  <th>Tên Khách Hàng</th>
                                  <th>Điện thoại</th>
                                  <th>Email</th>
                                  <th>Địa chỉ</th>
                                  {{-- <th>Tổng tiền hàng</th> --}}
                                  {{-- <th>Nợ</th> --}}
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody id="load_pagination_cus">
                            @foreach($cus as $row)
                            <tr>
                                <td> {{$row->IdCustomer}}</td>
                                <td> {{$row->CustomerName}}</td>
                                <td> {{$row->PhoneNumber}}</td>
                                <td> {{$row->Email}}</td>
                                <td> {{$row->Address}}</td>
                                <td>
                                    <button class="btn btn-danger fa fa-trash" onclick="cms_delete_customer('{{$row->IdCustomer}}')"></button>

                                    <button class="btn btn-success fa fa-pencil-square-o" data-toggle="modal" data-target="#ModelEditTable-{{$row->IdCustomer}}"></button>


                                    <div class="modal fade" id="ModelEditTable-{{$row->IdCustomer}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa khách hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row form-group">
                                                        <div class="col-md-4">
                                                            <b>Mã khách hàng</b>
                                                        </div>
                                                        <div class="col-md-8">
                                                          <input type="text" name="txtcodecus-{{$row->IdCustomer}}" placeholder="Mã mặc định" class="form-control" readonly value="{{$row->IdCustomer}}">
                                                      </div>
                                                  </div>
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                        <b>Tên khách hàng</b>
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" name="txtnamecus-{{$row->IdCustomer}}" class="form-control" value="{{$row->CustomerName}}">
                                                  </div>
                                              </div>
                                              <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Số điện thoại</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtphonecus-{{$row->IdCustomer}}" class="form-control" value="{{$row->PhoneNumber}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Email</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtemailcus-{{$row->IdCustomer}}" class="form-control" value="{{$row->Email}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Địa chỉ</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtaddrescus-{{$row->IdCustomer}}" class="form-control" value="{{$row->Address}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="cms_update_customer('{{$row->IdCustomer}}')" class="btn btn-primary">Lưu</button>
                                            </div>
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
                        $totalpage = ceil($countcus/$limit);
                        @endphp
                        @for($i=1; $i <=$totalpage ; $i++)
                        <li class="page-item"><a class="page-link" onclick="cms_pagination_cus({{$i}})" href="#">{{$i}}</a></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="sup" role="tabpanel">
            <div class="row filter-search">
                <div class="col-md-5 form-group">
                    <input type="text" name="txtcustomer" class="form-control" id="Input" onkeyup="myfunction()" placeholder="Nhập Mã nhà cung cấp">
                </div>
                   {{--  <div class="col-md-3 form-group">
                        <select class="form-control">
                            <option>Tất cả</option>
                            <option>Đã từng nhập</option>
                            <option>Còn nợ NCC</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</button>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="Table">
                            <thead class="table-primary">
                                <tr>
                                    <th>Mã NCC</th>
                                    <th>Tên Tên NCC</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="load_pagination_sup">
                                @foreach($sup as $row1)
                                <tr>
                                    <td> {{$row1->IdSupplier}}</td>
                                    <td> {{$row1->Namesupplier}}</td>
                                    <td> {{$row1->Phone}}</td>
                                    <td> {{$row1->Email}}</td>
                                    <td> {{$row1->Address}}</td>
                                    <td>
                                       <button class="btn btn-danger fa fa-trash" onclick="cms_delete_supplier('{{$row1->IdSupplier}}')"></button>

                                       <button class="btn btn-success fa fa-pencil-square-o" data-toggle="modal" data-target="#ModelEditSup-{{$row1->IdSupplier}}"></button>

                                       <div class="modal fade" id="ModelEditSup-{{$row1->IdSupplier}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa nhà cung cấp </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row form-group">
                                                        <div class="col-md-4">
                                                            <b>Mã khách hàng</b>
                                                        </div>
                                                        <div class="col-md-8">
                                                          <input type="text" name="txtcodesup-{{$row1->IdSupplier}}" placeholder="Mã mặc định" class="form-control" value="{{$row1->IdSupplier}}" readonly>
                                                      </div>
                                                  </div>
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                        <b>Tên khách hàng</b>
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" name="txtnamesup-{{$row1->IdSupplier}}" class="form-control" value="{{$row1->Namesupplier}}">
                                                  </div>
                                              </div>
                                              <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Số điện thoại</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtphonesup-{{$row1->IdSupplier}}" class="form-control" value="{{$row1->Phone}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Email</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtemailsup-{{$row1->IdSupplier}}" class="form-control" value="{{$row1->Email}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <b>Địa chỉ</b>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="txtaddressup-{{$row1->IdSupplier}}" class="form-control" value="{{$row1->Address}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="cms_update_supplier('{{$row1->IdSupplier}}')" class="btn btn-primary">Lưu</button>
                                            </div>
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
                        $totalpage = ceil($countsup/$limit);
                        @endphp
                        @for($i=1; $i <=$totalpage ; $i++)
                        <li class="page-item"><a class="page-link" onclick="cms_pagination_sup({{$i}})" href="#">{{$i}}</a></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="AddCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <b>Mã khách hàng</b>
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="txtcodecus" placeholder="Mã mặc định" class="form-control">
                  </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4">
                    <b>Tên khách hàng</b>
                </div>
                <div class="col-md-8">
                  <input type="text" name="txtnamecus" class="form-control">
              </div>
          </div>
          <div class="row form-group">
            <div class="col-md-4">
                <b>Số điện thoại</b>
            </div>
            <div class="col-md-8">
                <input type="text" name="txtphonecus" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <b>Email</b>
            </div>
            <div class="col-md-8">
                <input type="text" name="txtemailcus" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <b>Địa chỉ</b>
            </div>
            <div class="col-md-8">
                <input type="text" name="txtaddrescus" class="form-control">
            </div>
        </div>
               {{--  <div class="row form-group">
                    <div class="col-md-4">
                        <b>Ghi chú</b>
                    </div>
                    <div class="col-md-8">
                        <textarea name="txtnotecus" class="form-control" placeholder="Chi chú" rows="3"></textarea>
                    </div>
                </div> --}}
               {{--  <div class="row form-group">
                    <div class="col-md-12 text-center">
                        <div class="jumbotron">
                            <h3>Upload hình ảnh nhà cung cấp</h3>
                            <p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">  
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="cms_add_customer()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
                <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AddSupplierModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm nhà cung cấp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row form-group">
                <div class="col-md-4">
                    <b>Mã nhà cung cấp</b>
                </div>
                <div class="col-md-8">
                  <input type="text" name="txtcodesup" placeholder="Mã (ví dụ:NCC001)" class="form-control">
              </div>
          </div>
          <div class="row form-group">
            <div class="col-md-4">
                <b>Tên nhà cung cấp</b>
            </div>
            <div class="col-md-8">
              <input type="text" name="txtnamesup" placeholder="Nhập tên nhà cung cấp" class="form-control">
          </div>
      </div>
      <div class="row form-group">
        <div class="col-md-4">
            <b>Số điện thoại</b>
        </div>
        <div class="col-md-8">
            <input type="text" name="txtphonesup" placeholder="Số điện thoại" class="form-control">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-4">
            <b>Email</b>
        </div>
        <div class="col-md-8">
            <input type="text" name="txtemailsup" placeholder="Email ( ví dụ : huynhhuynh02@gmail.com)" class="form-control">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-4">
            <b>Địa chỉ</b>
        </div>
        <div class="col-md-8">
            <input type="text" name="txtaddresssup" placeholder="Địa chỉ cơ sở nhà cung cấp" class="form-control">
        </div>
    </div>
                {{-- <div class="row form-group">
                    <div class="col-md-4">
                        <b>Ghi chú</b>
                    </div>
                    <div class="col-md-8">
                        <textarea name="txtnotesup" class="form-control" placeholder="Chi chú" rows="3"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">
                        <b>Nợ</b>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="txtdebtsup" placeholder="Nợ nhà cung cấp" class="form-control">
                    </div>
                </div> --}}
                {{-- <div class="row form-group">
                    <div class="col-md-12 text-center">
                        <div class="jumbotron">
                            <h3>Upload hình ảnh nhà cung cấp</h3>
                            <p>(Để tải và hiện thị nhanh, mỗi ảnh lên có dung lượng tối đa 5MB.)</p>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">	
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="cms_add_supplier()"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Lưu</button>
                <button type="button" class="btn" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
    function cms_pagination_cus($current_page){
        $param = {
            type:'GET',
            url:'{{route('admin.pagination_cus')}}',
            data:{
                current_page:$current_page,
            },
            dataType:'html',
            callback:function(result){
                $('#load_pagination_cus').html(result);
            }
        }
        ajax_adapter($param);
    }


    function cms_pagination_sup($current_page){
        $param = {
            type:'GET',
            url:'{{route('admin.pagination_sup')}}',
            data:{
                current_page:$current_page,
            },
            dataType:'html',
            callback:function(result){
                $('#load_pagination_sup').html(result);
            }
        }
        ajax_adapter($param);
    } 


    function myfunction() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("Input");
      filter = input.value.toUpperCase();
      table = document.getElementById("Table");
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


function cms_add_customer(){
    var check=1;
    var codecus = $('input[name="txtcodecus"]').val();
    var namecus = $('input[name="txtnamecus"]').val();
    var phonecus = $('input[name="txtphonecus"]').val();
    var emailcus = $('input[name="txtemailcus"]').val();
    var addresscus = $('input[name="txtaddrescus"]').val();
    // var notecus = $('textarea[name=txtnotecus]').val();
    if(namecus==''){
        $('.alert-login').html('<h3>Thông báo !</h3><p>Tên khách hàng không được để trống</p>').fadeIn().delay(1000).fadeOut('slow');
    }else{
        $param = {
            type:'POST',
            url:'{{route('peo.store')}}',
            data:{
                check:check,
                code:codecus,
                name:namecus,
                phone:phonecus,
                email:emailcus,
                address:addresscus,
            },
            dataType:'html',
            callback:function(result){
                if(result=='1'){ 
                    cms_pagination_cus(1);
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    $('#AddCustomerModal').model('hide');

                }
                else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Lỗi</p>').fadeIn().delay(1000).fadeOut('slow');
                }
            }
        }
        ajax_adapter($param);
    }
}

function cms_add_supplier(){
    var check=0;
    var codecus = $('input[name="txtcodesup"]').val();
    var namecus = $('input[name="txtnamesup"]').val();
    var phonecus = $('input[name="txtphonesup"]').val();
    var emailcus = $('input[name="txtemailsup"]').val();
    var addresscus = $('input[name="txtaddressup"]').val();
    // var notecus = $('textarea[name=txtnotecus]').val();
    if(namecus==''){
        $('.alert-login').html('<h3>Thông báo !</h3><p>Tên nhà cung cấp không được để trống</p>').fadeIn().delay(1000).fadeOut('slow');
    }else{
        $param = {
            type:'POST',
            url:'{{route('peo.store')}}',
            data:{
                check:check,
                code:codecus,
                name:namecus,
                phone:phonecus,
                email:emailcus,
                address:addresscus,
            },
            dataType:'html',
            callback:function(result){
                if(result=='1'){

                    $('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    $('#AddSupplierModal').model('hide');
                    cms_pagination_sup(1);
                    
                }
                else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Lỗi</p>').fadeIn().delay(1000).fadeOut('slow');
                }


            }
        }
        ajax_adapter($param);
    }
}


function cms_update_customer(id){
    var check=1;
    var namecus = $('input[name="txtnamecus-'+id+'"]').val();
    var phonecus = $('input[name="txtphonecus-'+id+'"]').val();
    var emailcus = $('input[name="txtemailcus-'+id+'"]').val();
    var addresscus = $('input[name="txtaddrescus-'+id+'"]').val();
    // var notecus = $('textarea[name=txtnotecus]').val();
    if(namecus==''){
        $('.alert-login').html('<h3>Thông báo !</h3><p>Tên khách hàng không được để trống</p>').fadeIn().delay(1000).fadeOut('slow');
    }else{
        $param = {
            type:'PUT',
            url:'http://127.0.0.1:8000/peo/'+id,
            data:{
                check:check,
                name:namecus,
                phone:phonecus,
                email:emailcus,
                address:addresscus,
            },
            dataType:'html',
            callback:function(result){
                if(result=='1'){ 
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Sửa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    $('#AddCustomerModal').model('hide');
                    cms_pagination_cus(1);
                }
                else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Lỗi</p>').fadeIn().delay(1000).fadeOut('slow');
                }
            }
        }
        ajax_adapter($param);
    }
}



function cms_update_supplier(id){
    var check=0;
    var namecus = $('input[name="txtnamesup-'+id+'"]').val();
    var phonecus = $('input[name="txtphonesup-'+id+'"]').val();
    var emailcus = $('input[name="txtemailsup-'+id+'"]').val();
    var addresscus = $('input[name="txtaddresssup-'+id+'"]').val();
    // var notecus = $('textarea[name=txtnotecus]').val();
    if(namecus==''){
        $('.alert-login').html('<h3>Thông báo !</h3><p>Tên nhà cung cấp không được để trống</p>').fadeIn().delay(1000).fadeOut('slow');
    }else{
        $param = {
            type:'PUT',
            url:'http://127.0.0.1:8000/peo/'+id,
            data:{
                check:check,
                name:namecus,
                phone:phonecus,
                email:emailcus,
                address:addresscus,
            },
            dataType:'html',
            callback:function(result){
                if(result=='1'){
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Sửa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    $('#AddSupplierModal').model('hide');
                    cms_pagination_sup(1);
                    
                }
                else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Lỗi</p>').fadeIn().delay(1000).fadeOut('slow');
                }


            }
        }
        ajax_adapter($param);
    }
}

function cms_delete_customer(id){
    var check=0;
    $param = {
            type:'GET',
            url:'{{route('admin.peo1')}}',
            data:{
                id:id,
            },
            dataType:'html',
            callback:function(result){
                if(result=='0'){
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Đã xóa </p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    cms_pagination_cus(1);
                }else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Không thể xóa </p>').fadeIn().delay(1000).fadeOut('slow');
                }
            }
        }
    ajax_adapter($param);
}


function cms_delete_supplier(id){
    var check =1;
     $param = {
            type:'DELETE',
            url:'http://127.0.0.1:8000/peo/'+id,
            data:{
                check:check,
            },
            dataType:'html',
            callback:function(result){
                if(result=='0'){
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Đã xóa </p>').fadeIn().delay(1000).fadeOut('slow').css('background','#37822A');
                    cms_pagination_sup(1);
                }else{
                    $('.alert-login').html('<h3>Thông báo !</h3><p>Không thể xóa </p>').fadeIn().delay(1000).fadeOut('slow');
                }
            }
        }
    ajax_adapter($param);

}
</script>
@endsection