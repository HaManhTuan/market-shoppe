<h2>Chào: {{ $customer->name }} </h2>
	<p>Đây là thông tin đơn hàng của bạn</p>
	<table border="1" cellpadding="5" cellspacing="0" width="500px">
		<thead>
			<tr>

				<th>Mã sản phẩm</th>
				<th>Tên sản phẩm</th>
			    <th>Số lượng</th>
			     <th>Giá</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orderDetail as $value)
			<tr>
				<td> {{$value->product_name}} </td>
				<td> {{$value->quantity}} </td>
				<td> {{number_format($value->price)}} </td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<p> Sản phẩm đang được xử lý. Cảm ơn bạn đã mua hàng ở Kute Shop</p>
