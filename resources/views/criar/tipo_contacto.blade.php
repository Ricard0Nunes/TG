@extends('adminlte::page')
@section('Cliente', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UM TIPO DE CONTACTO</h3>
      </div>
      {!! Form::open(array('route' => 'store.tipocontacto','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
      <div class="box-body">
            <div class="col-xs-12 col-sm-12 col-md-1" >
            </div>
          
            <div class="form-group">
               {!! Form::label('tipoContacto','Tipo de contacto (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('tipoContacto',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('tipoContacto','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>

      </div>
      <div class="box-footer">
         <div class="col-xs-12 col-sm-12 col-md-18" >
            <button type="submit" class="btn btn-success pull-right">Enviar</button>

            <div class="col-xs-12 col-sm-12 col-md-11" >
               <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                  Voltar</button></a>
   
            </div>
         </div>
        
      </div>
</div>

<br>

{!! Form::close()!!}
@stop
