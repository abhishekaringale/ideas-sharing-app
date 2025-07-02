@extends('layout.layout')

@section('title', 'Idea Details')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            {{-- @include('shared.flash-messages') --}}
            {{-- @include('shared.submit-idea') --}}


            <div class="mt-3">
                @include('shared.idea-card', ['idea' => $idea])
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
