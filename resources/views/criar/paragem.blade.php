@extends('adminlte::page')
@section('Paragem', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM DIA DE PARAGEM</h3>
            </div>
            {!! Form::open(array('route' => 'paragem.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('descricao','Descrição (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('descricao',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                              {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('dia','Dia (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('dia',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                              {!! $errors->first('dia','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('fk_ausencia','Ausência (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('fk_ausencia', $justificacoes ,null,array('class' => 'form-control', 'id'=>'justificacao', 'placeholder' => 'Escolha o tipo de dia' ,'required'=>'required')) !!}
                              {!! $errors->first('fk_ausencia','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
