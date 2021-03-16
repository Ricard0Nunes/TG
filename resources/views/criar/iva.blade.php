@extends('adminlte::page')
@section('IVA', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR UM IVA</h3>
            </div>
            {!! Form::open(array('route' => 'iva.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('descricao_iva','Descrição (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('descricao_iva',null ,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('descricao_iva','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('valor_iva','Valor (*)',['class'=>'col-sm-2 control-label',  'pattern'=>'[0-9]+([,\.][0-9]+)?']) !!}
                        <div class="col-sm-5">
                              {!! Form::number('valor_iva',null ,['class'=>'form-control','required'=>'required','step'=>'0.01',]) !!}
                              {!! $errors->first('valor_iva','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
               
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
            </div>
            {!! Form::close()!!}
      </div>
@stop
