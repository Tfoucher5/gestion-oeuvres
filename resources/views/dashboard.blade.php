@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Notifications</h1>

    @if($notifications->isEmpty())
        <p>Aucune notification.</p>
    @else
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center {{ $notification->read_at ? 'bg-light text-muted' : '' }}">
                    <div class="flex-grow-1">
                        {{ $notification->data['message'] ?? 'Notification' }}
                    </div>
                    <div class="d-flex align-items-center">
                        @isset($notification->data['url'])
                            <a href="{{ $notification->data['url'] }}" class="btn btn-primary btn-sm me-2">
                                Voir
                            </a>
                        @endisset
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    Marquer comme lue
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
