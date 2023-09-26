@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <label for="description">Description</label>
                    <input id="description" type="text" class="form-control" name="description" value="{{old('description')}}">

                    <button type="submit" class="btn btn-primary">
                        Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
