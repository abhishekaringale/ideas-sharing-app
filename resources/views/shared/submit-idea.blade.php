@auth
    <h4> Share yours ideas </h4>
    <div class="row">
        <form action="{{ route('ideas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth


@guest
    <div class= "mt-3">
        <p>To share your ideas, please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>.</p>
    </div>
@endguest
