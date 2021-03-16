<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
            @yield('title', config('adminlte.title', 'AdminLTE 2'))
            @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
            <style>
               style {
                    display: none !important;
                }
                ul{
                    list-style-type: none;
                    /* overflow-y: scroll !important; */
                }
                #checkLabel{
                    padding: 5px;
                    position: relative;
                    top: -3px;
                }
                #delete-icon{
                    background-color: transparent;
                    border:none;
                    padding: 5px;
                    position: relative;
                    top: -3px;
                }
                #li2{
                    margin: -10px;
                    background-color:#f4f4f4;
                    padding-left:10px;
                    padding-top:10px;
                }
                #li2:hover{
                    background-color: #cbcbcb;
                }
                body{
                    background-color:#222d32 !important;
                }
                .skin-green .main-sidebar {
                    /* position:fixed; */
                    /* position: fixed;  Fix da barra branca mas depois não deixa dar scroll no menu*/
                } 
                ul.nav li.dropdown:hover ul.dropdown-menu { display: block; }
                
            </style>
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
            @include('adminlte::plugins', ['type' => 'css'])        
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
            @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
  
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
{{-- <body oncontextmenu="return false" class="hold-transition @yield('body_class')" 
@yield('body') --}}
{{-- ^Dá Disable no botão direito, copiar e colar por cima da que está em baixo^ --}}
<body class="hold-transition @yield('body_class')" 
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

<script type="text/javascript">
// $(document).ready(function() {
   
     
//     $('table.table').DataTable( {
//         ajax:           '../ajax/data/arrays.txt',
//         scrollY:        200,
//         scrollCollapse: true,
//         paging:         false
//     } );
 
//     // Apply a search to the second table for the demo
//     $('#myTable2').DataTable().search( 'New York' ).draw();
// } );
  $(document).ready(function() {
      $('#example').dataTable( {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
          "language": {
              "url": "js/localeDataTable.js"
          },
          "scrollX": true,
          "autoWidth":true,
      

      } );
      $('#example').DataTable().draw();
  } );
  
 
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#msg').dataTable( {
            "language": {
                "url": "js/localeDataTable.js"
            },
            "scrollX": true,
            "autoWidth":false,
          "paging":   false,
          "ordering": false,
          "info":     false
  
        } );
    } );
    
   
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#a').dataTable( {
            "language": {
                "url": "js/localeDataTable.js"
            },
            "scrollX": true,
            "autoWidth":false,
          "paging":   false,
          "ordering": true,
          "info":     false
          "aaSorting": [[ 0, "desc" ]],
        } );
    } );
    
   
  </script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#example2').dataTable( {
        $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
          "language": {
              "url": "js/localeDataTable.js"
          },
          "scrollX": true,
      } );
      $('#example2').DataTable().draw();
  } );
</script>

<script>
        $(document).ready(function(){
          $('.myTip').tooltip()
        });
        </script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script>
function toggleFullScreen() {

if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
 $scope.topMenuData.showSmall = true;
    if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    }
} else {

      $scope.topMenuData.showSmall = false;
    if (document.cancelFullScreen) {
        document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
    }
}
}
</script>

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')

</body>
</html>
