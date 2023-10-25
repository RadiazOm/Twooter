@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="description">Description</label>
                    <input id="description" type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{old('description')}}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                    <label for="image">Image</label>
                    <input id="image" type="file" class="form-control @error('description')is-invalid @enderror" name="image" value="{{old('image')}}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    <div>
                        Tags
                    </div>
                    @foreach(\App\Models\Tag::all() as $tag)
                        <div class="form-check">
                            <label for="{{$tag->name}}" class="form-check-label">{{$tag->name}}</label>
                            <input id="{{$tag->name}}" type="checkbox" class="form-check-input @error($tag->name)is-invalid @enderror" name="{{$tag->name}}" value="{{$tag->id}}">
                        </div>
                        @error($tag->name)
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    @endforeach

                    <button type="submit" class="btn btn-primary">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
