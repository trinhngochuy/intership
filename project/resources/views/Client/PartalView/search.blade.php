@foreach ($posts as $post)
<div class="post">
    <div class="thumbnail">
        <img src="{{$post->thumbnail}}" alt="">
    </div>
    <a href="{{route('client.post.detail',["postslug"=> $post->slug])}}">
    <div class="title">          
        {{$post->title}}
    </div>
       </a>
 <div class="edit-delete">
    <div onclick="deletePost({{$post->id}})" class="remove-post">
        <i class="fa fa-x"></i>
       </div>  
 <a href="{{route('client.post.update.get',["postId"=>$post->id])}}">
    <div class="edit-post">
        <i class="fa fa-pen-to-square"></i>
   </div>
 </a>
 </div>
</div>    
@endforeach