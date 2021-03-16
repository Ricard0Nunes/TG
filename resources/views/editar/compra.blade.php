@extends('adminlte::page')
@section('Compra', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">EDITAR UMA COMPRA</h3>
      </div>

      {!! Form::open(array('route' => 'compra.update','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('dataCompra','Data da Compra (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('dataCompra',$compra->dataCompra,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('dataCompra','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                {!! Form::label('dataFechoCompra','Fecho da Compra (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::date('dataFechoCompra',$compra->dataFechoCompra,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('dataFechoCompra','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('dataRecebimento','Data de Recebimento (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::date('dataRecebimento',$compra->dataRecebimento,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('dataRecebimento','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="box-body">
        <div class="form-group">
              {!! Form::label('total','Total € (*)',['class'=>'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                    {!! Form::text('total',$compra->total,['class'=>'form-control','required'=>'required']) !!}
                    {!! $errors->first('total','<p class="alert alert-danger">:message</p>')!!}
              </div>
        </div>
        <div class="form-group">
            {!! Form::label('peso','Peso (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('peso',$compra->peso,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('peso','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="form-group">
        {!! Form::label('nArtigos','Nº de Artigos (*)',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
              {!! Form::text('nArtigos',$compra->nArtigos,['class'=>'form-control','required'=>'required']) !!}
              {!! $errors->first('nArtigos','<p class="alert alert-danger">:message</p>')!!}
        </div>
  </div>
  <div class="form-group">
    {!! Form::label('observacoes','Observações (*)',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
          {!! Form::textarea('observacoes',$compra->observacoes,['class'=>'form-control','required'=>'required']) !!}
          {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
    </div>
</div>
            <div class="form-group">
                {!! Form::label('fk_fornecedor','Fornecedor (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::select('fk_fornecedor',$fornecedor,$compra->fk_fornecedor,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('fk_fornecedor','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('fk_estadoCompra','Estado da Compra (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::select('fk_estadoCompra',$estadoCompra,$compra->fk_estadoCompra,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('fk_estadoCompra','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="form-group">
        {!! Form::label('fk_responsavel','Responsável (*)',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
              {!! Form::select('fk_responsavel',$responsavel,$compra->fk_responsavel,['class'=>'form-control','required'=>'required']) !!}
              {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}
        </div>
  </div>
      </div>
      <div class="box-footer ">
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
      </div>
      {!! Form::close()!!}
</div>
@stop
