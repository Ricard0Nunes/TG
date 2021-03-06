@extends('adminlte::page')
@section('Equipamento', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">EDITAR UM EQUIPAMENTO</h3>
            </div>
            {!! Form::open(array('route' => ['equipamento.store',$equipamento->pk_equipamento],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                              {!! Form::text('marca',$equipamento->marca,['class'=>'form-control','required'=>'required','placeholder'=>'Marca do Equipamento']) !!}
                              {!! $errors->first('marca','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('modelo','Modelo (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('modelo',$equipamento->modelo,['class'=>'form-control','required'=>'required','placeholder'=>'Modelo do Equipamento']) !!}
                              {!! $errors->first('modelo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('codigo','C??digo (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('codigo',$equipamento->codigo,['class'=>'form-control','required'=>'required','placeholder'=>'C??digo do Equipamento']) !!}
                              {!! $errors->first('codigo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('dataAquisicao','Data de Aquisi????o',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('dataAquisicao',$equipamento->dataAquisicao,['class'=>'form-control']) !!}
                              {!! $errors->first('dataAquisicao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('empresa','Empresa (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('empresa', $empresas ,$equipamento->empresa,array('class' => 'form-control', 'id'=>'empresa', 'placeholder' => 'Escolha a Empresa','required'=>'required' )) !!}
                              {!! $errors->first('empresa','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div> 
                  <div class="form-group">
                        {!! Form::label('fornecedor','Fornecedor (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('fornecedor',$equipamento->fornecedor,['class'=>'form-control','required'=>'required','placeholder'=>'Fornecedor do Equipamento']) !!}
                              {!! $errors->first('fornecedor','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('status','Status (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('status',array('Abate' => 'Abate', 'Desatualizado' => 'Desatualizado','Operacional' => 'Operacional'),$equipamento->status,['class'=>'form-control','required'=>'required','placeholder'=>'Status do Equipamento']) !!}
                              {!! $errors->first('status','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('si','Sistema de Incentivos',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('si',$equipamento->si,['class'=>'form-control','placeholder'=>'Sistema de Incentivos']) !!}
                              {!! $errors->first('si','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('nSerie','N?? de S??rie',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('nSerie',$equipamento->nSerie,['class'=>'form-control','placeholder'=>'N?? de S??rie do Equipamento']) !!}
                              {!! $errors->first('nSerie','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('fatura','Fatura',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('fatura',$equipamento->fatura,['class'=>'form-control','placeholder'=>'N?? de Fatura']) !!}
                              {!! $errors->first('fatura','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('observacoes','Observa????es',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('observacoes',$equipamento->observacoes,['class'=>'form-control','placeholder'=>'Especifica????es e outras observa????es do equipamento']) !!}
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
