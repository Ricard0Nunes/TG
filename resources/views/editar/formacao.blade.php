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
                  <h3 class="box-title">EDITAR UMA FORMAÇÃO</h3>
                  
            </div>
            {!! Form::open(array('route' => 'update.formacao','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                                    <h3 class="box-title col-sm-2 control-label">Formação</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
 
                                    <div class="form-group">
                                          {!! Form::label('nome_formacao','Nome Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                            {!! Form::text('nome_formacao',$formacao->nome_formacao, ['class' => 'form-control','required'=>'required']) !!}
                                                {!! $errors->first('nome_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('internaExterna','Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <div id="radioButtons">
                                                      <input type="radio" name="internaExterna" id="radio_interna" value="1">Interna
                                                      <br>
                                                      <input type="radio" name="internaExterna" id="radio_externa" value="0">Externa
                                                </div>
                                          </div>
                                    </div>
                                    <div class="hidden" id="dados_internaexterna1"> {{-- radio button "É cliente" = "sim". São apresentados os campos para: nome, email e telefone --}}
                                          <div class="form-group">
                                                {!! Form::label('fk_formador','Colaboradores (*)',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {{-- {!! Form::select('fk_cliente', $cliente, $carro->fk_cliente, ['class' => 'col-sm-5']) !!} --}}
                                                      {!! Form::select('fk_formador', $users,$formacao->fk_formador,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Colaborador')) !!}
                                                      {!! $errors->first('fk_formador','<p class="alert alert-danger">:message</p>')!!}
                                                </div>    
                                          </div>                
                                    </div>
                                    <div class="hidden" id="dados_internaexterna"> {{-- radio button "É cliente" = "sim". São apresentados os campos para: nome, email e telefone --}}
                                          <div class="form-group">
                                                {!! Form::label('nome_formador','Nome Formador (*)',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::text('nome_formador',$formacao->nome_formador,['class'=>'form-control']) !!}
                                                </div>    
                                          </div>                
                                    </div>
                   
                                    <div class="form-group">
                                          {!! Form::label('entidade_formacao','Entidade Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('entidade_formacao',$formacao->entidade_formacao,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('entidade_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                              <div class="form-group">
                                          {!! Form::label('dataInicio','Data Inicio (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::dateTimeLocal('dataInicio',carbon\Carbon::parse($formacao->dataInicio)->format('Y-m-d\TH:i'), ['class' => 'form-control','required'=>'required']) !!}                                                 {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dataFim','Data Fim (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5 ">
                                                
                                                {!! Form::dateTimeLocal('dataFim',carbon\Carbon::parse($formacao->dataFim)->format('Y-m-d\TH:i'), ['class' => 'form-control','required'=>'required']) !!}                                                {!! $errors->first('dataFim','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('horas_formacao','Horas Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('horas_formacao',$formacao->horas_formacao,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('horas_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('local_formacao','Local Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('local_formacao',$formacao->local_formacao,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('local_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('numero_vagas','Número Vagas (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('numero_vagas',$formacao->numero_vagas,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('numero_vagas','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                 
                                    {{-- <div class="form-group">
                                          {!! Form::label('eficacia_formacao','Eficácia Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('eficacia_formacao',$formacao->eficacia_formacao,['class'=>'form-control']) !!}
                                                {!! $errors->first('eficacia_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div> --}}
                                    <div class="form-group">
                                          {!! Form::label('custo_formacao','Custo Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('custo_formacao',$formacao->custo_formacao,['class'=>'form-control']) !!}
                                                {!! $errors->first('custo_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>                                  
                              </div>
                        </div>
                   
                  </div>  
                  <div class="box-footer ">
                        <input id="aaa" name="id" type="hidden" value={{$formacao->pk_formacao}}> 
                        <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  </div>  

                
            {!! Form::close()!!}  
      </div>
      {{-- script para mostrar div "dados_subcontratado"  --}}
            <script>
                  var radio = document.getElementsByName('internaExterna');
                  for (var i = 0; i < radio.length; i++) {
                        radio[i].onclick = function() {
                              var valorRadio = this.value;
                              if(valorRadio == '1'){
                                    document.getElementById("dados_internaexterna1").className = "";  
                                    document.getElementById("dados_internaexterna").className = "hidden";
 
                              }
                              else if(valorRadio == '0'){
                                    document.getElementById("dados_internaexterna1").className = "hidden";  
                                    document.getElementById("dados_internaexterna").className = "";
                              }
                        }
                  }
            </script>
      {{-- script para mostrar formulário cargo --}}
     
     
                                         
@stop