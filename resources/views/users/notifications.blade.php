@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Notifications  </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                @if ($notification->type == 'App\Notifications\NewReplyAdded')
                    New reply was added to your discussion <strong>{{ $notification->data['discussion']['title'] }}</strong>
                @else
                    Your reply was marked as best reply for discussion <strong>{{ $notification->data['discussion']['title'] }}</strong>
                @endif
                    </span>
                    <div style="width: 30%" class="text-right">
                    <a href="{{ route('discussions.show', $notification->data['discussion']['slug']) }}" class="btn btn-info btn-sm">View Discussion</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection