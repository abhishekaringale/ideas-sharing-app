@extends('layout.layout')

@section('title', 'Terms')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>terms</h1>
            <div>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking
                at
                its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                opposed
                to using 'Content here, content here', making it look like readable English. Many desktop publishing
                packages
                and
                web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                uncover
                many
                web sites still in their infancy. Various versions have evolved over the years, sometimes by accident,
                sometimes
                on
                purpose (injected humour and the like).</div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
