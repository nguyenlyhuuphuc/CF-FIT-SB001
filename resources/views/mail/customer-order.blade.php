<div>Xin chao </div>
<table border="1">
    <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
    </tr>
    @foreach ($order->orderItems as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty * $item->price }}</td>
        </tr>
    @endforeach
    <tr>
        <td>Total</td>
        <td colspan="3">{{ $order->total }}</td>
    </tr>
</table>
