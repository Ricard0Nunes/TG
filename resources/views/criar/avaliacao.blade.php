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
                  <h3 class="box-title">CRIAR UMA AVALIAÇÃO</h3>
            </div>
            {!! Form::open(array('route' => ['avaliacao.store','id'=>$inscricao->pk_inscricao],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                                    <h3 class="box-title col-sm-2 control-label">Avaliação</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">

                                    
                                    <div class="form-group">
                                          {!! Form::label('nome_formacao','Nome Formação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nome_formacao',$formacao->nome_formacao, ['class' => 'form-control','readonly']) !!}
                                                <input id="invisible_id" name="fk_formacao" type="hidden">
                  
                                                {!! $errors->first('nome_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>

                                    @if ($formacao->interno == 1)

                                    <div class="form-group">
                                          {!! Form::label('nome_formacao','Nome Formador',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('fk_formador',DB::table('users')->where('id',$inscricao->fk_formador)->value('name'),['class'=>'form-control','readonly'])!!}
                                                <input id="invisible_id" name="fk_formacao" type="hidden">
                                                {!! $errors->first('nome_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    
                                    @else

                                    

                                    <div class="form-group">
                                          {!! Form::label('nome_formador','Nome Formação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nome_formador',$formacao->nome_formador,['class'=>'form-control','readonly']) !!}
                                                <input id="invisible_id" name="fk_formacao" type="hidden">
                  
                                                {!! $errors->first('nome_formador','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>

                                    @endif

                                    <div class="form-group">
                                          {!! Form::label('entidade_formacao','Entidade Formação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('entidade_formacao',$formacao->entidade_formacao, ['class' => 'form-control','readonly']) !!} 
                                                {!! $errors->first('entidade_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          {!! Form::label('entidade_formacao','Local Formação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('entidade_formacao',$formacao->local_formacao, ['class' => 'form-control','readonly']) !!} 
                                                {!! $errors->first('entidade_formacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>



                                    <div class="form-group">
                                          {!! Form::label('dataInicio','Data Formação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('dataInicio',$formacao->dataInicio.' a '.$formacao->dataFim, ['class' => 'form-control','readonly']) !!} 
                                                {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>


                                     <div class="form-group">
                                          {!! Form::label('avaliacao_user','Avaliação Formação (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('avaliacao_user',array('Muito Fraco' => 'Muito Fraco', 'Fraco' => 'Fraco','Razoável' => 'Razoável', 'Bom' => 'Bom','Muito Bom' => 'Muito Bom'),null,['class'=>'form-control','placeholder'=>'Selecione uma Avaliação']) !!} 
                                                {!! $errors->first('avaliacao_user','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
{{--                              
                                    <div class="form-group">
                                          {!! Form::label('avaliacao_user','Avaliação User',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::textarea('avaliacao_user',null,['class'=>'form-control']) !!}
                                                {!! $errors->first('avaliacao_user','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div> --}}
                                    <div class="form-group">
                                          {!! Form::label('avaliacao_formador','Avaliação Formador',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('avaliacao_formador',array('Muito Fraco' => 'Muito Fraco', 'Fraco' => 'Fraco','Razoável' => 'Razoável', 'Bom' => 'Bom','Muito Bom' => 'Muito Bom'),null,['class'=>'form-control','placeholder'=>'Selecione uma Avaliação']) !!} 

                                                {!! $errors->first('avaliacao_formador','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          {!! Form::label('observacao','Observação',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::textarea('observacao',null,['class'=>'form-control']) !!}
                                                {!! $errors->first('observacao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    
                                  
                                                                     
                              </div>
                        </div>
                   
                  </div>  
 
                  <div class="box-footer ">
                        <input id="aaa" name="id" type="hidden"> <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  </div>   
            {!! Form::close()!!}  
      </div>
      {{-- script para mostrar div "dados_subcontratado"  --}}
          
      {{-- script para mostrar formulário cargo --}}
     
      
                                          
@stop
