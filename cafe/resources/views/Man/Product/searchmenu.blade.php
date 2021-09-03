
		@if($data)
		<ul class="list-group">
			@foreach ($data as $rows)
    			<li class="list-group-item list-group-item-action data-menu-{{$rows->IdProduct}}" onclick="cms_select_menu('{{$rows->IdProduct}}')">
					<img src="{{asset('storage')}}/assets/images/{{$rows->Images}}" width="50px">
					{{$rows->NameProduct}}
				</li>
			@endforeach
		</ul>
		@endif
		@if(!$data)
			<li>Không tìm thấy kết quả</li>
		@endif()