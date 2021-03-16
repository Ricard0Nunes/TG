@extends('adminlte::page')
@section('Correspondência', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR CORRESPONDÊNCIA</h3>
      </div>
      {!! Form::open(array('route' => 'correspondencia.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('local','Local de Recepção (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('local',array(
                              'Setúbal' => 'Sede Setúbal',
                              'Évora' => 'Évora',
                              'Lisboa' => 'Lisboa',
                              'Beja' => 'Beja',
                              'Outro->descrever em comentário' => 'Outro->descrever em comentário',)
                              ,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o local de recepção','required'=>'required']) !!}
                          {!! $errors->first('local','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('remetente','Remetente' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('remetente',null,['class'=>'form-control' ,'rows' => 2 ]) !!}
                        {!! $errors->first('remetente','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('datarececao','Data de Recepção (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::dateTimeLocal('datarececao',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                        {!! $errors->first('datarececao','<p class="alert alert-danger">:message</p>')!!}
                        Deixar em branco para aplicar a data de hoje.
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('fk_destinatario','Destinatário (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_destinatario',$users,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Colaborador']) !!}
                        {!! $errors->first('fk_destinatario','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('Cliente','Destinatário Cliente' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('Cliente',null,['class'=>'form-control' ,'rows' => 2,'placeholder'=>'Cliente >> correspondência externa']) !!}
                        {!! $errors->first('Cliente','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('interno','Tipo de Correspondência (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::radio('interno', 0,['class'=>'form-control']) !!} Clientes  &nbsp;&nbsp;&nbsp;
                        {!! Form::radio('interno', 1,['class'=>'form-control']) !!} Interno
                        {!! $errors->first('interno','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('comentario','Comentário' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::textarea('comentario',null,['class'=>'form-control' ,'rows' => 2 ]) !!}
                        {!! $errors->first('comentario','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
      </div>
      <div class="box-footer ">
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
      </div>
      {!! Form::close()!!}
</div>
@stop
