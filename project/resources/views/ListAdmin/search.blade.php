<table id="table">
          <tr class="header-row">
                <th class="header-item items">
                  @lang('admin.id')
                </th>
                <th class="header-item items">
                    @lang('admin.title')

                </th>
                 <th class="header-item items">
                    @lang('admin.category')

                 </th>
                 <th class="header-item items">
                     @lang('admin.thumbnail')

                 </th>
                 <th class="header-item items">
                     @lang('admin.create_at')

                 </th>
                 <th class="header-item items">
                     @lang('admin.update_at')

                 </th>
                 <th class="header-item items">
                    @lang('admin.action')
                 </th>
            </tr>
   
   @foreach ($posts as $p)
   <tr class="table-rows">
   <td class="items">
    {{$p->id}}
</td>
<td class="items">
    <div class="class-title">
             {{$p->title}}
    </div>
</td>
<td class="items">
    {{$p->category->name}}
</td>
<td class="items">
<img src="{{$p->thumbnail}}" width="100px" height="100px" alt="">
</td>
<td class="items">
    {{formatDate($p->created_at)}}
</td>
<td class="items">
   {{formatDate($p->updated_at)}}
</td>
<td class="items">
 <div class="impact">
    <a href="#" onclick="Delete({{$p->id}})" title="Delete"><i class="fa-regular fa-trash-can"></i></a>
    <a href="{{route('admin.post.update.get',['postId' =>$p->id])}}" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
 </div>
</td>
</tr>
   @endforeach
</table>