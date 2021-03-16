@extends('adminlte::page')
@section('Cliente', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UM CLIENTE</h3>
      </div>
      {!! Form::open(array('route' => 'cliente.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('NIF','NIF (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('NIF',$potencialcliente->NIF,['class'=>'form-control','required'=>'required','placeholder'=>'NIF do Cliente']) !!}
                        {!! $errors->first('NIF','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('NISS','NISS' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('NISS',null,['class'=>'form-control','placeholder'=>'NISS do Cliente']) !!}
                        {!! $errors->first('NISS','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('logo','Lógotipo' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::file('logo',null,['class'=>'form-control','placeholder'=>'Logo do Cliente']) !!}
                        {!! $errors->first('logo','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
         
            <div class="form-group">
                  {!! Form::label('nomeCompleto','Nome Completo (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeCompleto',$potencialcliente->nomeCompleto,['class'=>'form-control','required'=>'required','placeholder'=>'Nome Completo do Cliente']) !!}
                        {!! $errors->first('nomeCompleto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('nomeAbreviado','Nome Abreviado (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeAbreviado',$potencialcliente->nomeAbreviado,['class'=>'form-control','required'=>'required','placeholder'=>'Nome Abreviado do Cliente']) !!}
                        {!! $errors->first('nomeAbreviado','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('email','Email (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('email',$potencialcliente->email,['class'=>'form-control','required'=>'required','placeholder'=>'Email do Cliente']) !!}
                        {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('morada','Morada (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('morada',$potencialcliente->morada,['class'=>'form-control','required'=>'required','placeholder'=>'Morada do Cliente']) !!}
                        {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('contacto','Contacto (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('contacto',$potencialcliente->contacto,['class'=>'form-control','required'=>'required','placeholder'=>'Contacto do Cliente']) !!}
                        {!! $errors->first('contacto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('contactoAlternativo','Contacto Alternativo' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('contactoAlternativo',$potencialcliente->contactoAlternativo,['class'=>'form-control','placeholder'=>'Contacto Alternativo do Cliente']) !!}
                        {!! $errors->first('contactoAlternativo','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('observacoes','Observações' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('observacoes',$potencialcliente->observacoes,['class'=>'form-control','placeholder'=>'Observações do Cliente']) !!}
                        {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
      </div>
      <div class="box-footer ">
            <a href="" > <input id="aaa" name="fk_potencialCliente" type="hidden" value={{$potencialcliente->pk_potencialCliente}}>
            <button type="submit" class="btn btn-success pull-right">Enviar</button>

      </div>
      {!! Form::close()!!}
</div>
@stop
