<script>
    var status = $('#products-status');
    var productModel = $('#product-model');

    $(document).on('click', '.products-pagination a', function(e) {
        e.preventDefault();
        var lastPage = $('#last-page').attr('data-last');
        var currentPage = $('#current-page');
        var nextPage = $('#next-page');
        var previousPage = $('#previous-page');
        var getCurrentPage = parseInt(currentPage.html());

        if (this.id === 'first-page') {
            getData(this.href, '#products-table', '1', '#products-status');
        } else if (this.id === 'last-page') {
            getData(this.href, '#products-table', lastPage, '#products-status');
        } else if (this.id === 'next-page' && getCurrentPage < lastPage && getCurrentPage >= 1) {
            getData(this.href + ++getCurrentPage, '#products-table', getCurrentPage, '#products-status');
        } else if (this.id === 'previous-page' && getCurrentPage <= lastPage && getCurrentPage >= 2) {
            getData(this.href + --getCurrentPage, '#products-table', getCurrentPage, '#products-status');
        }
    });

    function getProductModel(event, productId, modelType)
    {
        event.preventDefault();
        var productModel = $('#product-model');
        var url = '{{ url('admin/product') }}' + '/' + productId + '/' + modelType;
        var requestType = 'get';

        productModel.html("<h1>Loading.....</h1>");

        productAjaxModel(url, requestType, productModel);
    }

    function productAjaxModel(url, requestType, productModel)
    {
        var productModel = $('#product-model');
        $.ajax({
            url: url,
            type: requestType,
            success: function(data) {
                productModel.html(data);
            },
            error: function() {
                productModel.html("<h1>Something wrong :( <a href='{{ route('dashboard') }}'>reload</a></h1>");
            }
        });
    }

    function productPublish(event, url)
    {
        event.preventDefault();
        var status = $('#products-status');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");

        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            success: function() {
                status.html('');
                getProduct();
            },
            error: function() {

            }
        });
    }

    function getProduct()
    {
        var url = '{{ route('admin_products') }}' + '?page=' + $('#current-page').html();
        var status = $('#products-status');
        var productTable = $('#products-table');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                status.html('');
                productTable.html(data);
            },
            error: function () {

            }

        });
    }

    function removeProduct(event, url)
    {
        event.preventDefault();
        var status = $('#products-status');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");
        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            success: function() {
                status.html('');
                getProduct();
            },
            error: function () {

            }

        });
    }

    function productUpdate(event, url)
    {
        event.preventDefault();
        if (checkInputs() === true) {
            return false;
        }
        var status = $('#products-status');
        var productModel = $('#product-model');

        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");

        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            contentType: false,
            processData: false,
            data: getFormData(),
            success: function(data) {
                status.html('');
                productModel.html(data);
                getProduct();
            }
        });
    }

    function productCreate(event, url)
    {
        event.preventDefault();
        if (checkInputs() === true) {
            return false;
        }
        var status = $('#products-status');
        var productModel = $('#product-model');

        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");

        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            contentType: false,
            processData: false,
            data: getFormData(),
            success: function(data) {
                status.html('');
                productModel.html(data);
                getProduct();
            }
        });
    }

    function productSearch(event)
    {
        event.preventDefault();
        var orderNo = $('#products-order-no').val();
        if (orderNo == '') {
            return false;
        }
        var status = $('#products-status');
        var productTable = $('#products-table');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");

        var url = '{{ url('admin/product-search') }}' + '/' + (orderNo == '' ? 'none' : orderNo);

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                status.html('');
                productTable.html(data);
            }
        });
    }

    function checkInputs()
    {
        if ($('#product-product_name').val() == '' ||
            $('#product-product_price').val() == '' ||
            $('#product-product_description').val() == '' ||
            $('#product-product_details').val() == '' ||
            $('#product-product_quantity').val() == ''
        ) {
            alert('Please make sure that you fill all inputs');
            return true;
        }
    }

    function getFormData()
    {
        var productData = new FormData();

        productData.append($('input[type=file]')[0].name, $('input[type=file]')[0].files[0]);
        productData.append($('#product-product_name')[0].name, $('#product-product_name')[0].value);
        productData.append($('#product-product_price')[0].name, $('#product-product_price')[0].value);
        productData.append($('#product-product_description')[0].name, $('#product-product_description')[0].value);
        productData.append($('#product-product_details')[0].name, $('#product-product_details')[0].value);
        productData.append($('#product-product_quantity')[0].name, $('#product-product_quantity')[0].value);
        productData.append($('#product-product_admin_verify')[0].name, $('#product-product_admin_verify')[0].value);
        productData.append($('#product-category_id')[0].name, $('#product-category_id')[0].value);

        return productData;
    }

    // to prevent enter key
    $(document).keypress(function (event) {
        if (event.which == '13') {
            event.preventDefault();
        }
    });
</script>