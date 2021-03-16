@extends('adminlte::page')
@section('Cliente', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UMA REQUISIÇÃO DE EQUIPAMENTO</h3>
      </div>
      {!! Form::open(array('route' => 'requisicaoequipamento.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('requisitante','Requisitante* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::select('requisitadoPor', $users,null,array('class' => 'form-control', 'id'=>'requisitadoPor','required'=>'required', 'placeholder' => 'Escolha o Requisitante' )) !!}
                        {!! $errors->first('requisitadoPor','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('dataInicio','Data Início* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::date('dataInicio',null,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('cpu','CPU*:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        
                        {!! Form::select('cpu', $equipamento,null,array('class' => 'form-control', 'id'=>'cpu','required'=>'required', 'placeholder' => 'Escolha o CPU' )) !!}
                        {!! $errors->first('cpu','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('peri','Periférico :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
 
                        {{-- <input id="invisible_id" name="peri[]" type="hidden" value=null> --}}

                        {!! Form::select('peri[]', $periferico, null, array('class' => 'form-control', 'id'=>'peri',  'multiple'=>'multiple', 'placeholder' => 'Sem Periférico' )) !!}
                        Pressione CTRL + Clique para escolher mais que um Periférico

                  </div>
                
            </div>
            <div class="form-group">
                  {!! Form::label('notas','Notas :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        {!! Form::textarea('notas',null,['class'=>'form-control','rows'=>4]) !!}
                        {!! $errors->first('notas','<p class="alert alert-danger">:message</p>')!!}
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
