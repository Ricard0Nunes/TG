@extends('adminlte::page')
@section('Departamento', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">EDITAR UM DEPARTAMENTO</h3>
            </div>
            {!! Form::open(array('route' => ['departamento.store',$departamento->pk_departamento],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                              {!! Form::text('descricao',$departamento->descricao,['class'=>'form-control','required'=>'required','placeholder'=>'Descrição do Departamento']) !!}
                              {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('abreviatura','Abreviatura (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('abreviatura',$departamento->abreviatura,['class'=>'form-control','required'=>'required','placeholder'=>'Abreviatura do Departamento']) !!}
                              {!! $errors->first('abreviatura','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
