<meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
@import url(http://fonts.googleapis.com/css?family=Lato:300);


body
{
    margin: 0;
    padding: 0;
    font-family: 'Lato' , sans-serif;
    color: #333;
    background-size: 100%;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    background-color: #475264;
}
p
{
    margin: 0;
    padding: 0 0 10px 0;
    line-height: 20px;
}
.span4
{
    width: 80px;
    float: left;
    margin: 0 8px 10px 10px;
}

.phone
{
    margin-top: 15px;
    background: #fff;
}
.tel
{
    margin-bottom: 10px;
    margin-top: 10px;
    border: 1px solid #9e9e9e;
    border-radius: 0px;
}
.num-pad
{
    padding-left: 15px;
}


.num
{
    border: 1px solid #9e9e9e;
    -webkit-border-radius: 999px;
    border-radius: 999px;
    -moz-border-radius: 999px;
    height: 80px;
    background-color: #fff;
    color: #333;
    cursor: pointer;
}
.num:hover
{
    background-color: #9e9e9e;
    color: #fff;
    transition-property: background-color .2s linear 0s;
    -moz-transition: background-color .2s linear 0s;
    -webkit-transition: background-color .2s linear 0s;
    -o-transition: background-color .2s linear 0s;
}
.txt
{
    font-size: 30px;
    text-align: center;
    margin-top: 15px;
    font-family: 'Lato' , sans-serif;
    line-height: 30px;
    color: #333;
}
.small
{
    font-size: 15px;
}

.btn
{
    font-weight: bold;
    -webkit-transition: .1s ease-in background-color;
    -webkit-font-smoothing: antialiased;
    letter-spacing: 1px;
}
.btn:hover
{
    transition-property: background-color .2s linear 0s;
    -moz-transition: background-color .2s linear 0s;
    -webkit-transition: background-color .2s linear 0s;
    -o-transition: background-color .2s linear 0s;
}
.spanicons
{
    width: 72px;
    float: left;
    text-align: center;
    margin-top: 40px;
    color: #9e9e9e;
    font-size: 30px;
    cursor: pointer;
}
.spanicons:hover
{
    color: #3498db;
    transition-property: color .2s linear 0s;
    -moz-transition: color .2s linear 0s;
    -webkit-transition: color .2s linear 0s;
    -o-transition: color .2s linear 0s;
}
.active
{
    color: #3498db;
}
</style>
<script>
$(document).ready(function () {

$('.num').click(function () {
    var num = $(this);
    var text = $.trim(num.find('.txt').clone().children().remove().end().text());
    var telNumber = $('#telNumber');
    $(telNumber).val(telNumber.val() + text);
});

});</script>
<div class="container">
      <!--Carousel-->
     
            {!! Form::open(array('route' => 'ponto.picar', 'method'=>'POST','files'=>'true')) !!}

            <div class="row">
                    <div class=" col-md-3  col-sm-2">
                    {{-- <img src="{{$empresa[0]->logo}}" alt="" srcset=""> --}}
                        </div>
                <div class=" col-md-6  col-sm-8 phone">
                   
                    <div class="num-pad">
                            <div class="row">
                                    <div class="col-md-12 col-sm-12" style="margin:8px 8px 10px 0px;">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12" >
                                        <a href="{{ url('picar') }}"><img src="{{$empresa[0]->logo}}" alt="" srcset="" style="height:20%; padding-left:8%"></a>
                                            </div>
                                        </div>
                                           
                                            @if(Session::has('success'))
                                            <div class="alert alert-success">
                                                  {{ Session::get('success')}}
                                            </div>
                                            <script>setTimeout(function(){window.location.reload(1);}, 10000);</script>
                                                  @elseif( Session::has('pin'))
                                                  <div class="alert alert-danger">
                                                              {{ Session::get('pin')}}
                                                        </div>
                                                        <script>setTimeout(function(){window.location.reload(1);}, 10000);</script>
                                                 @endif 
                                       
                              
                                    <input type="password" name="pin" id="telNumber" class=" form-control tel"  value="" style="margin:0 10px 14px 0px; border:none !important; text-align:center;"/>
                                   
                                    </div>
                                </div>
                    <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        1
                                    </div>
                                </div>
                            </div>
                            </div>
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        2 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        3 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        4
                                    </div>
                                </div>
                            </div>
                            </div>
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        5
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        6
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        7
                                    </div>
                                </div>
                            </div>
                            </div>
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        8 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                       9
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4 col-sm -4">
                                <div class="span4">
                                    <div class="num" style="background-color:#40a431">
                                        <div class="txt" >
                                            <a href="{{ url('picarCalendario') }}" >
                                 
                                            <i class="fa fa-calendar" style="font-size:40px;padding-top:5%; color:white"></i>
                                           </a>
                                        </div>
                                    </div>
                                   
                            </div>
                            </div>
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="span4">
                                <div class="num">
                                    <div class="txt">
                                        0 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="span4">
                                <div class="num" style="background-color:#40a431">
                                    <div class="txt" >
                                        <a type="submit"onclick="$(this).closest('form').submit()" class="" 
                                        style="background-color:transparent!important;border-color:transparent!important;">
                                                        <i class="fa fa-check" style="font-size:40px;padding-top:5%;
                                            color:white"></i>
                                        </a>
                                    </div>
                                </div>
                              
                            
                            </div>
                        </div>
                    </div>
                            {{-- <div class="clearfix">
                            </div> --}}
                            <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                       
                                    
                                      
                                                <div class="container-login100">
                                                    <div class="wrap-login100 pull-right">
                                                            <div class="bg-form"></div>
                                                                <div class="login-logo" style="">
                                                                <small> <strong> {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</strong>  Powered by @<strong>TurtleDestiny</strong></small> 
                                                                </div>
                                                    </div>
                                                </div>
                                <br><br>  <br>
                                    </div>
                            </div>
              

 
       
</div>
                </div>
            </div>

{!! Form::close()!!}

