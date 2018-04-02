@if (isset($data))
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td><b>Client ID:</b></td>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <td><b>Username:</b></td>
                <td>{{ $data->username }}</td>
            </tr>
            <tr>
                <td><b>Phone:</b></td>
                <td>{{ $data->phone }}</td>
            </tr>
            <tr>
                <td><b>Address:</b></td>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <td><b>Status:</b></td>
                <td class="{{ $data->status == 0 ? 'active-status' : 'suspended' }}">{{ getNameOfClientStatus($data->status) }}</td>
            </tr>
        </tbody>
    </table>
@endif

<div class="row">
    <button type="button" class="btn btn-default col-sm-offset-4 col-sm-4" data-dismiss="modal">Close</button>
</div>
