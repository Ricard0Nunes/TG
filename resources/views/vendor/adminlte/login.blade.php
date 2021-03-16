
@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop
<div class="hidden" style="display:none!important;">
  {{$css = rand(1,5)}}
  
</div>
<script
			  src="https://code.jquery.com/jquery-3.4.1.js"
			  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
			  crossorigin="anonymous"></script>
@if($css==1)

<script>
  $(document).ready(function () {
    $('#bg').css('background-image', 'url(' + 'Faro.jpg' + ')');
});

  </script>
  @elseif($css==2)
  <script>
    $(document).ready(function () {
      $('#bg').css('background-image', 'url(' + 'Setubal.JPG' + ')');
  });
  
    </script>
@elseif($css==3)
<script>
  $(document).ready(function () {
    $('#bg').css('background-image', 'url(' + 'Arrabida1.jpg' + ')');
});

  </script>
@elseif($css==4)
<script>
  $(document).ready(function () {
    $('#bg').css('background-image', 'url(' + 'arrabida2.jpg' + ')');
});

  </script>
@elseif($css==5)
<script>
  $(document).ready(function () {
    $('#bg').css('background-image', 'url(' + 'Vasco.jpg' + ')');
});

  </script>

    @endif



<style>




/*//////////////////////////////////////////////////////////////////
[ FONT ]*/



/*//////////////////////////////////////////////////////////////////
[ RESTYLE TAG ]*/

* {
	margin: 0px; 
	padding: 0px; 
	box-sizing: border-box;
    
}

body, html {
	height: 100%;

}

/*---------------------------------------------*/
#a{

	font-size: 14px;
	line-height: 1.7;
	color: #666666;
	margin: 0px;
	transition: all 0.4s;
	-webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
}

a:focus {
	outline: none !important;
}

a:hover {
	text-decoration: none;
  color: #6675df;
}

/*---------------------------------------------*/
h1,h2,h3,h4,h5,h6 {
	margin: 0px;
}

p {
	
	font-size: 14px;
	line-height: 1.7;
	color: #666666;
	margin: 0px;
}

ul, li {
	margin: 0px;
	list-style-type: none;
}


/*---------------------------------------------*/
input {
	outline: none;
	border: none;
}

textarea {
  outline: none;
  border: none;
}

textarea:focus, input:focus {
  border-color: transparent !important;
}

input:focus::-webkit-input-placeholder { color:transparent; }
input:focus:-moz-placeholder { color:transparent; }
input:focus::-moz-placeholder { color:transparent; }
input:focus:-ms-input-placeholder { color:transparent; }

textarea:focus::-webkit-input-placeholder { color:transparent; }
textarea:focus:-moz-placeholder { color:transparent; }
textarea:focus::-moz-placeholder { color:transparent; }
textarea:focus:-ms-input-placeholder { color:transparent; }

