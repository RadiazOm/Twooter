<div class="card m-md-5">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <img class="profile-image" src="{{url("/img/users/" . $comment->user->profile_picture)}}" alt="Profile picture of the user">
                <div class="m-3 h5">{{$comment->user->name}}</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="content">{{$comment->description}}</div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <div class="fw-bold">{{$comment->created_at}}</div>
    </div>
</div>

