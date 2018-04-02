<table class="table table-bordered">
    <tbody>
    {!! Form::open(['url' => route('product_create'), 'id' => 'form-product-create', 'method' => 'post', 'files' => true]) !!}

    <tr>
        <td><b>Product Name:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_name') ? ' has-error' : '' }}">
                {!! Form::text('product_name', old('product_name'), ['class' => 'form-control', 'id' => 'product-product_name', 'placeholder' => 'Product Name']) !!}

                @if ($errors->has('product_name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_name') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Product photo:</b></td>
        <td>
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                <input type="file" id="product-image" name="image">

                @if ($errors->has('image'))
                    <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                @endif
            </div>
            <img src="{{ getProductPhotoSearch(null) }}" width="400" height="300" id="product-image-preview">
        </td>
    </tr>
    <tr>
        <td><b>Product Price:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_price') ? ' has-error' : '' }}">
                {!! Form::text('product_price', old('product_price'), ['class' => 'form-control', 'id' => 'product-product_price', 'placeholder' => 'Product Price']) !!}

                @if ($errors->has('product_price'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_price') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Product Description:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_description') ? ' has-error' : '' }}">
                {!! Form::textarea('product_description', old('product_description'), ['class' => 'form-control', 'id' => 'product-product_description', 'rows' => 3, 'cols' => 10, 'placeholder' => 'Product Description']) !!}

                @if ($errors->has('product_description'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_description') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Product Details:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_details') ? ' has-error' : '' }}">
                {!! Form::textarea('product_details', old('product_details'), ['class' => 'form-control', 'id' => 'product-product_details', 'rows' => 3, 'cols' => 10, 'placeholder' => 'Product Details']) !!}

                @if ($errors->has('product_details'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_details') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Product Quantity:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_quantity') ? ' has-error' : '' }}">
                {!! Form::text('product_quantity', old('product_quantity'), ['class' => 'form-control', 'id' => 'product-product_quantity', 'placeholder' => 'Product Quantity']) !!}

                @if ($errors->has('product_quantity'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_quantity') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Admin Verify:</b></td>
        <td>
            <div class="form-group {{ $errors->has('product_admin_verify') ? ' has-error' : '' }}">
                {!! Form::select('product_admin_verify', getArrayOfAdminVerify(), old('product_admin_verify'), ['class' => 'form-control', 'id' => 'product-product_admin_verify']) !!}

                @if ($errors->has('product_admin_verify'))
                    <span class="help-block">
                            <strong>{{ $errors->first('product_admin_verify') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Category Name:</b></td>
        <td>
            <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                {!! Form::select('category_id', \App\Category::allCategories(), old('category_id'), ['class' => 'form-control', 'id' => 'product-category_id']) !!}


                @if ($errors->has('category_id'))
                    <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                @endif
            </div>
        </td>
    </tr>
    {!! Form::close() !!}
    </tbody>
</table>

@if (isset($status))
    <div class="row">
        <h4 class="alert alert-success text-center">{{ $status }}</h4>
    </div>
@endif

<div class="row">
    <button type="button" class="btn btn-default col-sm-offset-1 col-sm-4" data-dismiss="modal">Close</button>
    <a href="{{ route('product_create') }}" onclick="productCreate(event, this.href)"
       class="btn btn-primary col-sm-offset-1 col-sm-4">Create</a>
</div>

<script>
    document.getElementById('product-image').onchange = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            document.getElementById('product-image-preview').src = dataURL;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>