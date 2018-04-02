<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <p class="col-sm-3">Products</p>
            <div id="products-status" class="col-sm-offset-6 col-sm-3"></div>
        </div>
    </div>

    <div id="products-body" class="panel-body">

        <div class="search-area">
            <form class="form-inline">
                <div class="form-group">
                    <label for="products-name">Product No.</label>
                    <input type="number" min="1" class="form-control" id="products-order-no" placeholder="Product No.">
                </div>
                <a href="#" class="btn btn-default" onclick="productSearch(event)">Search</a>
                <div class="col-sm-3 pull-right">
                    <a class="btn btn-primary" href="#"
                       onclick="getProductModel(event, '0', 'create')"
                       data-toggle="modal" data-target="#myModal">Add new product</a>
                </div>
            </form>
        </div>
        
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product No.</th>
                <th>Product Photo</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Actions</th>
            </tr>
            </thead>
            @if (isset($allProducts))
                <tbody id="products-table">

                    @include('admin.pages.products_includes.products_table')

                </tbody>

                <div class="products-pagination col-sm-4">
                    <a id="first-page" class="btn btn-default" href="{{ $allProducts->url(1) }}">First</a>
                    <a id="next-page" class="btn btn-default" href="{{ url('/admin/products?page=') }}">Next</a>
                    <a id="previous-page" class="btn btn-default" href="{{ url('/admin/products?page=') }}">Previous</a>
                    <a id="last-page" class="btn btn-default" data-last="{{ $allProducts->lastPage() }}" href="{{ $allProducts->url($allProducts->lastPage()) }}">Last</a>
                </div>


                <div class="col-sm-3 pull-right">
                    <h5>Page: <span id="current-page">1</span> of {{ $allProducts->lastPage() }}</h5>
                </div>

            @endif

            @if (isset($allProductsFromSearch))

                @if (isset($status))
                    <div class="row">
                        <h4 class="alert alert-success text-center">{{ $status }}</h4>
                    </div>
                @endif

                <tbody id="products-table">

                    @include('admin.pages.products_includes.products_table_search_result')

                </tbody>

                <div class="products-pagination col-sm-4">
                    <a id="first-page" class="btn btn-default" href="{{ $allProducts->url(1) }}">First</a>
                    <a id="next-page" class="btn btn-default" href="{{ url('/admin/products?page=') }}">Next</a>
                    <a id="previous-page" class="btn btn-default" href="{{ url('/admin/products?page=') }}">Previous</a>
                    <a id="last-page" class="btn btn-default" data-last="{{ $allProducts->lastPage() }}" href="{{ $allProducts->url($allProducts->lastPage()) }}">Last</a>
                </div>


                <div class="col-sm-3 pull-right">
                    <h5>Page: <span id="current-page">1</span> of {{ $allProducts->lastPage() }}</h5>
                </div>

            @endif
        </table>
    </div>
</div>

@include('admin.pages.products_includes.products_models')