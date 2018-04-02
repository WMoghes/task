<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>Order No.</th>
                    <th class="table-header">Order Address</th>
                    <th class="table-header">Order Amount</th>
                    <th class="table-header">Order Status</th>
                    <th class="table-header">Ordered At</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data) && count($data))
                    @foreach($data as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_address }}</td>
                            <td>{{ $order->order_total_amount }} $</td>
                            <td>{{ getNameOfOrderStatus($order->order_status) }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>