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