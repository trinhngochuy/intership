@extends('_Layout.AdminLayout')
@section('style')
    {{-- <link rel="stylesheet" href="\PhpDemo\AdminCss\List.css"> --}}
    <link rel="stylesheet" href="\PhpDemo\AdminCss\ListUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
@section('body')
<div class="container">
    @if ($errors->any())
        <div class="test">
            <div class="close-error">
                <i class="fa-solid fa-x"></i>
            </div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        @if (session('error'))
        <i class="fa fa-circle-exclamation"></i> 
        @else
        <i class="fa fa-circle-check success"></i>
        @endif
    </div>
@endif
<div id="ex1" class="modal">
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" style="display: none" onchange="previewFile()" name="image" accept="image/x-png,image/jpeg,application/pdf">
    <div class="form-create">
        <div class="thumbnail">
            <img id="thumbnail_image" src="https://i.pinimg.com/236x/bb/2e/91/bb2e911c44ac2e95ce2fffad7a109e2d.jpg" alt="">
        </div>
        <div class="first-last">
            <div class="form-group">
                <input type="hidden"value="" name="user_id" >
                <input type="text" placeholder="First Name" name="first_name">
            </div>
            <div class="form-group">
                <input type="text"  placeholder="Last Name" name="last_name">
            </div>
        </div>
        <div class="first-last">
            <div class="form-group">
                <input type="text" placeholder="User Name" name="user_name">
            </div>
            <div class="form-group">
                <input type="password"  placeholder="Password" name="password">
            </div>
        </div>
        <div class="first-last">
            <div class="form-group">
                <input type="email" placeholder="Email" name="email">
            </div>
            <div class="form-group">
                <input type="password" name="config_password" placeholder="Config Password">
            </div>
        </div>
        <div class="first-last">
            <div class="form-group">
                <input  type="text" autocomplete="off" max="{{now()}}" id="datepicker" placeholder="Birth Day" name="birthday">
            </div>
        </div>
        <div class="roles">
            <div class="title">
                ROLES
            </div>
        <div class="chose-role">
            <div class="role">
                <span>Admin</span>
                <input type="checkbox" name="role_admin" value="2">
            </div>
            <div class="role">
                <span>User</span>
                <input type="checkbox" name="role_user" value="1">
            </div>
        </div>
        </div>
            </div>
            <div class="create-buttom">
                <button class="submit" type="submit"></button>
            </div>
</form>
  </div>
  
  <!-- Link to open the modal -->
    <div class="main">
        <div id="data">
        @include('ListUser.ListUserSearch')
    </div>
        <div class="search-box">
            <span>Search: </span>
            <input class="search-input" id="Search" name="key" type="text" value="" />
        </div>
        {{-- <div class="action-box">
            <select>
                <option value="0">1</option>
                <option value="1" selected>Action</option>
            </select>
        </div> --}}
        <a href="#ex1" rel="modal:open">
    <div class="action-add">
        <span><i class="fa-solid fa-user-plus"></i>Add New User</span>
          </div>
   </a>
    </div>
</div>

@endsection
@section('scripts')
@include('Js.list-user')
@endsection