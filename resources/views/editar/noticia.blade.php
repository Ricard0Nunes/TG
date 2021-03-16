@extends('adminlte::page')
@section('Notícia', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">EDITAR UMA NOTÍCIA</h3>
            </div>
            {!! Form::open(array('route' => ['noticia.update','pk_alerta'=>$noticia->pk_alerta],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('mensagem','Mensagem (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::textarea('mensagem',$noticia->mensagem,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('mensagem','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('inicio','Início (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('inicio',$noticia->de,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('inicio','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
                  <div class="form-group">
                        {!! Form::label('fim','Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::date('fim',$noticia->a,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('fim','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
            <div class="box-footer ">
                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  
            </div>
            {!! Form::close()!!}
      </div>
@stop
