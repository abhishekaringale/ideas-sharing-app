@extends('layout.layout')

@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.error-message')
            <hr>

            <div class="mt-3">
                @include('shared.user-card', ['user' => $user])
            </div>
            {{-- <hr> --}}
            @foreach ($ideas as $idea)
                <div class="mt-3">
                    @include('shared.idea-card', ['idea' => $idea, 'editing' => false])
                </div>
            @endforeach

            <div class="mt-2">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
