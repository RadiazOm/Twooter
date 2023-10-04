@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <label for="description">Description</label>
                    <input id="description" type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{old('description', $post->description)}}">
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="image">Image</label>
                    <input id="image" type="file" class="form-control @error('image')is-invalid @enderror" name="image" value="{{old('image', url("/img/posts/" . $post->image))}}">

                    <img src="{{old('image', url("/img/posts/" . $post->image))}}" alt="Picutre to be uploaded">

                    @error('image')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
