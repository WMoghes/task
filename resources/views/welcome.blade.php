@extends('layouts.app')

@section('style')
    @include('admin.dashboard_styles.dashboard_style')
@endsection

@section('content')
    <div class="row" id="client-content">
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
                @include('site_includes.thumbnail_for_products', ['allPublishedProducts' => $allPublishedProducts])
            </div>
        </div>
    </div>
@endsection

@section('script')

    {!! Html::script(url('assets/plugin/rangeSlider/ion.rangeSlider.min.js')) !!}
    <script>
        var count = 0;
        $(document).ready(function () {
            ++count;
        });
        var saveResult = function (data) {
            $('#price_from').val(data.from);
            $('#price_to').val(data.to);
        };
        var min = '<?php echo isset($min) ? $min : 0 ?>';
        var max = '<?php echo isset($max) ? $max : 1000 ?>';

        $("#range").ionRangeSlider({
            type: "double",
            grid: true,
            min: min,
            max: max,
            from: min,
            to: max,
            onLoad: function (data) {
                saveResult(data);
            },
            onChange: function (data) {
                saveResult(data);
            },
            onFinish: function (data) {
                saveResult(data);
                if (count !== 0) {
                    guestSearch(event, 1);
                }
            },
            prefix: "$"
        });

        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            var url = this.href;
            var thumbnail = $('#thumbnail-ajax');
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    thumbnail.html(data);
                }
            });
        });

        function guestSearch(event, type = 0)
        {
            if (type === 0) {
                event.preventDefault();
            }
            var url = '{{ route('guest_search') }}';
            var thumbnail = $('#thumbnail-ajax');
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    'product_name': $('#product-name').val(),
                    'price_from': $('#price_from').val(),
                    'price_to': $('#price_to').val()
                },
                success: function (data) {
                    thumbnail.html(data);
                }
            });
        }

        function displayProduct(event, url)
        {
            event.preventDefault();
            var page = $('#client-content');
            page.html('<h1>Loading....</h1>');

            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                },
                error: function () {

                }
            });
        }

        function goBack(event, url)
        {
            event.preventDefault();
            var page = $('body');
            page.html('<h1>Loading....</h1>');

            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                },
                error: function () {

                }
            });
        }
    </script>
@endsection
