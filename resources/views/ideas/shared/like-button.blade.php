<div>
    @auth

        @if (Auth::user()->hasLiked($idea))
            <form action="{{ route('ideas.unlike', $idea->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light mb-1">
                    <span class="fas fa-heart me-1"></span>
                    {{ $idea->likes()->count() }}
                </button>
            </form>
        @else
            <form action="{{ route('ideas.like', $idea->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light my-1">
                    <span class="far fa-heart me-1"></span>
                    {{ $idea->likes()->count() }}
                </button>
            </form>
        @endif
    @endauth
    @guest
        <button class="btn btn-light mb-2" disabled>
            <span class="far fa-heart me-1"></span>
            {{ $idea->likes()->count() }}
        </button>
    @endguest
</div>
