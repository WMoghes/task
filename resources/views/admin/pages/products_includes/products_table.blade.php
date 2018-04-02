@foreach($allProducts as $allProduct)
    <tr>
        <td>{{ $allProduct->id }}</td>
        <td>
            <img src="{{ getProductPhotoSearch($allProduct) }}"
                 alt="{{ $allProduct->product_name }}" width="100" height="80">
        </td>
        <td>{{ $allProduct->product_name }}</td>
        <td>{{ $allProduct->product_price }} $</td>
        <td>{{ $allProduct->product_quantity }}</td>
        <td>
            <a href="#" class="btn btn-default" onclick="getProductModel(event, '{{ $allProduct->id }}', 'show')"
               data-toggle="modal" data-target="#myModal">Show</a>

            <a href="#" class="btn btn-primary" onclick="getProductModel(event, '{{ $allProduct->id }}', 'edit')"
               data-toggle="modal" data-target="#myModal">Edit</a>

            <a href="{{ route('product_remove', $allProduct->id) }}" class="btn btn-danger"
               onclick="removeProduct(event, this.href)">
                Remove
            </a>

            <a href="{{ route('product_publish', $allProduct->id) }}"
               class="btn {{ $allProduct->product_admin_verify === 0 ? 'btn-success' : 'btn-danger'}}"
               onclick="productPublish(event, this.href)">
                {{ getNameOfAdminVerify($allProduct->product_admin_verify == 1 ? 0 : 1) }}
            </a>
        </td>
    </tr>
@endforeach