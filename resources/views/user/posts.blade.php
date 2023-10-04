@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="h5 fw-bold text-center">Your Posts</div>
                @foreach($posts as $post)
                    @include('partials.post')
                @endforeach
            </div>
        </div>
    </div>
@endsection
