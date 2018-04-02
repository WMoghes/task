<table class="table table-striped">
    <thead>
    <tr>
        <th>Client Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    @if (isset($allClients))
        <tbody id="clients-table">

            @include('admin.pages.clients_includes.clients_table')

        </tbody>

        <div class="clients-pagination col-sm-4">
            <a id="first-page" class="btn btn-default" href="{{ $allClients->url(1) }}">First</a>
            <a id="next-page" class="btn btn-default" href="{{ url('/admin/clients?page=') }}">Next</a>
            <a id="previous-page" class="btn btn-default" href="{{ url('/admin/clients?page=') }}">Previous</a>
            <a id="last-page" class="btn btn-default" data-last="{{ $allClients->lastPage() }}" href="{{ $allClients->url($allClients->lastPage()) }}">Last</a>
        </div>


        <div id="client-status" class="text-center col-sm-2"></div>

        <div class="col-sm-3 pull-right">
            <h5>Page: <span id="current-page">1</span> of {{ $allClients->lastPage() }}</h5>
        </div>

    @endif

    @if (isset($allClientsFromSearch))
        <tbody id="clients-table">

        @include('admin.pages.clients_includes.clients_table_search_result')

        </tbody>

        <div style="margin: 10px" class="clients-pagination col-sm-4">
            <a id="first-page" class="btn btn-default" href="{{ $allClientsFromSearch->url(1) }}">First</a>
            <a id="next-page" class="btn btn-default" href="{{ url('/admin/clients?page=') }}">Next</a>
            <a id="previous-page" class="btn btn-default" href="{{ url('/admin/clients?page=') }}">Previous</a>
            <a id="last-page" class="btn btn-default" data-last="{{ $allClientsFromSearch->lastPage() }}" href="{{ $allClientsFromSearch->url($allClientsFromSearch->lastPage()) }}">Last</a>
        </div>


        <div id="client-status" class="text-center col-sm-2"></div>

        <div class="col-sm-3 pull-right">
            <h5>Page: <span id="current-page">1</span> of {{ $allClientsFromSearch->lastPage() }}</h5>
        </div>

    @endif
</table>
