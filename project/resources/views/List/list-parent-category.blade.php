@foreach ($categories as $item)
<li class="dd-item" data-category_id='{{$item->id}}'><div class="dd-handle">{{$item->name}}</div>
    <div class="delete"><i onclick="myDelete({{$item->id}})" class="fa-solid fa-x"></i></div>
    <ol class="dd-list">
@if (count($item->children)>0)
@for ($i = 0; $i < count($item->children); $i++)
<li class="dd-item" data-category_id='{{$item->children[$i]->id}}'><div class="dd-handle">{{$item->children[$i]->name}} </div>
    <div class="delete"><i onclick="myDelete({{$item->children[$i]->id}})" class="fa-solid fa-x"></i></div>
@if (count($item->children[$i]->children)>0)
<ol class="dd-list">
@include('List.list-parent-category',["categories"=>$item->children[$i]->children])
</ol>
@endif
</li>
@endfor               

@endif
</ol>
</li>
@endforeach
