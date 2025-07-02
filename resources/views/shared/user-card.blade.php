<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageUrl() }}"
                        alt="{{ $user->name }}">
                    <div>
                        @if ($editing ?? false)
                            <input name="name" class="form-control" value="{{ $user->name }}">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        @else
                            <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                                </a></h3>
                            <span class="fs-6 ">{{ $user->email }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    @auth
                        {{-- @if (Auth::user()->id === $user->id) --}}
                        @can('update', $user)
                            @if ($editing ?? false)
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm"> Cancel </a>
                            @else
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"> Edit Profile
                                </a>
                            @endif
                        @endcan
                        {{-- @endif --}}
                    @endauth
                </div>
            </div>
            @if ($editing ?? false)
                <div>
                    <label for="image" class="mt-3">Profile Image:</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endif
            <div class="px-2 mt-4">
                <h5 class="fs-5"> About : </h5>
                @if ($editing ?? false)
                    <div class="mb-3">
                        <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                        @error('bio')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary btn-sm mb-2"> Save </button>
                @else
                    <p class="fs-6 fw-light ">
                        {{ $user->bio ?? 'Not provided a bio yet.' }}
                    </p>
                @endif

                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span>{{ $user->followers()->count() }} followers</a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->ideas()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comments()->count() }} </a>
                </div>
            </div>
        </form>

        @auth
            @if (Auth::user()->id !== $user->id)
                @if (Auth::user()->following->contains($user->id))
                    {{-- UNFOLLOW BUTTON --}}
                    <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm mt-2">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('users.follow', $user->id) }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-sm mt-2"> Follow </button>
                        </div>
                    </form>
                @endif
            @endif
        @endauth
    </div>
</div>
<hr>
