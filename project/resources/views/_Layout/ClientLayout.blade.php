<!DOCTYPE html>
<html>
<head>
@include('Header.HeaderClient.Head')
</head>
<body>
@include('_Layout.ClientHeader')
<div class="body-container">
    <div class="container body-content">
        @yield('body')
    </div>
</div>
<div class="footer">
    @include('_Layout.footerClient')
</div>
@include('Js.AdminJs')
@yield('scripts')
</body>
</html>
