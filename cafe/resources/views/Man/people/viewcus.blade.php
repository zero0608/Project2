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