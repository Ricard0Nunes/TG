@extends('adminlte::page')
@section('Cargos', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM CARGO</h3>
            </div>
            {!! Form::open(array('route' => 'cargo.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('descricao','Descrição (*)' ,['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('descricao',null,['class'=>'form-control','required'=>'required','placeholder'=>'Descrição do Cargo']) !!}
                              {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="hidden">
                        {!! Form::label('visivel','Visibilidade',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::radio('visivel', 0,['class'=>'form-control']) !!} Invisivel
                            <br>  {!! Form::radio('visivel', 1,['class'=>'form-control','selected'=>'selected']) !!} Visivel
                              {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
