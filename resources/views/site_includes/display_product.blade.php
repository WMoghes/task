<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @if (isset($data))
                <div class="col-sm-4">
                    <img src="{{ getProductPhotoSearch($productPhoto) }}" width="300" height="300" alt="{{ $data->product_name }}">
                </div>

                <div class="col-sm-8">
                    @if (Auth::check() && ! checkItemExist($data->id, 'cart_' . Auth::user()->id)
                    && Auth::user()->permission_id === 2 && $data->product_quantity > 0)
                        <a href="{{ route('add_to_cart', cryptText($data->id)) }}" onclick="addToCart(event, this.href)"
                           class="btn btn-primary" id="add-to-cart">Add To Cart</a>
                    @endif

                    <h3>Product Name: </h3>{{ $data->product_name }}
                    <h3>Product Price: </h3>{{ $data->product_price }} $
                    <h3>Product Quantity: </h3>{{ $data->product_quantity }}
                    <h3>Product Description: </h3>{{ $data->product_description }}
                    <h3>Product Details: </h3>{{ $data->product_details }}
                    <h3>Product Category: </h3>{{ $data->category->category_name }}
                </div>

            @endif
        </div>
        <a href="{{ route('homepage', 1) }}" class="btn btn-primary" onclick="goBack(event, this.href)">Back</a>
    </div>
</div>

<script>
    function addToCart(event, url)
    {
        event.preventDefault();
        var itemCount = $('#items-count');
        $('#add-to-cart').remove();
        $.ajax({
            url: url,
            type: 'get',
            success: function (data) {
                itemCount.html(data);
            },
            error: function () {

            }
        });
    }
</script>