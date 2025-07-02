@extends('layout.layout')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Admin Dashboard</h1>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    @include('shared.widget', [
                        'icon' => 'fas fa-users',
                        'title' => 'Total Users',
                        'value' =>  $totalUsers ,
                    ])
                </div>
                <div class="col-sm-6 col-md-4">
                    @include('shared.widget', [
                        'icon' => 'fas fa-lightbulb',
                        'title' => 'Total Ideas',
                        'value' =>  $totalIdeas ,
                    ])
                </div>
                <div class="col-sm-6 col-md-4">
                    @include('shared.widget', [
                        'icon' => 'fas fa-comment',
                        'title' => 'Total Comments',
                        'value' =>  $totalComments ,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
