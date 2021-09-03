
@if($data)
<ul class="list-group">
	@foreach($data as $rows)
	<li class="list-group-item list-group-item-action data-cus-{{$rows->IdCustomer}}" onclick="cms_select_customer('{{$rows->IdCustomer}}')">{{$rows->CustomerName}}</li>
	@endforeach
</ul>
@endif

@if(!$data)
<li>Không tìm thấy kết quả</li>
@endif()
