<div class="card m-md-5">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <img class="profile-image" src="{{url("/img/users/" . $post->user->profile_picture)}}" alt="Profile picture of the user">
            <div class="title m-3">{{$post->user->name}}</div>
        </div>
    </div>
    <div class="card-body">
        <div class="content">{{$post->description}}</div>
        @if($post->image)
            <img class="img-fluid" src="{{$post->image}}" alt="Image of the post">
        @endif
    </div>
    <div class="card-footer">
        <div class="fw-bold">{{$post->created_at}}</div>
    </div>
</div>

