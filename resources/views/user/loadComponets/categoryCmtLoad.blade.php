@foreach ($comments as $comment)
    <div class="media mb-4 shadow">
        <img src="" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
        <div class="media-body">
            <h6>{{ $comment->user->name }}<small> - <i>{{ $comment->created_at->diffForHumans() }}</i></small>
            @if(!empty(Auth::user()))
                @if(Auth::user()->id == $comment->user->id || Auth::user()->role == '1')
                <button class="btn btn-link text-danger float-end" onclick="deleteCommet({{$comment->id}})"><i class="fa-solid fa-trash"></i></button>
                @endif
            @endif
            </h6>
            <div class="text-primary mb-2">
                @for($i = 0; $i < 5; $i++)
                @if($comment->rating > $i)
                <i class="fa-solid fa-star"></i>
                @else
                <i class="far fa-star"></i>
                @endif
                
                @endfor
            </div>
            <p>{{ $comment->comment }}</p>
        </div>
    </div>
@endforeach
<div>
    <div class="text-start">
    @if ($totalComment > 5 && count($comments) != $totalComment)
       
            <button class="btn btn-link text-dark" onclick="moreComment()">
                See more <i class="fa-solid fa-angle-down"></i>
            </button>
    @elseif (count($comments) == $totalComment && count($comments) != 0 && count($comments) > 5)
    <button class="btn btn-link text-dark" onclick="showLessComment()">
        Show less <i class="fa-sharp fa-solid fa-angle-up"></i>
    </button>
    @elseif(count($comments) == 0)
        <h5 class="text-center mt-3">There is no comment to show!</h5>
    @endif  
</div>
