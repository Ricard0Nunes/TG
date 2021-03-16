@extends('adminlte::page')
@section('Licenciamento', 'AdminLTE')
@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<style>
    #licenciamento{
        text-align: center;
    }
</style>
<div class="box box-success" id="licenciamento">
    <div class="box-header with-border">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <img src="http://turtlegest.com/logo.png" alt="">
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
       Turtlegest Copyright {{carbon\carbon::now()->format('Y')}}. Todos os direitos reservados.
       <br>
       Produto licenciado a:
       <br><br>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <p><strong>{{$empresalicenciamento[0]->nomeCompleto}}</strong></p>
        <p>{{$empresalicenciamento[0]->morada}}</p>
        <p>NIF:{{$empresalicenciamento[0]->NIF}}</p>
        <p>Contacto:{{$empresalicenciamento[0]->contacto}}</p>
        <p>Email:{{$empresalicenciamento[0]->email}}</p>

    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

<br><br>
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
@if (count($licenciamento)<1)
{!! Form::open(array('route' => ['introduzirsn','nif'=>$empresalicenciamento[0]->NIF],'method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                            
                            
{!! Form::label('sn','Introduza o Nº de série da licença:',['class'=>'col-sm-12 control-label']) !!}
<div class="col-sm-12">
    {!! Form::text('sn',null,['class'=>'form-control','rows' =>'1', 'cols'=>'1']) !!}
 
    <button type="submit" class="btn btn-success pull-right ">Enviar</button>
</div>
{!! Form::close()!!}

@else
Número de Série:       {{$licenciamento[0]->sn}}

@endif

       

    </div>
    <div class="col-md-4"></div>
</div>
    </div>
</div>
@endsection