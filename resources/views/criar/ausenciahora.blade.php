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
                        {!! Form::text('area',$users[0]->name,['class'=>'form-control','readonly']) !!}
                        <input id="fk_tecnico" name="fk_tecnico" type="hidden" value={{$users[0]->id}}>
                        {!! $errors->first('fk_tecnico','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('fk_ausencia','Descrição da Ausência (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('area',$justificacao[0]->descricao,['class'=>'form-control','readonly']) !!}
                        <input id="fk_ausencia" name="fk_ausencia" type="hidden" value={{$justificacao[0]->pk_justificacao}}>
                        {!! $errors->first('fk_ausencia','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('start_date','Início (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('start_date',$request->start_date,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required','readonly']) !!}
                        {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('time_start','Hora de Início (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('time_start',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('time_start','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('end_date','Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('end_date',$request->end_date,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required','readonly']) !!}
                        {!! $errors->first('end_date','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('time_end','Hora de Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('time_end',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('time_end','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
      </div>
      <div class="box-footer ">
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
      </div>
      {!! Form::close()!!}
</div>
@stop
