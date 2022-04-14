@extends('_Layout.ClientLayout')
@section('style')
<link rel="stylesheet" href="\PhpDemo\Client\detail.css"  />
@endsection
@section('body')
<div class="scroll-up">
    <i class="fa fa-chevron-up"></i>
</div>
 <div class="container">
     <div class="category-top">
      <h1><a href="{{route("client.posts")}}">Home</a> - {{$post[0]->category->name}}</h1>
     </div>
     <div class="title">
        {{-- Giá iPhone cũ, mới đồng loạt giảm mạnh cuối tháng 3/2022 --}}
        {{$post[0]->title}}
     </div>
<div class="author-day">
    <div class="post-day">
        {{$post[0]->created_at}}
    </div>
    <div class="author">
        Tác giả: <strong> {{$post[0]->user->first_name}} {{$post[0]->user->last_name}}</strong>
    </div>
</div>
<div class="description">
    {{-- Tính đến gần cuối tháng 3/2022, thị trường iPhone tiếp tục ghi nhận nhiều
     tín hiệu khách quan. iPhone 13 series VN/A ghi nhận doanh số bán ra tăng 
     thêm khoảng 30%, các dòng iPhone cũ cũng tăng thêm 25% sức mua trên các
      kênh mua sắm trực tuyến --}}
      {{$post[0]->discription}}
</div>
<div class="content">
    {!! $post[0]->content !!}
</div>
<div class="post-sugest">
    <div class="title-sugest">
        related categories
    </div>
    <div class="posts">
@foreach ($posts as $item)
<div class="post">
    <a href="#">
      <div class="thumbnail-post">
          <img src="https://cdn.24h.com.vn/upload/1-2022/images/2022-03-21/dat-iphone-13-pro-max-nguoi-phu-nu-nhanchai-nuoc-rua-tay-1-usd-iphone-13-pro-max-1643957886-223-width660height439-1647881577-681-width660height439.jpg" alt="">
      </div>
      <div class="title-post">
          <strong>Giá iPhone cũ, mới đồng loạt giảm mạnh cuối tháng 3/2022</strong>
      </div>
    </a>
  </div>    
@endforeach
    </div>
</div>
 </div>
@endsection
@section('scripts')
 <script>
     let topBtn = document.querySelector(".scroll-up");
topBtn.onclick = () => window.scrollTo({ top: 0, behavior: "smooth" });</script>   
@endsection