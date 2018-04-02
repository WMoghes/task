@extends('layouts.app')

@section('style')
    @include('admin.dashboard_styles.dashboard_style')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-2 side-bar">
            @include('admin.includes.admin_side_bar')
        </div>

        <div id="app" class="col-sm-10 content"> </div>
    </div>

@endsection

@section('script')
    <script>
        'use strict';
        function getContent(url, event, liId)
        {
            event.preventDefault();
            getPage(url, '#app', '#' + liId);
        }

        function getPage(url, elementId, liId)
        {
            $(elementId).html("<h1>Loading....</h1>");
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('.panel-body li').removeClass();
                    $(elementId).html(data);
                    $(liId).addClass('active');
                },
                error: function() {
                    $(elementId).html("<h1>Something wrong :( <a href='{{ route('dashboard') }}'>reload</a></h1>");
                }
            });
        }

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })

        function getData(url, divId, getCurrentPage, status)
        {
            var currentPage = $('#current-page');
            var status = $(status);
            status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    status.html('');
                    $(divId).html(data);
                    currentPage.html(getCurrentPage);
                },
                error: function() {

                }
            });
        }

    </script>

    @include('admin.dashboard_scripts.client_scripts')

    @include('admin.dashboard_scripts.product_scripts')

    @include('admin.dashboard_scripts.order_scripts')
@endsection