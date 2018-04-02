@if (isset($data))
    <table class="table table-bordered">
        <tbody>
        {!! Form::open(['url' => route('update_client', $data->id), 'method' => 'post']) !!}
        <tr>
            <td><b>Client ID:</b></td>
            <td>
                {{ $data->id }}
            </td>
        </tr>
        <tr>
            <td><b>Username:</b></td>
            <td>{!! Form::text('username', $data->username, ['class' => 'form-control', 'id' => 'client-username-edit']) !!}</td>
        </tr>
        <tr>
            <td><b>Phone:</b></td>
            <td>{!! Form::text('phone', $data->phone, ['class' => 'form-control', 'id' => 'client-phone-edit']) !!}</td>
        </tr>
        <tr>
            <td><b>Address:</b></td>
            <td>{!! Form::text('address', $data->address, ['class' => 'form-control', 'id' => 'client-address-edit']) !!}</td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td>{!! Form::email('email', $data->email, ['class' => 'form-control', 'id' => 'client-email-edit']) !!}</td>
        </tr>
        <tr>
            <td><b>Status:</b></td>
            <td>{!! Form::select('size', getArrayOfClientStatus(), $data->status, ['class' => 'form-control', 'id' => 'client-status-edit']) !!}</td>
        </tr>
        {!! Form::close() !!}
        </tbody>
    </table>
@endif

<div class="row">
    <button type="button" class="btn btn-default col-sm-offset-1 col-sm-4" data-dismiss="modal">Close</button>
    <a href="{{ route('update_client', $data->id) }}" onclick="clientUpdate(event, this.href)"
       data-dismiss="modal" class="btn btn-primary col-sm-offset-1 col-sm-4">Update</a>
</div>