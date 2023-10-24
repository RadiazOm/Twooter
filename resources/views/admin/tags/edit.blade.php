@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('tags.update') }}">
                    @csrf
                    <label for="name">name</label>
                    <input id="name" type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{old('name', $tag->name)}}">
                    @error('name')
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
