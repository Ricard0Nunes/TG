<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Turtlegest>>Criar Empresa</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script></head>
<body>
<style>body {
        font-family: 'Montserrat', sans-serif;
        text-align: center;
        /* background-image: url('Faro.jpg'); */
      }
      
      div {
        display: inline-block;
      }
      
      .bigger {
        margin: 0;
        font-size: 60px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #202020;
        display: inline-block;
        position: relative;
      }
      .bigger2 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #767676;
        display: inline-block;
        position: relative;
      }
      .bigger3 {
        margin: 0;
        font-size: 15px;
        font-weight: 800;
        padding: 20px;
        text-transform: uppercase;
        color: #767676;
        display: inline-block;
        position: relative;
      }
      .botao {
        margin: 0;
        /* font-size: 60px;
        font-weight: 800; */
        /* padding: 20px; */
        text-transform: uppercase;
        color: #202020;
        display: inline-block;
        position: relative;
      }
      .text {
        max-width: 600px;
        width: 100%;
        line-height: 24px;
        text-align: left;
        color: #404040;
        padding: 20px;
      }
      .text.txt-center {
        text-align: center;
      }
      .text a {
        color: #0fe4d2;
      }
      
      .has-animation {
        position: relative;
      }
      .has-animation p, .has-animation img {
        opacity: 0;
      }
      .has-animation.animate-in p, .has-animation.animate-in img {
        animation: textHidden 0.1s 1.1s forwards;
      }
      .has-animation.animate-in:before, .has-animation.animate-in:after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        z-index: 10;
      }
      .has-animation.animate-in:before {
        background-color: #307a25;
      }
      .has-animation.animate-in:after {
        background-color: #40a431;
        animation-delay: .5s;
      }
      .has-animation.animation-ltr.animate-in:before {
        animation: revealLTR 1.8s ease;
      }
      .has-animation.animation-ltr.animate-in:after {
        animation: revealLTR 1s .6s ease;
      }
      .has-animation.animation-rtl.animate-in:before {
        animation: revealRTL 1.8s ease;
      }
      .has-animation.animation-rtl.animate-in:after {
        animation: revealRTL 1s .6s ease;
      }
      
      @keyframes revealRTL {
        0% {
          width: 0;
          right: 0;
        }
        65% {
          width: 100%;
          right: 0;
        }
        100% {
          width: 0;
          right: 100%;
        }
      }
      @keyframes revealLTR {
        0% {
          width: 0;
          left: 0;
        }
        65% {
          width: 100%;
          left: 0;
        }
        100% {
          width: 0;
          left: 100%;
        }
      }
      @keyframes textHidden {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }
      </style>
        <!------ Include the above in your HEAD tag ---------->
        
        <br>
        {{-- <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;"> --}}
        <div class="has-animation animation-ltr" style="background-color:#cfcfcf" data-delay="10">
          <p class="bigger" >TurtleGest</p>
        </div>
        
        <br><br>
        
        {!! Form::open(array('route' => 'empresa.storeSetup','method'=>'POST','files'=>'true')) !!}
<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
            @if(Session::has('success'))
      <div class="alert alert-success">
            {{ Session::get('success')}}
      </div>
            @elseif( Session::has('warning'))
            <div class="alert alert-danger">
                        {{ Session::get('warning')}}
                  </div>
           @endif 
      </div>
</div>
<div class="has-animation animation-rtl" data-delay="2000">
        <p class="bigger3">
            Vamos criar a sua empresa <br> Insira os dados da mesma <br>
        </p>
         </div>
<br>
<br>
      <div class="form-group">
            {!! Form::label('logo','Lógotipo:') !!}
<br>
            <div class="">
                  {!! Form::file('logo',null,['class'=>'form-control']) !!}
                  {!! $errors->first('logo','<p class="alert alert-danger">:message</p>')!!}

            </div>
      </div>
<br>


      <div class="form-group">
            {!! Form::label('NISS','NISS* :') !!}<br>
            <div class="">
                  {!! Form::text('NISS',null, ['class' => 'form-control']) !!} 
                  {!! $errors->first('NISS','<p class="alert alert-danger">:message</p>')!!}
                       
            </div>
      </div>
      <br>
      <div class="form-group">
            {!! Form::label('NIF','NIF* :') !!}<br>
            <div class="">
                  {!! Form::text('NIF',null, ['class' => 'form-control']) !!} 
                  {!! $errors->first('NIF','<p class="alert alert-danger">:message</p>')!!}
                       
            </div>
      </div>

      <br>


{{-- ROW 2 --}}



    <div class="form-group">
          {!! Form::label('nomeCompleto','Nome Completo* :') !!}<br>

          <div class="">
                {!! Form::text('nomeCompleto',null,['class'=>'form-control']) !!}
                {!! $errors->first('nomeCompleto','<p class="alert alert-danger">:message</p>')!!}

          </div>
    </div>

    <br>

    <div class="form-group">
          {!! Form::label('nomeAbreviado','Nome Abreviado* :') !!}<br>
          <div class="">
                {!! Form::text('nomeAbreviado',null, ['class' => 'form-control']) !!} 
                {!! $errors->first('nomeAbreviado','<p class="alert alert-danger">:message</p>')!!}
                     
          </div>
    </div>

    <br>
    <div class="form-group">
          {!! Form::label('email','Email* :') !!}<br>
          <div class="">
                {!! Form::text('email',null, ['class' => 'form-control']) !!} 
                {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
                     
          </div>
    </div>

    <br>


        <div class="form-group">
              {!! Form::label('morada','Morada* :') !!}<br>
              <div class="">
                    {!! Form::text('morada',null, ['class' => 'form-control']) !!} 
                    {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
                         
              </div>
        </div>

        <br>
        <div class="form-group">
              {!! Form::label('contacto','Telefone* :') !!}<br>
              <div class="">
                    {!! Form::text('contacto',null, ['class' => 'form-control']) !!} 
                    {!! $errors->first('contacto','<p class="alert alert-danger">:message</p>')!!}
                    <div class="hidden" style="display:none;"> 
                         <input type="number"  name="visivel" value="1">
                        </div>
              </div>
        </div>

{{-- ROW 4 --}}


<br>


        <div class="form-group">
              {!! Form::label('horarioAbertura','Horário de Abertura* :') !!}<br>
    
              <div class="">
                    {!! Form::time('horarioAbertura',null,['class'=>'form-control']) !!}
                    {!! $errors->first('horarioAbertura','<p class="alert alert-danger">:message</p>')!!}
    
              </div>
        </div>
        <br>
    

        <div class="form-group">
              {!! Form::label('horarioFecho','Horário de Fecho* :') !!}<br>
              <div class="">
                    {!! Form::time('horarioFecho',null, ['class' => 'form-control']) !!} 
                    {!! $errors->first('horarioFecho','<p class="alert alert-danger">:message</p>')!!}
                         
              </div>
        </div>
        <br>

   
        <br>
 

{{-- <div class="col-xs-1 col-sm-1 col-md-1 text-center pull-right"> &nbsp; <br>
  {!! Form::submit('Add Event', ['class'=>'btn btn-success']) !!}
      
</div> --}}

<div class="has-animation animation-ltr" data-delay="20000">
        <p class="botao">   <button class="btn " type="submit" style="background-color:#40a431; border:1px solid black; color:white;">Guardar</button></p>

</div>
{!! Form::close()!!}
</div>
</body>
<script>$(document).ready(function() {
        $('.has-animation').each(function(index) {
          $(this).delay($(this).data('delay')).queue(function(){
            $(this).addClass('animate-in');
          });
        });
      });
      </script>
</html>