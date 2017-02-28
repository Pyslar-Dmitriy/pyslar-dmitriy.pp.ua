<!DOCTYPE HTML>

<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="/css/bootstrap.min.css?t=<?php echo(microtime(true)); ?>">
    <link rel="stylesheet" href="/css/style.css?t=<?php echo(microtime(true)); ?>">
    <link rel="shortcut icon" type="image/x-icon" {{asset('/favicon.ico')}}>

    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <title>Дмитрий пысларь - @yield('title')</title>

</head>

<body>

@include('.common.header')

@include('.auth.register')
@include('.auth.login')

@yield('content')

@include('.common.footer')

</body>

</html>