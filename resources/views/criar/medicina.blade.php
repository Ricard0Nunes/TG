@extends('adminlte::page')
@section('Exame', 'AdminLTE')
@section('content')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM EXAME MÉDICO</h3>
            </div>
            {!! Form::open(array('route' => 'medicina.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('tipoExame','Tipo de Exame (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('tipoExame',array(
                                      'Admissão' => 'Admissão',
                                      'Periódico' => 'Periódico',
                                      'Ocasional (Após Doença)' => 'Ocasional (Após Doença)',
                                      'Ocasional (Após Acidente) ' => 'Ocasional (Após Acidente) ',
                                      'Ocasional (A Pedido do Trabalhor)' => 'Ocasional (A Pedido do Trabalhor)',
                                      'Ocasional (A Pedido do Serviço) ' => 'Ocasional (A Pedido do Serviço) ',
                                      'Ocasional (Por Mudança de Função)' => 'Ocasional (Por Mudança de Função)',
                                      'Ocasional (Alterção de Condições de Trabalho) ' => 'Ocasional (Alterção de Condições de Trabalho) ',
                                      'Outro' => 'Outro',
                                    ),null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Tipo de Exame','required'=>'required']) !!}
                              {!! $errors->first('tipoExame','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('dataExame','Data do Exame (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('dataExame',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                              {!! $errors->first('dataExame','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('proxExame','Próximo Exame (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('proxExame',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                              {!! $errors->first('proxExame','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('resultado','Resultado (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('resultado',array(
                                    'Apto' => 'Apto',
                                    'Apto Condicionalmente' => 'Apto Condicionalmente',
                                    'Inapto Temporariamente' => 'Inapto Temporariamente',
                                    'Inapto Definitivamente ' => 'Inapto Definitivamente ',    
                              ),null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Resultado','required'=>'required']) !!}
                              {!! $errors->first('resultado','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('fk_tecnico','Colaborador (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('fk_tecnico',$users,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Colaborador','required'=>'required']) !!}
                              {!! $errors->first('fk_tecnico','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
