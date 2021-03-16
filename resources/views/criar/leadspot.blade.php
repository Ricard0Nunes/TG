@extends('adminlte::page')
@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">CRIAR UMA LEAD</h3>
   </div>
   {!! Form::open(array('route' => 'leadpot.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
      <div class="box" style="border-top:0px solid black!important">
         <div class="box-header with-border">
            <h3 class="box-title col-sm-2 control-label">Lead</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
            </div>
         </div>
         <div class="box-body" style="">
           
            <div class="form-group">
               {!! Form::label('inicio','Início (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::dateTimeLocal('inicio',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('inicio','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            <div class="form-group">
               {!! Form::label('fim','Fim',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::dateTimeLocal('fim',null, ['class' => 'form-control']) !!} 
                  {!! $errors->first('fim','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            <div class="form-group">
               {!! Form::label('objetivo','Objetivos (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('objetivo',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('objetivo','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            <div class="form-group">
               {!! Form::label('notas','Notas',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('notas',null, ['class' => 'form-control']) !!} 
                  {!! $errors->first('notas','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
         
            
         </div>
         <div class="box-footer">
            <div class="col-xs-12 col-sm-12 col-md-18" >
               <button type="submit" class="btn btn-success pull-right">Enviar</button>
               <input id="invisible_id"  name="fk_potencialcliente" type="hidden" value="{{$potencialcliente}}">

               <div class="col-xs-12 col-sm-12 col-md-11" >
                  <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                     Voltar</button></a>
      
               </div>
            </div>
           
         </div>
      </div>
   </div>
     

   {!! Form::close()!!}  
</div>
@stop