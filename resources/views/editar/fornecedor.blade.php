@extends('adminlte::page')
@section('Fornecedor', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">EDITAR UM FORNECEDOR</h3>
      </div>
      {!! Form::open(array('route' => ['fornecedor.update','id'=>$fornecedor->pk_fornecedor],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('nomeCompleto','Nome Completo (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeCompleto',$fornecedor->nomeCompleto,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('nomeCompleto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                {!! Form::label('nomeAbreviado','Nome Abreviado (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::text('nomeAbreviado',$fornecedor->nomeAbreviado,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('nomeAbreviado','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('morada','Localização (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('morada',$fornecedor->morada,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="form-group">
          {!! Form::label('contacto','Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-5">
                {!! Form::text('contacto',$fornecedor->contacto,['class'=>'form-control','required'=>'required']) !!}
                {!! $errors->first('contacto','<p class="alert alert-danger">:message</p>')!!}
          </div>
    </div>  
        <div class="form-group">
        {!! Form::label('email','Email (*)',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
              {!! Form::text('email',$fornecedor->email,['class'=>'form-control','required'=>'required']) !!}
              {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
        </div>
  </div>
  <div class="form-group">
      {!! Form::label('NIF','NIF (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::text('NIF',$fornecedor->NIF,['class'=>'form-control','required'=>'required']) !!}
            {!! $errors->first('NIF','<p class="alert alert-danger">:message</p>')!!}
      </div>
</div>
<div class="form-group">
    {!! Form::label('avaliacao','Avaliação (*)',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
          {!! Form::text('avaliacao',$fornecedor->avaliacao,['class'=>'form-control','required'=>'required']) !!}
          {!! $errors->first('avaliacao','<p class="alert alert-danger">:message</p>')!!}
    </div>
</div>
<div class="form-group">
  {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
  <div class="col-sm-5">
        {!! Form::textArea('observacoes',$fornecedor->observacoes,['class'=>'form-control']) !!}
        {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
  </div>
</div>
<div class="form-group">
      {!! Form::label('visivel','Ativo (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::select('visivel',array('1' => 'Sim', '0' => 'Não'),$fornecedor->visivel,['class'=>'form-control','required'=>'required']) !!}
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
