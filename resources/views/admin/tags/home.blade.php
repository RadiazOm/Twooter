@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="posts" class="col-md-8">
                <div class="h5 fw-bold text-center">Tags</div>
                @foreach($tags as $tag)
                    <div class="d-flex justify-content-between align-items-center">
                        <div>{{$tag->name}}</div>
                        <div>
                            <a class="btn btn-primary" href="{{route('tags.edit', $tag->id)}}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('tags.destroy', $tag->id) }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('{{$tag->id}}').submit();">
                                Delete
                            </a>
                            <form id="{{$tag->id}}" action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @endforeach
                <a class="btn btn-secondary" href="{{route('tags.create')}}">Create</a>
            </div>
        </div>
    </div>
@endsection
