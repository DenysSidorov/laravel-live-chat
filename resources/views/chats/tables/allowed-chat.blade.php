<table id="t1" class="table table-condensed table-striped align-middle">
    <thead>
    <tr>
        <th>{{ __('name') }}</th>
        <th>{{ __('status') }}</th>
        <th>{{ __('owner') }}</th>
        <th>{{ __('select') }}</th>
        <th>{{ __('delete') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($allowedChats as $chat)
        <tr>
            <td>{{ $chat->name }}</td>
            <td>{{ $chat->status }}</td>
            <td>{{ $chat->user->name }}</td>
            <td><a type="button" class="btn btn-link"
                   href="{{ route('chats.box', [$chat->id]) }}">{{ __('go') }}</a>
            </td>
            <td>

            @if(auth()->id() === $chat->user->id)

@include('chats.forms.delete')

            @endif

            </td>
        </tr>
    @empty
        <h5>{{ __('chat.empty') }}</h5>
    @endforelse
    </tbody>
</table>
