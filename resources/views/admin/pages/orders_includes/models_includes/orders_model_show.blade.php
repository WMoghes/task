@if (isset($data))
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><b>Order ID:</b></td>
            <td>{{ $data->id }}</td>
        </tr>
        <tr>
            <td><b>Client Name:</b></td>
            <td>{{ $data->user->username }}</td>
        </tr>
        <tr>
            <td><b>Order Amount:</b></td>
            <td>{{ $data->order_total_amount }} $</td>
        </tr>
        <tr>
            <td><b>Order Status:</b></td>
            <td>{{ getNameOfOrderStatus($data->order_status) }}</td>
        </tr>
        <tr>
            <td><b>Order Details:</b></td>
            <td>
                @if (count($data->details))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Product Name:</th>
                            <th>Quantity</th>
                            <th>Product Price</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($data->details as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name }}</td>
                            <td>{{ $detail->product_quantity }}</td>
                            <td>{{ $detail->product->product_price }} $</td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
@endif

<div class="row">
    <button type="button" class="btn btn-default col-sm-offset-4 col-sm-4" data-dismiss="modal">Close</button>
</div>
