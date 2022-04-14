<!DOCTYPE html>
<html>
<head>
@include('Header.HeaderAdmin.Head')
</head>
<body>
@include('_Layout.AdminHeader')
    <div class="container body-content">
        @yield('body')
    </div>
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
@include('Js.AdminJs')
@yield('scripts')
</body>
</html>
