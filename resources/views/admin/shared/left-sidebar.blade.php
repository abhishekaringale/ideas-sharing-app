<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin.dashboard') ? 'bg-dark text-white rounded' : ''}}" href="{{route('admin.dashboard')}}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin.users') ? 'bg-dark text-white rounded' : ''}}" href="{{route('admin.users')}}">
                    <span>Users</span></a>
            </li>

        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{route('profile')}}">View Profile </a>
    </div>
</div>
