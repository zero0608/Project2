@foreach($re as $row)
<tr>
	<td>{{$row->IdReceipt}}</td>
	<td>{{$row->UserId}}</td>
	<td>{{number_format($row->Totalprice,0)}}đ</td>
	<td>{{$row->Note}}</td>
	<td>
		<a href="">{{$row->Format}}</a>
	</td>
	<td>{{$row->created_at}}
	</td>
	@endforeach