
	<tr data-id="{{$data->IdProduct}}">
		<td>{{$data->IdProduct}}</td>
		<td>{{$data->NameProduct}}</td>
		<td>
			<div class="input-group spinner">
				<span class="input-group-btn" ><button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[{{$data->IdProduct}}]" > <span class="fa fas fa-minus"></span></button></span>

				<input name="quant[{{$data->IdProduct}}]" class="form-control input-number quantity-product-oders" value="1"  type="text">

				<span class="input-group-btn"><button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[{{$data->IdProduct}}]" > <span class="fa fas fa-plus"></span></button></span> 
			</div>
		</td>
		<td><input type="text" class="form-control price-order" disabled="disabled" name="" value="{{$data->CostPrice}}"></td>
		<td class="text-center total-money">{{number_format($data->CostPrice,0)}}</td>
		<td class="text-center">
			<i class="fa fa-times-circle del-pro-order"></i>
		</td>
	</tr>


