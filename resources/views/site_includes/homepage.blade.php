<div class="col-sm-2 side-bar">
    <div class="panel panel-default">
        <div class="panel-heading">Search</div>

        <div class="panel-body">
            <div class="search-side-bar">
                <div class="form-group">
                    <label for="product_name">Product name or Category name</label>
                    {!! Form::text('product_name', old('product_name'), ['id' => 'product-name', 'class' => 'form-control', 'placeholder' => 'Product name or Category name']) !!}
                </div>

                <div class="form-group">
                    <input name="range" type="range" id="range">
                    <input name="price_from" type="hidden" id="price_from">
                    <input name="price_to" type="hidden" id="price_to">
                </div>

                <div class="form-group">
                    <a href="#" onclick="guestSearch(event)"
                       class="form-control btn btn-primary pull-right">Search</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="app" class="col-sm-10 content">
    <div id="thumbnail-ajax">
        @include('site_includes.thumbnail_for_products')
    </div>
</div>