input::-webkit-input-placeholder { color: #999999;}
input:-moz-placeholder { color: #999999;}
input::-moz-placeholder { color: #999999;}
input:-ms-input-placeholder { color: #999999;}

textarea::-webkit-input-placeholder { color: #999999;}
textarea:-moz-placeholder { color: #999999;}
textarea::-moz-placeholder { color: #999999;}
textarea:-ms-input-placeholder { color: #999999;}


label {
  display: block;
  margin: 0;
}

/*---------------------------------------------*/
button {
	outline: none !important;
	border: none;
	background: transparent;
}

button:hover {
	cursor: pointer;
}

iframe {
	border: none !important;
}

/*//////////////////////////////////////////////////////////////////
[ utility ]*/

/*==================================================================
[ Text ]*/
.txt1 {

  font-size: 13px;
  line-height: 1.4;
  color: #555555;
}

.txt2 {
 
  font-size: 13px;
  line-height: 1.4;
  color: #999999;
}


/*==================================================================
[ Size ]*/
.size1 {
  width: 355px;
  max-width: 100%;
}

.size2 {
  width: calc(100% - 43px);
}

/*==================================================================
[ Background ]*/
.bg1 {background: #3b5998;}
.bg2 {background: #1da1f2;}
.bg3 {background: #cd201f;}


/*//////////////////////////////////////////////////////////////////
[ login ]*/
.limiter {
  width: 100%;
  margin: 0 auto;
}

.container-login100 {
  width: 100%;  
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  background: #f2f2f2;
}


.wrap-login100 {
  width: 100%;
  background: #fff;
  overflow: hidden;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  align-items:flex-end;
  flex-direction: row-reverse;
  /* background-image:url('Faro.jpg'); */
}

/*==================================================================
[ login more ]*/
.login100-more {
  width: calc(100% - 560px);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
  z-index: 1;
}

.login100-more::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(0,0,0,0.1);
}



/*==================================================================
[ Form ]*/
.bg-form {
  width: 560px;
  min-height: 100vh;
  /* display: block; */
    background-color: #fff;
    opacity: 0.5;  /* padding: 173px 55px 55px 55px; */
  z-index: 0;
}
.login100-form {
  width: 560px;
  position:absolute;
  right:0;
  min-height: 100vh;
  display: inline;
z-index: 2;
  padding: 173px 55px 55px 55px;
}

.login100-form-title {
  width: 100%;
  display: block;

  font-size: 30px;
  color: #333333;
  line-height: 1.2;
  text-align: center;
}



/*------------------------------------------------------------------
[ Input ]*/

.wrap-input100 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  width: 100%;
  height: 80px;
  position: relative;
  border: 1px solid #e6e6e6;
  border-radius: 10px;
  margin-bottom: 10px;
}

.label-input100 {
  
  font-size: 18px;
  color: #999999;
  line-height: 1.2;

  display: block;
  position: absolute;
  pointer-events: none;
  width: 100%;
  padding-left: 24px;
  left: 0;
  top: 30px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input100 {
  display: block;
  width: 100%;
  opacity: .8;
  /* background: transparent; */
border-radius: 8px;
  font-size: 18px;
  color: black !important;
  line-height: 1.2;
  padding: 0 26px;
}

input.input100 {
  height: 100%;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

/*---------------------------------------------*/

.focus-input100 {
  position: absolute;
  display: block;
  width: calc(100% + 2px);
  height: calc(100% + 2px);
  top: -1px;
  left: -1px;
  pointer-events: none;
  border: 1px solid #40a431;
  border-radius: 10px;

  visibility: hidden;
  opacity: 0;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;

  -webkit-transform: scaleX(1.1) scaleY(1.3);
  -moz-transform: scaleX(1.1) scaleY(1.3);
  -ms-transform: scaleX(1.1) scaleY(1.3);
  -o-transform: scaleX(1.1) scaleY(1.3);
  transform: scaleX(1.1) scaleY(1.3);
}

.input100:focus + .focus-input100 {
  visibility: visible;
  opacity: 1;

  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
}

.eff-focus-selection {
  visibility: hidden;
  opacity: 1;

  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
}

.input100:focus {
  height: 48px;
}

.input100:focus + .focus-input100 + .label-input100 {
  top: 14px;
  font-size: 13px;
}

.has-val {
  height: 48px !important;
}

.has-val + .focus-input100 + .label-input100 {
  top: 14px;
  font-size: 13px;
}

/*==================================================================
[ Restyle Checkbox ]*/

.input-checkbox100 {
  display: none;
}

.label-checkbox100 {

  font-size: 13px;
  color: #999999;
  line-height: 1.4;

  display: block;
  position: relative;
  padding-left: 26px;
  cursor: pointer;
}

.label-checkbox100::before {
  content: "\f00c";
 
  font-size: 13px;
  color: transparent;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  width: 18px;
  height: 18px;
  border-radius: 2px;
  background: #fff;
  border: 1px solid #6675df;
  left: 0;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
}

.input-checkbox100:checked + .label-checkbox100::before {
  color: #6675df;
}


/*------------------------------------------------------------------
[ Button ]*/
.container-login100-form-btn {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.login100-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  width: 100%;
  height: 50px;
  border-radius: 10px;
  background:#40a431;


  font-size: 12px;
  color: #fff;
  line-height: 1.2;
  text-transform: uppercase;
  letter-spacing: 1px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn:hover {
  background: #333333;
}



/*------------------------------------------------------------------
[ Responsive ]*/

@media (max-width: 992px) {
  .login100-form {
    width: 50%;
    padding-left: 30px;
    padding-right: 30px;
  }

  .login100-more {
    width: 50%;
  }
}

@media (max-width: 768px) {
  .login100-form {
    width: 100%;
  }

  .login100-more {
    display: none;
  }
}

@media (max-width: 576px) {
  .login100-form {
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 70px;
  }
}


/*------------------------------------------------------------------
[ Alert validate ]*/

.validate-input {
  position: relative;
}

.alert-validate::before {
  content: attr(data-validate);
  position: absolute;
  z-index: 100;
  max-width: 70%;
  background-color: #fff;
  border: 1px solid #c80000;
  border-radius: 2px;
  padding: 4px 25px 4px 10px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 12px;
  pointer-events: none;


  color: #c80000;
  font-size: 13px;
  line-height: 1.4;
  text-align: left;

  visibility: hidden;
  opacity: 0;

  -webkit-transition: opacity 0.4s;
  -o-transition: opacity 0.4s;
  -moz-transition: opacity 0.4s;
  transition: opacity 0.4s;
}

.alert-validate::after {
  content: "\f12a";
 
  display: block;
  position: absolute;
  z-index: 110;
  color: #c80000;
  font-size: 16px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 18px;
}

.alert-validate:hover:before {
  visibility: visible;
  opacity: 1;
}

@media (max-width: 992px) {
  .alert-validate::before {
    visibility: visible;
    opacity: 1;
  }
}



/*==================================================================
[ Social ]*/
.login100-form-social-item {
  width: 36px;
  height: 36px;
  font-size: 18px;
  color: #fff;
  border-radius: 50%;
}

.login100-form-social-item:hover {
  background: #333333;
  color: #fff;
}


</style>

@section('body_class', 'login-page')

@section('body' )
<div class="limiter" >
    
    <div class="container-login100">
      {{-- <div style="  text-align: center;">
        <img src="{{DB::table('empresas')->where('pk_empresa',1)->value('logo')}}" alt="" srcset="">
        </div> --}}
        <div id="bg"class="wrap-login100 pull-right">
                <div class="bg-form"></div>
                
                <form class="login100-form validate-form" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                        {{ csrf_field() }}
                        
                    <div class="login-logo" style="font-size:50px">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
                            {{-- <div style="font-size:20!important">
                              Balanced Scorecard Edition
                              </div>  --}}

                           
                    </div>
                   
                          
                <div class="wrap-input100 validate-input {{ $errors->has('email') ? 'has-error' : '' }}" >
                    <input class="input100" type="email" name="email" placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="focus-input100"></span>
                    <span class="label-input100"></span>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                </div>
                
                
                <div class="wrap-input100 validate-input {{ $errors->has('password') ? 'has-error' : '' }}" >
                    <input class="input100" type="password" name="password" placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="focus-input100"></span>
                    <span class="label-input100"></span>
                 
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    

                    <div>
                        {{-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" id="a" class="txt1">
                                Recuperar a password                    </a>
                    </div> --}}
                </div>
               

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn" >
                            {{ trans('adminlte::adminlte.sign_in') }}
                    </button>
                </div>
                
                <br>
            
                <div class="pull-right">
                  <small> <strong>Produto Licenciado </strong>@ {{DB::table('empresas')->where('pk_empresa',1)->value('nomeCompleto')}} </small>
                  <br>
                
                </div>

            </form>

            </div>
        </div>
    </div>
</div>

    {{-- <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Seja Bem-vindo ao TurtleGest, o seu software de gestão.</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('adminlte::adminlte.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <p>
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center">
                    {{ trans('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            </p>
            @if (config('adminlte.register_url', 'register'))
                {{-- <p>
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="text-center">
                        {{ trans('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                </p> --}}
            {{-- @endif
        </div> --}}
        <!-- /.login-box-body -->
    {{-- </div><!-- /.login-box -->  --}}
@stop

@section('adminlte_js')
    @yield('js')
@stop
