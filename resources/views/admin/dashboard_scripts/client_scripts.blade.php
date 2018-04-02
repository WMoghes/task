<script>
    $(document).on('click', '.clients-pagination a', function(e) {
        e.preventDefault();
        var lastPage = $('#last-page').attr('data-last');
        var currentPage = $('#current-page');
        var nextPage = $('#next-page');
        var previousPage = $('#previous-page');
        var getCurrentPage = parseInt(currentPage.html());

        if (this.id === 'first-page' && parseInt(lastPage) != 1) {
            getData(this.href, '#clients-table', '1', '#client-status');
        } else if (this.id === 'last-page' && parseInt(lastPage) != 1) {
            getData(this.href, '#clients-table', lastPage, '#client-status');
        } else if (this.id === 'next-page' && getCurrentPage < lastPage && getCurrentPage >= 1) {
            getData(this.href + ++getCurrentPage, '#clients-table', getCurrentPage, '#client-status');
        } else if (this.id === 'previous-page' && getCurrentPage <= lastPage && getCurrentPage >= 2) {
            getData(this.href + --getCurrentPage, '#clients-table', getCurrentPage, '#client-status');
        }
    });

    {{--function getClientEmail(event)--}}
    {{--{--}}
        {{--event.preventDefault();--}}
        {{--var status = $('#client-status');--}}
        {{--var clientTable = $('#client-search');--}}
        {{--var email = $('#client-email-search');--}}

        {{--if (email.val() == '') {--}}
            {{--return false;--}}
        {{--}--}}

        {{--var url = '{{ url('admin/client-search') }}' + '/' + ((email.val() === '') ? 'none' : email.val());--}}

        {{--status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");--}}

        {{--$.ajax({--}}
            {{--url: url,--}}
            {{--type: 'get',--}}
            {{--success: function(data) {--}}
                {{--status.html('');--}}
                {{--clientTable.html(data);--}}
            {{--},--}}
            {{--error: function () {--}}

            {{--}--}}

        {{--});--}}
    {{--}--}}

    function getClient()
    {
        var url = '{{ route('admin_clients') }}' + '?page=' + $('#current-page').html();
        var status = $('#client-status');
        var clientTable = $('#clients-table');
        status.html("<p style='background-color: #cccccc;padding: 0px'><b>Loading...</b></p>");
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                status.html('');
                clientTable.html(data);
            },
            error: function () {

            }

        });
    }

    function removeClient(event, url)
    {
        event.preventDefault();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            success: function() {
                getClient();
            },
            error: function() {

            }
        });
    }

    function clientUpdate(event, url)
    {
        event.preventDefault();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: url,
            type: 'post',
            data: {
                'username': $('#client-username-edit').val(),
                'phone': $('#client-phone-edit').val(),
                'address': $('#client-address-edit').val(),
                'email': $('#client-email-edit').val(),
                'status': $('#client-status-edit').val()
            },
            success: function(data) {
                console.log(data);
                getClient();
            },
            error: function() {

            }
        });
    }

    function getClientModel(event, clientId, modelType)
    {
        var url = '{{ url('admin/client') }}' + '/' + clientId + '/' + modelType;
        var clientModel = $('#client-model');

        clientModel.html("<h1>Loading.....</h1>");
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                clientModel.html(data);
            },
            error: function() {
                clientModel.html("<h1>Something wrong :( <a href='{{ route('dashboard') }}'>reload</a></h1>");
            }
        });
    }
</script>