<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered text-center" id="tbl-shopping-cart">
                <thead>
                <tr>
                    <th class="table-header">Product Name</th>
                    <th class="table-header">Product Price</th>
                    <th class="table-header">Available</th>
                    <th class="table-header">Category</th>
                    <th class="table-header">Cost</th>
                    <th class="table-header">Quantity</th>
                    <th class="table-header">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data) && count($data))
                    <?php $total = 0 ?>
                    @foreach($data as $product)
                        <tr id="pro-{{ $product->id }}">
                            <td>{{ $product->product_name }}</td>
                            <td id="price-{{ $product->id }}">{{ $product->product_price }} $</td>
                            <td id="available-{{ $product->id  }}">{{ $product->product_quantity }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td id="cost-{{ $product->id }}" class="price-shopping-cart">{{ $product->product_price }} $</td>
                            <td><input type="number" min="1" max="10" value="1"
                                       onchange="calculatePrice('{{ $product->id }}', this.value)"
                                       id="product-{{ $product->id }}"></td>
                            <td>
                                <a onclick="removeProFromCart('{{ $product->id }}', '{{ $product->id }}')" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                        <?php $total += $product->product_price ?>
                    @endforeach
                    <tr>
                        <td>Total Amount: </td>
                        <td id="total-amount">{{ $total }} $</td>
                        <td id="checkout">
                            <a href="{{ route('checkout') }}" onclick="checkout(event, this.href)" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function calculatePrice(id, value)
    {
        var available = $('#available-' + id);
        var cost = $('#cost-' + id);
        var product = $('#pro-' + id);
        var productPrice = $('#price-' + id);
        var totalAmount = $('#total-amount');
        var len = $('#tbl-shopping-cart tr').length - 2;

        var intAvailable = parseInt(available.html());

        cost.html(value * parseInt(productPrice.html()) + ' $');

        var total = 0;
        $('#tbl-shopping-cart tr').each(function() {
            if (typeof $(this).find(".price-shopping-cart").html() !== 'undefined') {
                total += parseInt($(this).find(".price-shopping-cart").html());
            }
        });

        flash(totalAmount, '#cefdb1', 250);
        flash(cost, '#cefdb1', 250);

        if (intAvailable < value) {
            product.css('background-color', '#8e0909');
            $('#product-' + id).css('color', 'black');
            product.css('color', 'white');
        } else {
            product.css('background-color', 'white');
            product.css('color', 'black');
        }

        totalAmount.html(total + ' $');
    }

    function flash(element, flashColor, timer)
    {
        element.css("background", flashColor);

        setTimeout(function(){
            element.css("background-color", 'white');
        }, timer);
    }

    function removeProFromCart(id, productId)
    {
        var row = $('#pro-' + id);
        row.remove();
        var itemCount = $('#items-count');
        var available = $('#available-' + id);
        var cost = $('#cost-' + id);
        var product = $('#pro-' + id);
        var productPrice = $('#price-' + id);
        var totalAmount = $('#total-amount');
        var len = $('#tbl-shopping-cart tr').length - 2;

        var intAvailable = parseInt(available.html());

        var total = 0;
        $('#tbl-shopping-cart tr').each(function() {
            if (typeof $(this).find(".price-shopping-cart").html() !== 'undefined') {
                total += parseInt($(this).find(".price-shopping-cart").html());
            }
        });

        totalAmount.html(total + ' $');
        console.log(id);
        var url = '{{ url('/client/remove-from-cart/') }}' + '/' + productId;
        $.ajax({
            type: 'get',
            url: url,
            success: function(data) {
                if (data === 0) {
                    itemCount.html('');
                } else {
                    itemCount.html(data);
                }
            }
        });
    }

    function checkout(event, url)
    {
        event.preventDefault();
        var page = $('#client-content');
        var inputs, index; var data = {};
        inputs = document.getElementsByTagName('input');
        for (index = 0; index < inputs.length; ++index) {
            data[inputs[index].id] = inputs[index].value;
        }

        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            type: 'post',
            url: url,
            data: data,
            success: function () {
                $('#items-count').html('');
                page.html('<h1>Loading....</h1>');
                $.ajax({
                    url: '{{ route('all_orders') }}',
                    type: 'get',
                    success: function (data) {
                        page.html(data);
                    }
                });
            }
        });
    }
</script>