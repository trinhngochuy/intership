<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="\PhpDemo\AccountCss\Login.css">
    <link rel="stylesheet" href="\PhpDemo\TranLang\lang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>@lang('client.login')</title>
</head>
<body>
    @include('_Layout.lang-view')
 <div class="alert" style="display: none" id="massage">
 

 </div>

<div class="container">
    <div class="Login-form">
    <div class="Login-icon">
        <i class="fa fa-user-large"></i>
    </div>
    <form action="#">
        @csrf
        <div class="form-group">
            <span>@lang('client.user-name'):</span>
            <input type="text" name="UserName">
        </div>
        <div class="form-group">
            <span>@lang('client.password'):</span>
            <input type="password" name="password">
        </div>
        <input type="button"  name="submit" value="Login">
       <div class="register">
        <span>@lang('client.suggest')  </span>
        <a href="/register">@lang('client.create-account')</a>
       </div>
    </form>

    </div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
@include('js.AccountLogin')
@include('js.lang')
</body>
</html>