@include('_Layout.lang-view')
<div class="main-top">
    <div class="Menutop">
        <ul>
            <li class="list active">
                <a href='{{route("admin.post.list")}}'>
                    <span class="icon"><i class="fa-solid fa-house"></i></span>
                    <span class="text">@lang('admin-header.home')</span>
                </a>
            </li>
            <li class="list">
                <a href='{{route("admin.get.list.user")}}'>
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="text">@lang('admin-header.users')</span>
                </a>
            </li>
            <li class="list">
                <a href='{{route("admin.post.update_category.get")}}'>
                    <span class="icon"><i class="fa-solid fa-bag-shopping"></i></span>
                    <span class="text">@lang('admin-header.categories')</span>
                </a>
            </li>
<li class="list">
    <a href='{{route("client.posts")}}'>
        <span class="icon"><i class="fa-solid fa-bomb"></i></span>
        <span class="text">@lang('admin-header.client')</span>
    </a>
</li>
<li class="list">
    <a href='{{route("logout")}}' onclick="return confirm('Logout?')">
        <span class="icon"><i class="fa-solid fa-arrow-right-to-bracket"></i></span>
        <span class="text">@lang('admin-header.logout')</span>
    </a>
</li>
            <div class="indicator"></div>
        </ul>
    </div>
            </div>