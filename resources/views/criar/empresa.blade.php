@extends('adminlte::page')
@section('Empresa', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UMA EMPRESA</h3>
      </div>
      {!! Form::open(array('route' => 'empresa.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::text('NIF',null,['class'=>'form-control','required'=>'required','placeholder'=>'NIF da Empresa']) !!}
                        {!! $errors->first('NIF','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('NISS','NISS' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('NISS',null,['class'=>'form-control','placeholder'=>'NISS da Empresa']) !!}
                        {!! $errors->first('NISS','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('logo','Lógotipo' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::file('logo',null,['class'=>'form-control','placeholder'=>'Logo da Empresa']) !!}
                        {!! $errors->first('logo','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('visivel','Visibilidade',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::radio('visivel', 0,['class'=>'form-control']) !!} Invisivel
                      <br>  {!! Form::radio('visivel', 1,['class'=>'form-control','selected'=>'selected']) !!} Visivel
                        {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('nomeCompleto','Nome Completo (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeCompleto',null,['class'=>'form-control','required'=>'required','placeholder'=>'Nome Completo da Empresa']) !!}
                        {!! $errors->first('nomeCompleto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('nomeAbreviado','Nome Abreviado' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeAbreviado',null,['class'=>'form-control','placeholder'=>'Nome Abreviado da Empresa']) !!}
                        {!! $errors->first('nomeAbreviado','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('email','Email (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('email',null,['class'=>'form-control','required'=>'required','placeholder'=>'Email da Empresa']) !!}
                        {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('morada','Morada' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('morada',null,['class'=>'form-control','placeholder'=>'Morada da Empresa']) !!}
                        {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('contacto','Contacto (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('contacto',null,['class'=>'form-control','placeholder'=>'Contacto da Empresa']) !!}
                        {!! $errors->first('contacto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('contactoAlternativo','Contacto Alternativo' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('contactoAlternativo',null,['class'=>'form-control','placeholder'=>'Contacto Alternativo da Empresa']) !!}
                        {!! $errors->first('contactoAlternativo','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horarioAbertura','Horário de Abertura (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('horarioAbertura',null,['class'=>'form-control']) !!}
                        {!! $errors->first('horarioAbertura','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horarioFecho','Horário Fecho' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('horarioFecho',null,['class'=>'form-control']) !!}
                        {!! $errors->first('horarioFecho','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('observacoes','Observações' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('observacoes',null,['class'=>'form-control','placeholder'=>'Observações da Empresa']) !!}
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
