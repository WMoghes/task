
<tr>
    <td>{{ $allOrdersFromSearch->id }}</td>
    <td>{{ $allOrdersFromSearch->user->username }}</td>
    <td>{{ $allOrdersFromSearch->order_total_amount }} $</td>
    <td>{{ getNameOfOrderStatus($allOrdersFromSearch->order_status) }}</td>
    <td>
        <div class="col-sm-6">
            <select id="order-status-{{ $allOrdersFromSearch->id }}" onchange="orderStatus('{{ $allOrdersFromSearch->id }}')" class="form-control">
                <option selected disabled>Change Order Status</option>
                <option value="0">Pending</option>
                <option value="1">Accepted</option>
                <option value="2">Refused</option>
                <option value="3">Shipped</option>
            </select>
        </div>

        <a href="#" class="btn btn-default" onclick="getOrderModel(event, '{{ $allOrdersFromSearch->id }}', 'show')"
           data-toggle="modal" data-target="#myModal">Show</a>
    </td>
</tr>
