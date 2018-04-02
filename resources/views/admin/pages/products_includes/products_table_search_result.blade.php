
<tr>
    <td>{{ $allProductsFromSearch->id }}</td>
    <td>
        <img src="{{ getProductPhotoSearch($allProductsFromSearch) }}"
             alt="{{ $allProductsFromSearch->product_name }}" width="100" height="80">
    </td>
    <td>{{ $allProductsFromSearch->product_name }}</td>
    <td>{{ $allProductsFromSearch->product_price }} $</td>
    <td>{{ $allProductsFromSearch->product_quantity }}</td>
    <td>
        <a href="#" class="btn btn-default" onclick="getProductModel(event, '{{ $allProductsFromSearch->id }}', 'show')"
           data-toggle="modal" data-target="#myModal">Show</a>

        <a href="#" class="btn btn-primary" onclick="getProductModel(event, '{{ $allProductsFromSearch->id }}', 'edit')"
           data-toggle="modal" data-target="#myModal">Edit</a>

        <a href="{{ route('product_remove', $allProductsFromSearch->id) }}" class="btn btn-danger"
           onclick="removeProduct(event, this.href)">
            Remove
        </a>

        <a href="{{ route('product_publish', $allProductsFromSearch->id) }}"
           class="btn {{ $allProductsFromSearch->product_admin_verify === 1 ? 'btn-success' : 'btn-danger'}}"
           onclick="productPublish(event, this.href)">
            {{ getNameOfAdminVerify($allProductsFromSearch->product_admin_verify) }}
        </a>
    </td>
</tr>
