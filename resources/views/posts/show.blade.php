@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    @include('partials.post')
                </div>
                <h1 class="text-center m-5">Comments</h1>
                <form class="m-md-5" method="POST" action="{{ route('comments.store', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    <label for="description">Description</label>
                    <input id="description" type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{old('description')}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        Post comment
                    </button>
                </form>
                <div>
                    @foreach($post->comments()->get() as $comment)
                        @include('partials.comment')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
