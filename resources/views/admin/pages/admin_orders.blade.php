<div class="panel panel-default">
    <div class="panel-heading">Orders</div>

    <div class="panel-body">
        <div class="panel-body">

            <div class="search-area">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="order-number">Order No.</label>
                        <input type="number" min="1" class="form-control" id="order-number" placeholder="Order No.">
                    </div>
                    <a href="#" onclick="orderSearch(event)" class="btn btn-default">Search</a>
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Client Name</th>
                    <th>Order Amount</th>
                    <th>Order Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @if (isset($allOrders))
                    <tbody id="orders-table">

                        @include('admin.pages.orders_includes.orders_table')

                    </tbody>

                    <div class="orders-pagination col-sm-4">
                        <a id="first-page" class="btn btn-default" href="{{ $allOrders->url(1) }}">First</a>
                        <a id="next-page" class="btn btn-default" href="{{ url('/admin/orders?page=') }}">Next</a>
                        <a id="previous-page" class="btn btn-default" href="{{ url('/admin/orders?page=') }}">Previous</a>
                        <a id="last-page" class="btn btn-default" data-last="{{ $allOrders->lastPage() }}" href="{{ $allOrders->url($allOrders->lastPage()) }}">Last</a>
                    </div>


                    <div id="orders-status" class="text-center col-sm-2"></div>

                    <div class="col-sm-3 pull-right">
                        <h5>Page: <span id="current-page">1</span> of {{ $allOrders->lastPage() }}</h5>
                    </div>

                @endif

                @if (isset($allOrdersFromSearch))
                    <tbody id="orders-table">

                        @include('admin.pages.orders_includes.orders_table_search_result')

                    </tbody>

                    <div class="orders-pagination col-sm-4">
                        <a id="first-page" class="btn btn-default" href="{{ $allOrders->url(1) }}">First</a>
                        <a id="next-page" class="btn btn-default" href="{{ url('/admin/orders?page=') }}">Next</a>
                        <a id="previous-page" class="btn btn-default" href="{{ url('/admin/orders?page=') }}">Previous</a>
                        <a id="last-page" class="btn btn-default" data-last="{{ $allOrders->lastPage() }}" href="{{ $allOrders->url($allOrders->lastPage()) }}">Last</a>
                    </div>


                    <div id="orders-status" class="text-center col-sm-2"></div>

                    <div class="col-sm-3 pull-right">
                        <h5>Page: <span id="current-page">1</span> of {{ $allOrders->lastPage() }}</h5>
                    </div>

                @endif
            </table>
        </div>
    </div>
</div>

@include('admin.pages.orders_includes.orders_models')