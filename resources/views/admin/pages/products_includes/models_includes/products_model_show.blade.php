@if (isset($data))
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><b>Product ID:</b></td>
            <td>{{ $data->id }}</td>
        </tr>
        <tr>
            <td><b>Product Name:</b></td>
            <td>{{ $data->product_name }}</td>
        </tr>
        <tr>
            <td><b>Product Cover:</b></td>
            <td><img src="{{ getProductPhotoSearch($data) }}" alt="{{ $data->product_name }}" width="300" height="300"></td>
        </tr>
        <tr>
            <td><b>Product Price:</b></td>
            <td>{{ $data->product_price }} $</td>
        </tr>
        <tr>
            <td><b>Product Description:</b></td>
            <td>{{ $data->product_description }}</td>
        </tr>
        <tr>
            <td><b>Product Details:</b></td>
            <td>{{ $data->product_details }}</td>
        </tr>
        <tr>
            <td><b>Product Quantity:</b></td>
            <td>{{ $data->product_quantity }}</td>
        </tr>
        <tr>
            <td><b>Admin Verify:</b></td>
            <td class="{{ $data->product_admin_verify === 0 ? 'suspended' : 'active-status' }}">
                {{ getNameOfAdminVerify($data->product_admin_verify) }}
            </td>
        </tr>
        <tr>
            <td><b>Category Name:</b></td>
            <td>{{ $data->category->category_name }}</td>
        </tr>
        </tbody>
    </table>
@endif

<div class="row">
    <button type="button" class="btn btn-default col-sm-offset-4 col-sm-4" data-dismiss="modal">Close</button>
</div>
