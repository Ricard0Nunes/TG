@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">EDITAR ORIGEM</h3>
                  
            </div>
            {!! Form::open(array('route' => 'update.crm_origem','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                                    {!! Form::label('descricao','Descrição (*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                          {!! Form::text('descricao',$crm_origem->descricao,['class'=>'form-control','required'=>'required']) !!}
                                          {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                                    </div>
                              </div>
                   

                                    
          
                                          <div class="box-footer">
                                                <div class="col-xs-12 col-sm-12 col-md-18" >
                                                      <input id="aaa" name="pk_origem" type="hidden" value={{$crm_origem->pk_origem}}> 
                                                      <button type="submit" class="btn btn-success pull-right">Enviar</button>
                                                            
                                                   <div class="col-xs-12 col-sm-12 col-md-11" >
                                                      <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                                                         Voltar</button></a>
                                          
                                                   </div>
                                                </div>
                                               
                                             </div>
                  
        
     
     
                                         
@stop