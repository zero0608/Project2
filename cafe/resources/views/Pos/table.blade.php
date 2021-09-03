<div class="col-md table-list-content">
	<ul>
		@foreach($data as $rowtable)
		<li @if($rowtable->Status==1)
	class="tb-active"@endif id="{{$rowtable->IdTable}}" onclick="cms_load_pos({{$rowtable->IdTable}})">{{$rowtable->TableName}}
		</li>
		@endforeach
	</ul>
</div>
