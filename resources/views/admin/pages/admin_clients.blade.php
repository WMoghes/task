<div class="panel panel-default">
    <div class="panel-heading">Clients</div>

    <div class="panel-body">
        {{--<div class="search-area">--}}
            {{--<form class="form-inline">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="client-email">Email</label>--}}
                    {{--<input type="text" class="form-control" id="client-email-search" placeholder="Email to search">--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="#" onclick="getClientEmail(event)">Search</a>--}}
            {{--</form>--}}
        {{--</div>--}}

        <div id="client-search">

            @include('admin.pages.clients_includes.search_includes.client_search')

        </div>
    </div>
</div>

@include('admin.pages.clients_includes.clients_models')