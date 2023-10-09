@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($photos as $photo)
                <img src="{{$photo->image}}" alt="">
            @endforeach
        </div>
    </div>
</div>
@endsection
