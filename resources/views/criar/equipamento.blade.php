@extends('adminlte::page')
@section('Equipamento', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM EQUIPAMENTO</h3>
            </div>
            {!! Form::open(array('route' => 'equipamento.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('marca','Marca (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('marca',null,['class'=>'form-control','required'=>'required','placeholder'=>'Marca do Equipamento']) !!}
                              {!! $errors->first('marca','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('modelo','Modelo (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('modelo',null,['class'=>'form-control','required'=>'required','placeholder'=>'Modelo do Equipamento']) !!}
                              {!! $errors->first('modelo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('codigo','Código (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('codigo',null,['class'=>'form-control','required'=>'required','placeholder'=>'Código do Equipamento']) !!}
                              {!! $errors->first('codigo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('dataAquisicao','Data de Aquisição',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('dataAquisicao',null,['class'=>'form-control']) !!}
                              {!! $errors->first('dataAquisicao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('empresa','Empresa (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('empresa', $empresas ,null,array('class' => 'form-control', 'id'=>'empresa', 'placeholder' => 'Escolha a Empresa','required'=>'required' )) !!}
                              {!! $errors->first('empresa','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div> 
                  <div class="form-group">
                        {!! Form::label('fornecedor','Fornecedor (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('fornecedor',null,['class'=>'form-control','required'=>'required','placeholder'=>'Fornecedor do Equipamento']) !!}
                              {!! $errors->first('fornecedor','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('status','Status (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('status',array('Abate' => 'Abate', 'Desatualizado' => 'Desatualizado','Operacional' => 'Operacional'),null,['class'=>'form-control','required'=>'required','placeholder'=>'Status do Equipamento']) !!}
                              {!! $errors->first('status','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('si','Sistema de Incentivos',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('si',null,['class'=>'form-control','placeholder'=>'Sistema de Incentivos']) !!}
                              {!! $errors->first('si','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('nSerie','Nº de Série',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('nSerie',null,['class'=>'form-control','placeholder'=>'Nº de Série do Equipamento']) !!}
                              {!! $errors->first('nSerie','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('fatura','Fatura',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('fatura',null,['class'=>'form-control','placeholder'=>'Nº de Fatura']) !!}
                              {!! $errors->first('fatura','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('observacoes',null,['class'=>'form-control','placeholder'=>'Especificações e outras observações do equipamento']) !!}
                              {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
