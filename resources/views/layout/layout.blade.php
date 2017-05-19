<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>feimo-后台管理</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('css/bootstrap.min.css?v=3.3.6') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=4.1.0') }}" rel="stylesheet">
    <link href="{{ asset('js/jquery-notifyjs/styles/metro/notify-metro.css') }}" rel="stylesheet" />

</head>

<body class="gray-bg">
@include('layout/message')
@yield('content')
</body>
</html>