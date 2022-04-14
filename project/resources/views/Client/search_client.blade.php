@foreach ($posts as $item)
<a href="{{route('client.post.detail',["postid"=> $item->id])}}" class="link-sugest">
    <div class="sugest-item"> 
        <span class="icon-sugest"><i class="fa fa-magnifying-glass"></i></span>
        <span>
           {{ $item->title}}
        </span>
    </div>
</a>
@endforeach