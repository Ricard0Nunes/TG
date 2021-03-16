@extends('adminlte::page')
<style>
      meter[value="1"]::-webkit-meter-optimum-value { background: red; }
      meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
      meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
      meter[value="4"]::-webkit-meter-optimum-value { background: green; }
 
 
      meter[value="1"]::-moz-meter-bar { background: red; }
      meter[value="2"]::-moz-meter-bar { background: yellow; }
      meter[value="3"]::-moz-meter-bar { background: orange; }
      meter[value="4"]::-moz-meter-bar { background: green; }
      meter {
            / Reset the default appearance /
            -moz-appearance: none;
            appearance: none;
            margin: 0 auto 1em;
            width: 100%;
            height: 0.5em;
            / Applicable only to Firefox /
            background: none;
            background-color: rgba(0, 0, 0, 0.1);
      }  
      meter::-webkit-meter-bar {
            background: none;
            background-color: rgba(0, 0, 0, 0.1);
      }
   
      #hidden_div_cargo {
            display: none;
      }
   
      #hidden_div_horario {
            display: none;
      }
 
      #hidden_div_nome {
            display: none;
      }
      /*Div para novo formulário*/
      .novaEntidade{
            border-width:2px;
            border-style:solid;
            border-color:green;
            padding: 5px;
            resize: both;
      }        
</style>
@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">EDITAR CAMPANHA</h3>
                  
            </div>
            {!! Form::open(array('route' => 'campanha.update','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label">Campanha</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
 
                                    <div class="form-group">
                                          {!! Form::label('fk_tipo_campanha','Tipo Campanha (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_tipo_campanha', $tipo_campanha, $campanha->fk_tipo_campanha, ['class' => 'form-control','placeholder' => 'Escolha o Tipo Campanha']) !!}
                                                {!! $errors->first('fk_tipo_campanha','<p class="alert alert-danger">:message</p>')!!}
                                          </div>    
                                    </div>

                                    <div class="form-group">
                                          {!! Form::label('fk_responsavel','Colaboradores (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_responsavel', $users, $campanha->fk_responsavel, ['class' => 'form-control','placeholder' => 'Escolha o Tipo Campanha']) !!}
                                                {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}
                                          </div>    
                                    </div>  
                     
                                                 
                           
                                 <div class="form-group">
                                    {!! Form::label('dataInicio','Data Início (*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                       {!! Form::date('dataInicio',$campanha->dataInicio, ['class' => 'form-control','required'=>'required']) !!} 
                                       {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p> ')!!}
                                    </div>
                                 </div>
                     
                                 <div class="form-group">
                                    {!! Form::label('dataFim','Data Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                       {!! Form::date('dataFim',$campanha->dataFim, ['class' => 'form-control','required'=>'required']) !!} 
                                       {!! $errors->first('dataFim','<p class="alert alert-danger">:message</p> ')!!}
                                    </div>
                                 </div>
                             
                                 <div class="form-group">
                                    {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                       {!! Form::text('observacoes',$campanha->observacoes,['class'=>'form-control','required'=>'required']) !!}
                                       {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
                                    </div>
                                 </div>
                                
                                                                 
                              </div>
                        </div>
                   
                  </div>  
            
                  <div class="box-footer">
                        <div class="col-xs-12 col-sm-12 col-md-18" >
                              <input id="aaa" name="id" type="hidden" value={{$campanha->pk_campanha}}> 
                              <button type="submit" class="btn btn-success pull-right">Enviar</button>
                              
                           <div class="col-xs-12 col-sm-12 col-md-11" >
                              <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                                 Voltar</button></a>
                  
                           </div>
                        </div>
                       
                     </div>

                
            {!! Form::close()!!}  
      </div>
      {{-- script para mostrar div "dados_subcontratado"  --}}

      {{-- script para mostrar formulário cargo --}}
     
     
                                         
@stop