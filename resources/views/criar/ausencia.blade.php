@extends('adminlte::page')
@section('Cargos', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UMA AUSÊNCIA</h3>
      </div>
      {!! Form::open(array('route' => 'ausencia.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('fk_tecnico','Colaborador (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_tecnico', $users ,null,array('class' => 'form-control', 'id'=>'users', 'placeholder' => 'Escolha o Colaborador','required'=>'required' )) !!}
                        {!! $errors->first('fk_tecnico','<p class="alert alert-danger">:message</p>')!!}
                        <input id="pediuhoras" name="pediuhoras" type="hidden" value=false>
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('fk_ausencia','Descrição da Ausência (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_ausencia', $justificacoes ,null,array('class' => 'form-control', 'id'=>'justificacao', 'placeholder' => 'Escolha a Ausência' ,'required'=>'required')) !!}
                        {!! $errors->first('fk_ausencia','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('start_date','Início (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('start_date',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('end_date','Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('end_date',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('end_date','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
      </div>
      <div class="box-footer ">
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
      </div>
      {!! Form::close()!!}
</div>
@stop
