@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{old('name', $user->name)}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <label for="profile-picture">Profile Picture</label>
                    <input id="profile-picture" type="file" class="form-control @error('image')is-invalid @enderror" name="profile-picture" value="{{old('profile-picture', url("/img/users/" . $user->profile_picture))}}">

                    <img src="{{old('profile-picture', url("/img/users/" . $user->profile_picture))}}" alt="Picture to be uploaded">

                    @error('profile-picture')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">
                        Change
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
