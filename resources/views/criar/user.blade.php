@extends('adminlte::page')
<style>
      meter[value="1"]::-webkit-meter-optimum-value { background: red; }
      meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
      meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
      meter[value="4"]::-webkit-meter-optimum-value { background: green; }

      /* Gecko based browsers */
      meter[value="1"]::-moz-meter-bar { background: red; }
      meter[value="2"]::-moz-meter-bar { background: yellow; }
      meter[value="3"]::-moz-meter-bar { background: orange; }
      meter[value="4"]::-moz-meter-bar { background: green; }
      meter {
            /* Reset the default appearance */
            -moz-appearance: none;
            appearance: none;
            margin: 0 auto 1em;
            width: 100%;
            height: 0.5em;
            /* Applicable only to Firefox */
            background: none;
            background-color: rgba(0, 0, 0, 0.1);
      }  
      meter::-webkit-meter-bar {
            background: none;
            background-color: rgba(0, 0, 0, 0.1);
      }
      /* Div - form cargo */
      #hidden_div_cargo {
            display: none;
      }
      /* Div - form horario */
      #hidden_div_horario {
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
                  <h3 class="box-title">CRIAR UM COLABORADOR</h3>
            </div>
            {!! Form::open(array('route' => 'user.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                                    <h3 class="box-title col-sm-2 control-label" >Pessoal</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('name','Nome Completo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('name',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('name','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('sigla','Sigla (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('sigla',null,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('sigla','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dtnsc','Data de Nascimento (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dtnsc',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('dtnsc','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('sexo','Sexo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::radio('sexo', 0,['class'=>'form-control','readonly']) !!} Feminino 
                                                <br>
                                                {!! Form::radio('sexo', 1,['class'=>'form-control','readonly']) !!} Masculino
                                                {!! $errors->first('sexo','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('foto','Foto',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::file('foto',null, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('foto','<p class="alert alert-danger">:message</p>')!!}                        
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >Recursos Humanos</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('morada','Morada (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('morada',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('bi','Cartão de Cidadão (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('bi',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('bi','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('validade','Validade do CC (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('validade',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('validade','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('segSocial','Segurança Social (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('segSocial',null,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('segSocial','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('nif','NIF (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nif',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('nif','<p class="alert alert-danger">:message</p>')!!}        
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('cartaConducao','Carta de Condução (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::radio('cartaConducao', 0,['class'=>'form-control']) !!} Não
                                                <br>
                                                {!! Form::radio('cartaConducao', 1,['class'=>'form-control']) !!} Sim
                                                {!! $errors->first('cartaConducao','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('estadoCivil','Estado Civil (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!!  Form::select('estadoCivil', array( 'Solteiro' => 'Solteiro', 'Casado' => 'Casado','Divorciado' => 'Divorciado', 'Viúvo' => 'Viúvo'),null, array('class' => 'form-control','required'=>'required', 'placeholder'=>'Escolha um Estado Civil'))!!}
                                                {!! $errors->first('estadoCivil','<p class="alert alert-danger">:message</p>')!!}                      
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('nFilhos','Nº de Filhos (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nFilhos',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('nFilhos','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('iban','IBAN',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('iban', null, ['class'=>'form-control', 'id'=>'iban']) !!}
                                                {!! $errors->first('iban','<p class="alert alert-danger">:message</p>')!!}                      
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >Contactos</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('email','Email Profissional (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('email',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('emailPessoal','Email Pessoal (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('emailPessoal',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('emailPessoal','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoProfissional','Contacto Profissional',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoProfissional',null, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('contactoProfissional','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoPessoal','Contacto Pessoal (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoPessoal',null, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('contactoPessoal','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoEmergencia','Contacto de Emergência',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoEmergencia',null, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('contactoEmergencia','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('skype','Skype',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('skype',null, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('skype','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >Profissional</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('dataInicioContrato','Data de Início de Contrato (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dataInicioContrato',null,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('dataInicioContrato','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dataFimContrato','Data de Fim de Contrato (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dataFimContrato',null,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('dataFimContrato','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_departamento','Departamento (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_departamento', $departamento ,null,array('class' => 'form-control', 'id'=>'departamento', 'placeholder' => 'Escolha o Departamento','required'=>'required' )) !!}
                                                {!! $errors->first('fk_departamento','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_cargo','Cargo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <select id="" required name="fk_cargo" class="form-control" onchange="showDivCargo('hidden_div_cargo', this)">
                                                      <option value="">Escolha o cargo do colaborador</option>
                                                      <option name="cargo" value="novoCargo">Novo Cargo</option>
                                                      @foreach ($cargos as $c)
                                                            @if ($c->visivel == 1)
                                                                  <option value="{{$c->pk_cargo}}">{{$c->descricao}}</option>
                                                            @endif
                                                      @endforeach
                                                </select>      
                                          </div>
                                    </div>
                                    <div id="hidden_div_cargo">
                                          <div class="form-group">
                                                {!! Form::label('novoCargoDescricao','Novo Cargo (*)',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::text('novoCargoDescricao', null,['class'=>'form-control', 'placeholder'=>'Descrição do cargo']) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('visivel','Visível (*)',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::radio('novoCargoVisivel', 0,['class'=>'form-control']) !!} Invisivel
                                                      <br>
                                                      {!! Form::radio('novoCargoVisivel', 1,['class'=>'form-control']) !!} Visivel
                                                </div>
                                          </div>       
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dataInicioContrato','Nível de Acesso (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_nivelAcesso', $nivel ,null,array('class' => 'form-control', 'id'=>'fk_nivelAcesso', 'placeholder' => 'Escolha o Nivel de Acesso' ,'required'=>'required')) !!}
                                                {!! $errors->first('fk_nivelAcesso','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('simNao','É Subcontratado? (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <div id="radioButtons">
                                                      <input type="radio" name="simNao" id="radio_Sim" value="1" required="" checked>Sim
                                                      <br>
                                                      <input type="radio" name="simNao" id="radio_Nao" value="0" required >Não
                                                </div>
                                          </div>
                                    </div>
                                    <div class="" id="dados_subcontratado"> {{-- radio button "É cliente" = "sim". São apresentados os campos para: nome, email e telefone --}}
                                          <div class="form-group">
                                                {!! Form::label('nifEmpregador','Empresa (*)',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::select('nifEmpregador', $empresas,null,['class'=>'form-control']) !!}
                                                </div>    
                                          </div>                
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('salarioBase','Salário Base (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('salarioBase', null, ['class'=>'form-control', 'id'=>'salarioBase','required'=>'required']) !!}
                                                {!! $errors->first('salarioBase','<p class="alert alert-danger">:message</p>')!!}                        
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_horario','Horário (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <select id=""required name="fk_horario" class="form-control" onchange="showDivHorario('hidden_div_horario', this)">
                                                      <option value="">Escolha o horário do colaborador</option>
                                                      <option name="" value="novoHorario">Novo Horario</option>
                                                      @foreach ($horarios as $h)
                                                            @if ($h->visivel == 1)
                                                                  <option value="{{$h->pk_horario}}">{{$h->descricao}}</option>
                                                            @endif
                                                      @endforeach
                                                </select>        
                                          </div>
                                    </div>
                                    <div id="hidden_div_horario">
                                          <div class="form-group">
                                                {!! Form::label('novaDescricao','Descrição',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::text('novaDescricao',null,['class'=>'form-control' ,'rows' => 1, 'placeholder'=>'Descrição do horário' ]) !!}
                                                </div>
                                          </div> 
                                          <div class="form-group">
                                                {!! Form::label('novaHoraEntrada','Hora de Entrada',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novaHoraEntrada',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novaHoraSaida','Hora de Saída',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novaHoraSaida',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novaDuracaoAlmoco','Duração de Almoço',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novaDuracaoAlmoco',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novoAlmocoApartir','Almoço a partir',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novoAlmocoApartir',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novoAlmocoAte','Almoço Até',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novoAlmocoAte',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novaHorasDiarias','Horas Diárias',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::time('novaHorasDiarias',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                {!! Form::label('novoVisivel','Visível',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-5">
                                                      {!! Form::radio('novoVisivel', 0,['class'=>'form-control']) !!} Invisivel
                                                      <br>
                                                      {!! Form::radio('novoVisivel', 1,['class'=>'form-control']) !!} Visivel
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >Acessos</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('password','Password (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::password('password',  ['class'=>'form-control', 'id'=>'password','required'=>'required']) !!}
                                                {!! $errors->first('password','<p class="alert alert-danger">:message</p>')!!}
                                                <meter max="4" id="password-strength-meter"></meter>
                                                <p id="password-strength-text"></p>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('pin','PIN',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('pin', null, ['class'=>'form-control', 'id'=>'pin']) !!}
                                                {!! $errors->first('pin','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>  
                  <div class="box-footer ">
                        <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  </div>   
            {!! Form::close()!!}  
      </div>
      {{-- script para mostrar div "dados_subcontratado"  --}}
      <script>
            var radio = document.getElementsByName('simNao'); 
            for (var i = 0; i < radio.length; i++) {
                  radio[i].onclick = function() {
                        var valorRadio = this.value; 
                        if(valorRadio == '1'){
                              document.getElementById("dados_subcontratado").className = "";  
                        }
                        else if(valorRadio == '0'){
                              document.getElementById("dados_subcontratado").className = "hidden"; 
                        }
                  }
            }
      </script>
      {{-- script para mostrar formulário cargo --}}
      <script>
            function showDivCargo(divId, element){
                  document.getElementById(divId).style.display = element.value == 'novoCargo' ? 'block' : 'none';
            }
      </script>
      <script>
            function showDivHorario(divId, element){
                  document.getElementById(divId).style.display = element.value == 'novoHorario' ? 'block' : 'none';
            }
      </script>
      <script>
             var strength = {
                  0: "Péssima",
                  1: "Muito Fraca",
                  2: "Fraca",
                  3: "Boa",
                  4: "Excelente"
            }
      </script>
      <script>
            var password = document.getElementById('password');
            var meter = document.getElementById('password-strength-meter');
            var text = document.getElementById('password-strength-text');
            password.addEventListener('input', function() {
                  var val = password.value;
                  var result = zxcvbn(val);
                  // Update the password strength meter
                  meter.value = result.score;
                  // Update the text indicator
                  if (val !== "") {
                        text.innerHTML = "<strong>Força:</strong> " + strength[result.score]; 
                  } else {
                        text.innerHTML = "";
                  }
            });
      </script>                                      
@stop
