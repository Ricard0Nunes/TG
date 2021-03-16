@extends('adminlte::page')
@section('Veículo', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM VEÍCULO</h3>
            </div>
            {!! Form::open(array('route' => 'veiculo.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('dataMatricula','Data da Matrícula (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('dataMatricula',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('dataMatricula','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('matricula','Matrícula (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('matricula',null,['class'=>'form-control','placeholder' => 'XX-XX-XX','required'=>'required']) !!}
                              {!! $errors->first('matricula','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('marca','Marca (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('marca',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('marca','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            
              
                 
                  <div class="form-group">
                        {!! Form::label('modelo','Modelo (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('modelo',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('modelo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('capacidade','Capacidade de Ocup. (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('capacidade',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('capacidade','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('kms','Kms (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('kms',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('kms','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('autonomia','Autonomia (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('autonomia',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('autonomia','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                
                  <div class="form-group">
                        {!! Form::label('nif','Empresa (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::select('nif', $empresas ,null,array('class' => 'form-control', 'id'=>'empresa', 'placeholder' => 'Escolha a Empresa','required'=>'required' )) !!}
                              {!! $errors->first('nif','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
