@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 flex-column">
                <img class="profile-image" src="{{url("/img/users/" . auth()->user()->profile_picture)}}" alt="">
                <div>{{auth()->user()->name}}</div>
                <div>{{auth()->user()->email}}</div>
                <a href="{{route('user.edit', auth()->user()->id)}}">edit</a>
                <a href="{{route('user.posts')}}">my posts</a>
            </div>
        </div>
    </div>
@endsection
