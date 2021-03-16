@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR PRAZO ORÇAMENTO</h3>
                  
            </div>
            {!! Form::open(array('route' => 'store.prazo','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                              @if(Session::has('success'))
                        <div class="alert alert-success">
                              {{ Session::get('success')}}
                        </div>
                              @elseif( Session::has('warning'))
                              <div class="alert alert-danger">
                                          {{ Session::get('warning')}}
                                          <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                                                </div>

                        @endif
                        </div>
                  </div>
                  <div class="box-body">
                        
                              <div class="form-group">
                                    {!! Form::label('prazo','Prazo(*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                          {!! Form::text('prazo',null,['class'=>'form-control','required'=>'required']) !!}
                                          {!! $errors->first('prazo','<p class="alert alert-danger">:message</p>')!!}
                                    </div>
                              </div>
                              <div class="form-group">
                                    {!! Form::label('dias','Dias(*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                          {!! Form::text('dias',null,['class'=>'form-control','required'=>'required']) !!}
                                          {!! $errors->first('dias','<p class="alert alert-danger">:message</p>')!!}
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
          
                  
        
     
     
                                         
@stop