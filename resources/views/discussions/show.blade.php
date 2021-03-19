@extends('layouts.app')

@section('content')
    <div class="card">
        @include('partials.discussion-header')
        <div class="card-body">
            <strong>{{ $discussion->title }}</strong>

            <hr>

            {!! $discussion->content !!}

            @if ($discussion->reply_id)
            <div class="card mt-5">
                <div class="card-header">Best Reply</div>
                {{-- <span class="border border-success text-success rounded p-1 text-uppercase">Best reply</span> --}}
                <div class="card-body">
                    {!! $discussion->bestReply->content !!}
                </div>
            </div>
            @endif
        </div>
    </div>

    @foreach ($discussion->replies()->paginate(3) as $reply)
        <div class="card my-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <img src="{{ Gravatar::src($reply->owner->email) }}" alt="" width="40px" height="40px" style="border-radius: 50%">
                    <span class="ml-2 font-weight-bold">{{ $reply->owner->name }}</span>
                </div>
                <div>
                    @if($discussion->reply_id != $reply->id)
                        <form action="{{ route('discussion.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">Mark as best reply</button>
                        </form>
                    @else
                        <div class="text-success border border-success rounded p-1">Best reply</div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                {!! $reply->content !!}
            </div>
        </div>
    @endforeach

    {{ $discussion->replies()->paginate(3)->links() }}

    
    <div class="card my-5">
        <div class="card-header">Add a reply</div>
        <div class="card-body">
            @auth
            <form action="{{ route('replies.store', $discussion->slug)}}" method="POST">
                @csrf
                <input id="content" type="hidden" name="content" class="form-control">
                <trix-editor input="content"></trix-editor>

                <button type="submit" class="btn btn-success mt-2">Add reply</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-info my-2">Sign in to add a reply</a>
            @endauth
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection