@extends('adminlte::page')
@section('Cliente', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">REQUISITAR UMA SALA</h3>
      </div>
      {!! Form::open(array('route' => 'requisicaosala.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
            <div class="form-group">
                  {!! Form::label('requisitante','Requisitante* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::select('requisitadoPor', $user,null,array('class' => 'form-control', 'id'=>'requisitadoPor','required'=>'required', 'placeholder' => 'Escolha o Requisitante' )) !!}
                        {!! $errors->first('requisitadoPor','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('fk_sala','Sala* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_sala', $sala,null,array('class' => 'form-control', 'id'=>'fk_sala','required'=>'required', 'placeholder' => 'Escolha a Sala' )) !!}
                        {!! $errors->first('fk_sala','<p class="alert alert-danger">:message</p>')!!}
                  </div>
                  
            </div>
            <div class="form-group">
                  {!! Form::label('data','Data * :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::date('data',null,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('data','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horaInicio','Hora Início *:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::time('horaInicio',null,['class'=>'form-control','rows'=>4]) !!}
                        {!! $errors->first('horaInicio','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horaFim','Hora Fim *:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::time('horaFim',null,['class'=>'form-control','rows'=>4]) !!}
                        {!! $errors->first('horaFim','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('observacoes','Observações:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::text('observacoes',null,['class'=>'form-control','rows'=>4]) !!}
                        {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
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
      {!! Form::close()!!}
</div>
@stop
