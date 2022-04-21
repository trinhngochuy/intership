<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>

  .jumbotron{
    background: rgb(233, 222, 222);
    padding: 50px;
    text-align: center
  }
  body{
    font-family:Verdana, Geneva, Tahoma, sans-serif;
  }
  .container .row{
    text-align: center;
    width: 25%;
    margin: 20px auto;
    padding: 30px;
    background: rgb(233, 222, 222);
    box-shadow: black 0px 7px 10px 0px
  }
  .well img{
border-radius: 100%;
width: 100px;
height: 100px;
  }
  .new-post{
    margin-top: 40px;
    width: 100%;
    height: 100%;
    position: relative;
  }
  .new-post img{
    object-fit: cover;
    width: 100%;
    height:260px;
  }
  .new-post span{
    width: 100%;
    opacity: 0.9;
    height: 70px;
    background: rgb(48 48 48 / 70%);
    box-shadow: rgb(50 48 48) 0px 7px 1cm 0px;
    position: absolute;
    padding-top: 10px;
    top: 70%;
    left: 50%;
    transform: translateX(-50%);
    color: white;
  }
  @media screen and (max-width: 900px) {
  .container .row{
    width: 70%;
  }
}
</style>
</head>
<body>
    <div class="jumbotron text-center" style="border-top: 5px solid deeppink">
        <h2>Bạn vừa tạo thành công một bài viết mới ✔</h2>
        <p>vào lúc {{now()}}</p>
      </div>
      <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
          <div class="col-sm-4 well">
            <h3>{{$user->user_name}}</h3>
            <img src="{{$user->thumbnail}}" class="img-circle" alt="Cinque Terre" style="object-fit: cover" width="204" height="204"> 
          </div>
            <div class="col-sm-4"></div>
            <div class="new-post">
              <a href="http://project.test:90/client/user/posts/detail/{{$post->slug}}" class="post">
                <img src="{{$post->thumbnail}}" alt="">
                <span>{{$post->title}}</span>
              </a>
            </div>
        </div>
      </div>
</body>
</html>