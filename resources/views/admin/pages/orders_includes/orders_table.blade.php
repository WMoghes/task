@foreach($allOrders as $allOrder)
    <tr>
        <td>{{ $allOrder->id }}</td>
        <td>{{ $allOrder->user->username }}</td>
        <td>{{ $allOrder->order_total_amount }} $</td>
        <td>{{ getNameOfOrderStatus($allOrder->order_status) }}</td>
        <td>
            <div class="col-sm-6">
                <select id="order-status-{{ $allOrder->id }}" onchange="orderStatus('{{ $allOrder->id }}')" class="form-control">
                    <option selected disabled>Change Order Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Accepted</option>
                    <option value="2">Refused</option>
                    <option value="3">Shipped</option>
                </select>
            </div>

            <a href="#" class="btn btn-default" onclick="getOrderModel(event, '{{ $allOrder->id }}', 'show')"
               data-toggle="modal" data-target="#myModal">Show</a>
        </td>
    </tr>
@endforeach