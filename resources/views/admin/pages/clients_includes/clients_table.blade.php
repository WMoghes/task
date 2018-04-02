@foreach($allClients as $allClient)
    <tr>
        <td>{{ $allClient->id }}</td>
        <td>{{ $allClient->username }}</td>
        <td>{{ $allClient->email }}</td>
        <td class="{{ $allClient->status == 0 ? 'active-status' : 'suspended' }}">{{ getNameOfClientStatus($allClient->status) }}</td>
        <td>
            <a href="#" onclick="getClientModel(event, '{{ $allClient->id }}', 'show')" class="btn btn-default"
               data-toggle="modal" data-target="#myModal">
                Show
            </a>
            <a href="#" onclick="getClientModel(event, '{{ $allClient->id }}', 'edit')" class="btn btn-primary"
               data-toggle="modal" data-target="#myModal">
                Edit
            </a>
            <a href="{{ route('remove_client', $allClient->id) }}" onclick="removeClient(event, this.href)"
               class="btn btn-danger">Remove</a>
        </td>
    </tr>
@endforeach