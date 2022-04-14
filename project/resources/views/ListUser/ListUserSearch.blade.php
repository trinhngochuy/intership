<table id="table">
   <tr class="header-row">
       <th class="header-item items">
<input type="checkbox" id="all">  Select All
<div class="menu"id="menu-buttom">
   <i  class="fa-solid fa-chevron-down"></i>
   <div class="menus">
      <div class="menu-item" onclick="deleteAll()">
         Delete All
      </div>
   </div>
</div>
       </th>
       <th class="header-item items">
           User Name
        </th>
        <th class="header-item items">
           Roles
        </th>
        <th class="header-item items">
          Name
        </th>
        <th class="header-item items">
           Email
        </th>
        <th class="header-item items">
           Date of Birth
        </th>
        <th class="header-item items">
           Status
        </th>
        <th class="header-item items">
          Action
        </th>
   </tr>
@foreach ($users as $user)
<tr class="table-rows">
    <td class="items">
 <input type="checkbox" class="checkitem" value="{{$user->id}}">
 <span>{{$user->id}}</span>
 </td>
 <td class="items">
<div class="ifor">
<img src="{{$user->thumbnail}}" alt="">
<div class="alert-copy">
    click coppy
</div>
<div class="user-name">
{{$user->user_name}}
</div>
</div>
 </td>
 <td class="items">
   <div class="roles">
<div class="role-item">
 @foreach ($user->roles as $role)
 {{ $loop->first ? '' : ', ' }}
<span>{{$role->role_name}}</span>
 @endforeach
</div>
   </div>
 </td>
 <td class="items">
<span>{{$user->first_name}} {{$user->last_name}}</span>
</td>
 <td class="items">
    <div class="ifor">
    <div class="alert-copy">
        click coppy
    </div>
    <div class="email">
        <span>{{$user->email}}</span>
    </div>
    </div>
 </td>
 <td class="items">
    {{formatDate($user->birth_day)}}
 </td>
 <td class="items" onclick="changeStatus({{$user->id}})">
    @if ($user->status == 0)
    <i class="fa-solid fa-lock"></i>
    <span>Lock</span>
    @else   
    <i class="fa-solid fa-lock-open"></i>
    <span>Unlock</span>
    @endif
</td>
 <td class="items">
  <div class="impact">
     <a href="#" class="removeUser" onclick="deleteUser({{$user->id}})" title="Delete"><i class="fa-regular fa-trash-can"></i></a>
     <a href="#ex1" rel="modal:open" onclick="changeUser({{$user->id}})" title="Delete"><i class="fa-solid fa-pen-to-square"></i></a>
  </div>
 </td>
</tr>
@endforeach

</table>