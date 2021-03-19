<div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <img src="{{ Gravatar::src($discussion->author->enail) }}" width="40px" height="40px" style="border-radius:50%; margin-right:5px">
        <span class="ml-2 font-weight-bold text-uppercase">{{ $discussion->author->name }}</span>
    </div>
    <div>
        <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
    </div>
</div>