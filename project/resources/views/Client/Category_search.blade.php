<div class="grid-container">
@foreach ($posts as $item)
<div class="item">
    <div class="content">
        <a href="{{route('client.post.detail',["postslug"=> $item->slug])}}">
        <div class="top-title">
            <div class="title">
<span>{{$item->title}}</span>         
            </div>
            <div class="discription">
                <span>{{$item->discription}}</span>
            </div>
        </div>
        </a>
        <div class="thumbnail">
        <img src="{{$item->thumbnail}}" alt=""> 
        </div>
        <div class="watch-like">
            <div class="wrap">
                <span class="watching"><i class="fa fa-eye"></i> {{$item->view}}</span>
                <span data-id="{{$item->id}}" class="like"><i class="fa fa-heart"></i>  {{$item->like}}</span>
            </div>
        </div>
    </div>
</div>    
@endforeach
</div>