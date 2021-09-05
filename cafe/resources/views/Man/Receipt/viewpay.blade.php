@foreach($pay as $row)
<tr>
	<td>{{$row->IdPayslip}}</td>
	<td>{{$row->UserId}}</td>
	<td>{{number_format($row->Totalprice,0)}}đ</td>
	<td>{{$row->Note}}</td>
	<td>
		<a href="">{{$row->Format}}</a>
	</td>
	<td>{{$row->created_at}}
	</td>
	@endforeach