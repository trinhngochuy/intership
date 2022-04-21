<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="\PhpDemo\AccountCss\Register.css">
    <link rel="stylesheet" href="\PhpDemo\TranLang\lang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <title>@lang('client.register')</title>
</head>
<body>
    
    <div class="alert" style="display: none" id="massage">
    </div>
@include('_Layout.lang-view')
<div class="title-container">
    <h1>@lang('client.register')</h1>
</div>
<div class="container">
    <div class="Login-form">
<div class="thumbnail">
    <div class="image">
        <img id="thumbnail_image" src="..\user.img\defaul\default-thumbnail.png" alt="">
    </div>
    </div>
    <form id="target" action="/register" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" style="display: none" onchange="previewFile()" name="image" accept="image/x-png,image/jpeg,application/pdf">
        <div class="form-group">
          <div class="lable-name">
            <span>@lang('client.first-name'):</span>
          </div>
            <input type="text"  name="first_name">
        </div>
        <div class="form-group">
            <div class="lable-name">
            <span>@lang('client.last-name'):</span>
            </div>
            <input type="text" name="last_name">
        </div>
        <div class="form-group">
            <div class="lable-name">
                <span>@lang('client.email'):</span>
                </div>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <div class="lable-name">
                    <span>@lang('client.user-name'):</span>
                </div>
            <input type="text" name="user_name">
        </div>
        <div class="form-group">
            <div class="lable-name">
                <span>@lang('client.password'):</span>
            </div>
            <input id="password" type="password" name="password">
        </div>
        <div class="form-group">
            <div class="lable-name">
                <span>@lang('client.confirm-password'):</span>
            </div>
            <input type="password" name="confirm_password">
        </div>
        <div class="form-group">
            <div class="lable-name">
                <span>@lang('client.date'):</span>
            </div>
           <input type="text" name="birthday"  id="datepicker">
        </div>
        </form>

        </div>
      <div class="button">
        <span>@lang('client.suggest-re') <a href="/login">@lang('client.click-here')</a> @lang('client.to-login')</span>
        <input type="button" name="submit" value="@lang('client.register')">
      </div>
</div>
@include('js.AccountRegister')
@include('js.lang')
</body>
</html>
