<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
<style>ul.nav li.dropdown:hover ul.dropdown-menu { display: block; }</style>
    @include('adminlte::plugins', ['type' => 'css'])

    <!-- Theme style -->
    
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
  

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="http://getbootstrap.com/2.3.2/assets/js/jquery.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-transition.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-alert.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-modal.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-dropdown.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-scrollspy.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tab.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tooltip.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-popover.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-button.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-collapse.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-carousel.js"></script> 
<script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-typeahead.js"></script>

<script>
        $(document).ready(function(){
          $('.myTip').tooltip()
        });
        </script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

 

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')

</body>
</html>
