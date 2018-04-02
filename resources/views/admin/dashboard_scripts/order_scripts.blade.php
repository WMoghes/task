<script>
    $(document).on('click', '.orders-pagination a', function(e) {
        e.preventDefault();
        var lastPage = $('#last-page').attr('data-last');
        var currentPage = $('#current-page');
        var nextPage = $('#next-page');
        var previousPage = $('#previous-page');
        var getCurrentPage = parseInt(currentPage.html());

        if (this.id === 'first-page') {
            getData(this.href, '#orders-table', '1', '#orders-status');
        } else if (this.id === 'last-page') {
            getData(this.href, '#orders-table', lastPage, '#orders-status');
        } else if (this.id === 'next-page' && getCurrentPage < lastPage && getCurrentPage >= 1) {
            getData(this.href + ++getCurrentPage, '#orders-table', getCurrentPage, '#orders-status');
        } else if (this.id === 'previous-page' && getCurrentPage <= lastPage && getCurrentPage >= 2) {
            getData(this.href + --getCurrentPage, '#orders-table', getCurrentPage, '#orders-status');
        }
    });

    function getOrderModel(event, orderId, modelType)
    {
        event.preventDefault();
        var orderModel = $('#order-model');
        var url = '{{ url('admin/order') }}' + '/' + orderId + '/' + modelType;
        var requestType = 'get';

        orderModel.html("<h1>Loading.....</h1>");

        orderAjaxModel(url, requestType, orderModel);
    }

    function orderAjaxModel(url, requestType, orderModel)
    {
        var orderModel = $('#order-model');
        $.ajax({
            url: url,
            type: requestType,
            success: function(data) {
                orderModel.html(data);
            },
            error: function() {
                orderModel.html("<h1>Something wrong :( <a href='{{ route('dashboard') }}'>reload</a></h1>");
            }
        });
    }

    function orderStatus(id)
    {
        var e = document.getElementById("order-status-" + id);
        var orderStatus = e.options[e.selectedIndex].value;
        var url = '{{ url('admin/order') }}' + '/' + id + '/' + orderStatus;

        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            data: {
                'order_status': orderStatus
            },
            success: function () {
                getOrder()
            }
        });
    }

    function getOrder()
    {
        var url = '{{ route('admin_orders') }}' + '?page=' + $('#current-page').html();
        var status = $('#orders-status');
        var orderTable = $('#orders-table');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                status.html('');
                orderTable.html(data);
            },
            error: function () {

            }

        });
    }

    function orderSearch(event)
    {
        event.preventDefault();
        var orderNo = $('#order-number').val();
        if (orderNo == '') {
            return false;
        }
        var status = $('#orders-status');
        var orderTable = $('#orders-table');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");

        var url = '{{ url('admin/order-search') }}' + '/' + (orderNo == '' ? 'none' : orderNo);

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                status.html('');
                orderTable.html(data);
            }
        });
    }
</script>