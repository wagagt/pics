<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Clasificados</title>
    @section('style')
    <!-- ************************ Section Styles (*.css ) *************** -->
        <!-- Bootstrap Core CSS -->
        <link href="/ui/sb/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="/ui/sb/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="/ui/sb/dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="/ui/sb/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom Classifieds styles-->
        <link href="/ui/css/classifieds-style.css" rel="stylesheet" type="text/css">
        <!-- Custom Swiper style -->
        <link href="/ui/css/swiper.min.css" rel="stylesheet" type="text/css">
    @show
        

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
    <div id="wrapper">
        @include('pagelets.main.navigation')
        @yield('content')
    </div>
    
    <!-- /#wrapper -->
    @section('footer')
        <!-- ************************ Script Footer (*.js ) *************** -->
        <!-- jQuery -->
        <script src="/ui/sb/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="/ui/sb/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="/ui/sb/metisMenu/dist/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="/ui/sb/dist/js/sb-admin-2.js"></script>
        <!-- Dashboard Jquery HCaptions Plugin-->
        <script src="/ui/js/jquery.hcaptions.js"></script>
        <!-- Swipper jquery pluging-->
        <script src="/ui/js/swiper.jquery.min.js"></script>
    @show

</body>
</html>
