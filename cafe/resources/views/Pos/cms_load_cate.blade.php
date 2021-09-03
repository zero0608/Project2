<ul>
	@foreach($data as $rowmenu)
	<li>
		<a href="#" onclick="cms_select_menu('{{$rowmenu->IdMenu}}')" title="{{$rowmenu->NameMenu}}">
			<div class="img-product">
				<img src="{{asset('storage')}}/assets/images/{{$rowmenu->Images}}">
			</div>
			<div class="product-info">
				<span class="product-name">{{$rowmenu->NameMenu}}</span><br>
				<strong>{{number_format($rowmenu->Price,3)}}</strong>
			</div>
		</a>
	</li>
	@endforeach
</ul>