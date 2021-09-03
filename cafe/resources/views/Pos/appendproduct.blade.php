{{-- {{$data-> --}}
	<tr data-id="{{$data->IdMenu}}">
		<td>{{$data->IdMenu}}</td>
		<td>{{$data->NameMenu}}</td>
		<td>
			<div class="input-group spinner">
				<span class="input-group-btn" ><button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[{{$data->IdMenu}}]" > <span class="fa fas fa-minus"></span></button></span>

				<input name="quant[{{$data->IdMenu}}]" class="form-control input-number quantity-product-oders" value="1"  type="text">

				<span class="input-group-btn"><button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[{{$data->IdMenu}}]" > <span class="fa fas fa-plus"></span></button></span> 
			</div>
		</td>
		<td><input type="text" class="form-control price-order" disabled="disabled" name="" value="{{$data->Price}}"></td>
		<td class="text-center total-money">{{number_format($data->Price,0)}}<</td>
		<td class="text-center">
			<i class="fa fa-times-circle del-pro-order"></i>
		</td>
	</tr>



