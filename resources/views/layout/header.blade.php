<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!--<title>{!!env('APP_NAME', 'K12')!!}</title>-->
	<title>K12</title>

    <!-- Bootstrap Core CSS -->
    {!!HTML::style('/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
{{--    {!!HTML::style('/css/bootstrap.css')!!}--}}

    <!-- MetisMenu CSS -->
    {!!HTML::style('/bower_components/metisMenu/dist/metisMenu.min.css')!!}


    {!!HTML::style('/bower_components/datatables/media/css/jquery.dataTables.min.css')!!}


    <!-- Custom CSS -->
    {!!HTML::style('/css/sb-admin-2.css')!!}

    <!-- Custom Fonts -->
    {!!HTML::style('/bower_components/font-awesome/css/font-awesome.min.css')!!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


	<!-- jQuery -->
	{!! HTML::script('/bower_components/jquery/dist/jquery.min.js') !!}

	<!-- Bootstrap Core JavaScript -->
	{!!HTML::script('/bower_components/bootstrap/dist/js/bootstrap.min.js')!!}


	<!-- Metis Menu Plugin JavaScript -->
	{!!HTML::script('/bower_components/metisMenu/dist/metisMenu.min.js')!!}

    <!-- Datatables -->
	{!!HTML::script('/bower_components/datatables/media/js/jquery.datatables.min.js')!!}
{{--	{!!HTML::script('/bower_components/metisMenu/dist/metisMenu.min.js')!!}--}}

	<!-- Custom Theme JavaScript -->
	{!! HTML::script('/js/sb-admin-2.js')!!}
	{!! HTML::script('/js/jquery.countdown.min.js')!!}
	{!! HTML::script('/js/moment.js')!!}
	{!! HTML::script('/js/bootpag.min.js')!!}
    @if(Auth::user())
        @if(Auth::user()->isStudent())
            <style>
                @media(min-width:768px) {
                    #page-wrapper {
                        position: inherit;
                        margin: 0 0 0 0;
                        padding: 0 30px;
                    }
                }
            </style>
        @endif
    @endif
	@yield('head')
</head>
{{-- oncontextmenu="return false;"--}}
<body>
<!-- Page Wrapper -->
<div id="wrapper">
@include('layout.navigation')
    <div id="page-wrapper">
@include('partials.flash')