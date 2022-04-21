@include('_Layout.lang-view')
<div class="Menu">
<div class="menu-content">
    <div class="menu-left">
        <div class="icon-menu">
            <i class="fa fa-bars"></i>
        </div>
        <div class="brand">
            <img src="https://i.pinimg.com/236x/e6/15/2f/e6152fc940ce8eb6bad79b99476b1d0b.jpg" alt="">
            <div class="brand-name">NEWs</div>
        </div>
    </div>
    <div class="menu-search">
    <div class="input-search">
        <span class="icon-search">
            <i class="fa fa-magnifying-glass"></i>
        </span>
        <input  autocomplete="off" placeholder="@lang('client-header.search')" class="search" name="key" type="text">
        <div class="sugest">  
        </div>
    </div>
    </div>
    <div class="menu-right">
   @if (Auth::user() !=null)
   <div class="user-infor">
    <div class="avatar">
<img src="{{Auth::user()->thumbnail}}" alt="">
    </div>
    <div class="user-name">
<span>{{Auth::user()->first_name}}{{Auth::user()->last_name}}</span>
<div class="status">
<i class="fa fa-circle-dot"></i> 
@lang('client-header.status')
</div>
    </div>
    <div class="log-out">
        <a id="log-out" href="{{route('logout')}}"><i class="fa fa-right-from-bracket"></i></a>
    </div>
</div>   
@else
<div class="user-infor">
<div class="login">
    <a href="/register">@lang('client-header.sign-in')</a> / <a href="/login">@lang('client-header.sign-up')</a>
</div>
</div>
   @endif
    </div>
</div>
</div>
@if (isset($categories))
<div class="category">
    <ul>
 @foreach ($categories as $item)
 <li onclick="searchCategory({{$item->id}})">
  {{$item->name}}
</li>
 @endforeach
 <li onclick="searchCategory()">
    @lang('client-header.all')
  </li>
  @if (Auth::user() !=null)
  <li>
      <a href="{{route('client.post.my.get',["userid"=>Auth::user()->id])}}">
             @lang('client-header.my-post')
      </a>
  </li>
  @endif
  @can('list-post-admin')
  <li>
    <a href="{{route('admin.post.list')}}">
          @lang('client-header.admin-client')
    </a>
</li>
  @endcan
    </ul>
</div>   
@endif
<div class="menu-filter">

</div>
@include('js.ClientHeader')
@include('js.lang')