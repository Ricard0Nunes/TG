@extends('adminlte::page')
@section('Sala', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UMA SALA</h3>
            </div>
            {!! Form::open(array('route' => 'sala.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('nome','Nome (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('nome',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('nome','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('local','Local (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('local',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('local','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('lotacao','Lotação (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('lotacao',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('lotacao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('custo','Custo (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('custo',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('custo','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
