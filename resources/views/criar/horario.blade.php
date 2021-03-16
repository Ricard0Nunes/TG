@extends('adminlte::page')
@section('Horário', 'AdminLTE')
@section('content')<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UM HORÁRIO</h3>
      </div>
      {!! Form::open(array('route' => 'horario.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::text('descricao',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horaEntrada','Hora de Entrada (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('horaEntrada',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('horaEntrada','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('horaSaida','Hora de Saída (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('horaSaida',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('horaSaida','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('duracaoAlmoco','Duração de Almoço (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('duracaoAlmoco',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('duracaoAlmoco','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('almocoApartir','Almoço a Partir de (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('almocoApartir',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('almocoApartir','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('almocoAte','Almoço Até (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('almocoAte',null,['class'=>'form-control' ,'rows' => 1,'required'=>'required' ]) !!}
                        {!! $errors->first('almocoAte','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            {{-- <div class="form-group">
                  {!! Form::label('horasDiarias','Horas Diárias (*)' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('horasDiarias',null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                        {!! $errors->first('horasDiarias','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div> --}}
            <div class="hidden">
                  {!! Form::label('visivel','Visibilidade',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::radio('visivel', 0,['class'=>'form-control']) !!} Invisivel
                      <br>  {!! Form::radio('visivel', 1,['class'=>'form-control','selected'=>'selected']) !!} Visivel
                        {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
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
