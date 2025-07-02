@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.error-message')
            @include('shared.submit-idea')
            <hr>

            {{-- for no search result --}}
            @if (count($ideas) === 0)
                No ideas found.
            @else
                @foreach ($ideas as $idea)
                    <div class="mt-3">
                        @include('shared.idea-card', ['idea' => $idea])
                    </div>
                @endforeach

                <div class="mt-2">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            @endif
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
