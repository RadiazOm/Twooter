<div class="card m-md-5">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <img class="profile-image" src="{{url("/img/users/" . $post->user->profile_picture)}}" alt="Profile picture of the user">
                <div class="m-3 h5">{{$post->user->name}}</div>
            </div>
            <div>
                @if($post->user->id == auth()->user()->id)
                    <a class="btn @if($post->status) btn-secondary @else btn-outline-secondary @endif" href="{{route('posts.status', $post->id)}}"
                       onclick="event.preventDefault();
                                                     document.getElementById('{{$post->id}}STAT').submit();">
                        @if($post->status) Active @else Inactive @endif
                    </a>
                    <a class="btn btn-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
                    <a class="btn btn-danger" href="{{ route('posts.destroy', $post->id) }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('{{$post->id}}DEL').submit();">
                        Delete
                    </a>
                    <form id="{{$post->id}}DEL" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                    <form id="{{$post->id}}STAT" action="{{ route('posts.status', $post->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('PATCH')
                    </form>
                @endif

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="content">{{$post->description}}</div>
        @if($post->image)
            <img class="img-fluid" src="{{url("/img/posts/" . $post->image)}}" alt="Image of the post">
        @endif
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a id="like" data-id="{{$post->id}}" class="btn @if($post->likes()->where('user_id', '=', auth()->id())->exists()) btn-outline-primary @else btn-primary @endif">Likes: {{$post->likes()->count()}}</a>
        <a class="btn btn-primary" href="{{route('posts.show', $post->id)}}">
            Comments: {{$post->comments()->count()}}
        </a>
        <div class="fw-bold">{{$post->created_at}}</div>
    </div>
</div>

