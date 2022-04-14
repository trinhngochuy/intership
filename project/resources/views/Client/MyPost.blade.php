@extends('_Layout.ClientLayout')
@section('style')
<link rel="stylesheet" href="\PhpDemo\Client\upPost.css"/>
@endsection
@section('body')
    <div class="container">
        <div class="back">
            <a href="{{route('client.posts')}}">
   <i class="fa fa-angle-left"></i>
            </a>
        </div>
<div class="my-post">
    <div class="post-show">
        <div class="show">
            <div class="add-post">
                <a href="{{route('client.post.create.get')}}">
                    <i class="fa fa-plus"></i>
                  Add
                </a>
            </div>
            <div class="title">
                <h1>My Posts</h1>
            </div>
        </div>
        <div class="posts">
@include('Client.PartalView.search')

        </div>
    </div>
<div class="filter">
    <div class="title">          
        <h1>My Filter</h1>
    </div>
    <div class="this-filter">          
     <div class="filter-group">
         <span>Search: </span>
         <input name="search" type="text">
     </div>
     <div class="filter-group">
        <span>Start Date: </span>
        <input autocomplete="off" name="start" class="datepicker" type="text">
    </div>
    <div class="filter-group">
        <span>End Date: </span>
        <input autocomplete="off" name="end" class="datepicker" type="text">
    </div>
    <div class="filter-group">
        <span>Categories: </span>
 <select name="category" id="">
@foreach ($categories_filter as $category)
<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
<option value="" selected>All</option>
 </select>
    </div>
    </div>
</div>
</div>

    </div>
@endsection
@section('scripts')
<script>
      $(".datepicker").datepicker();
  </script>
  @include('js.MyPost')
@endsection
