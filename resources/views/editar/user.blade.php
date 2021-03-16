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
                  <h3 class="box-title">EDITAR UM COLABORADOR</h3>  {{$user->nomeCompleto}}
            </div>
            {!! Form::open(array('route' => ['user.update',$user->id],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                                    <h3 class="box-title col-sm-2 control-label" >PESSOAL</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('nomeCompleto','Nome Completo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nomeCompleto',$user->nomeCompleto, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('nomeCompleto','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                  </div>
                                    <div class="form-group">
                                          {!! Form::label('sigla','Sigla (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('sigla',$user->sigla,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('sigla','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dtnsc','Data de Nascimento (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dtnsc',$user->dtnsc, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('dtnsc','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('sexo','Sexo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <input type="radio"  id="option1" name="sexo" value="1"  {{ ($user->sexo=="1")? "checked" : "" }} >Masculino<br>
                                                <input type="radio" id="option2" name="sexo" value="0" {{ ($user->sexo=="0")? "checked" : "" }} >Feminino

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
                                    <h3 class="box-title col-sm-2 control-label" >RECURSOS HUMANOS</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('morada','Morada (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('morada',$user->morada, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('morada','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('bi','Cartão de Cidadão (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('bi',$user->bi, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('bi','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('validade','Validade do CC (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('validade',$user->validadecc, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('validade','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('segSocial','Segurança Social (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('segSocial',$user->segSocial,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('segSocial','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('nif','NIF (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('nif',$user->nif, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('nif','<p class="alert alert-danger">:message</p>')!!}        
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('cartaConducao','Carta de Condução (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <input type="radio"  id="option1" name="cartaConducao" value="1"  {{ ($user->cartaConducao=="1")? "checked" : "" }} >Sim<br>
                                                <input type="radio" id="option2" name="cartaConducao" value="0" {{ ($user->cartaConducao=="0")? "checked" : "" }} >Não
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('estadoCivil','Estado Civil (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!!  Form::select('estadoCivil', array( 'Solteiro' => 'Solteiro', 'Casado' => 'Casado','Divorciado' => 'Divorciado', 'Viúvo' => 'Viúvo'),$user->estadoCivil, array('class' => 'form-control','required'=>'required', 'placeholder'=>'Escolha um Estado Civil'))!!}
                                                {!! $errors->first('estadoCivil','<p class="alert alert-danger">:message</p>')!!}                      
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('numeroFilhos','Nº de Filhos (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('numeroFilhos',$user->numeroFilhos, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('numeroFilhos','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('iban','IBAN',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('iban', $user->iban, ['class'=>'form-control', 'id'=>'iban']) !!}
                                                {!! $errors->first('iban','<p class="alert alert-danger">:message</p>')!!}                      
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >CONTACTOS</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('email','Email Profissional (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('email',$user->email, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('emailPessoal','Email Pessoal (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('emailPessoal',$user->emailPessoal, ['class' => 'form-control','required'=>'required']) !!} 
                                                {!! $errors->first('emailPessoal','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoProfissional','Contacto Profissional',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoProfissional',$user->contactoProfissional, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('contactoProfissional','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoPessoal','Contacto Pessoal',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoPessoal',$user->contactoPessoal, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('contactoPessoal','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('contactoEmergencia','Contacto de Emergência',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('contactoEmergencia',$user->contactoEmergencia, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('contactoEmergencia','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('skype','Skype',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('skype',$user->skype, ['class' => 'form-control']) !!} 
                                                {!! $errors->first('skype','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >PROFISSIONAL</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('dataInicioContrato','Data de Início de Contrato (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dataInicioContrato',$user->dataInicioContrato,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('dataInicioContrato','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('dataFimContrato','Data de Fim de Contrato (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::date('dataFimContrato',$user->dataFimContrato,['class'=>'form-control','required'=>'required']) !!}
                                                {!! $errors->first('dataFimContrato','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_departamento','Departamento (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_departamento', $departamentos ,$user->fk_departamento,array('class' => 'form-control', 'id'=>'departamento', 'placeholder' => 'Escolha o Departamento','required'=>'required' )) !!}
                                                {!! $errors->first('fk_departamento','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_cargo','Cargo (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_cargo', $cargos,$user->fk_cargo,['class'=>'form-control', 'placeholder'=>'Descrição do cargo']) !!}
   
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('visivel','Visível (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <input type="radio"  id="option1" name="visivel" value="1"  {{ ($user->visivel=="1")? "checked" : "" }} >Visível<br>
                                                <input type="radio" id="option2" name="visivel" value="0" {{ ($user->visivel=="0")? "checked" : "" }} >Invisível
                                         
                                          </div>
                                    </div>       
                                   
                                    <div class="form-group">
                                          {!! Form::label('fk_nivelAcesso','Nivel de Acesso (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_nivelAcesso', $nivel ,$user->fk_nivelAcesso,array('class' => 'form-control', 'id'=>'fk_nivelAcesso', 'placeholder' => 'Escolha o Nivel de Acesso' ,'required'=>'required')) !!}
                                                {!! $errors->first('fk_nivelAcesso','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('simNao','É Subcontratado? (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                <div id="radioButtons">
                                                      @if (    $user->subcontratado==1)
                                                      <input type="radio" name="simNao" id="radio_Sim" value="1" required="" checked>Sim
                                                      <br>
                                                      <input type="radio" name="simNao" id="radio_Nao" value="0" required >Não
                                                      @else
                                                      <input type="radio" name="simNao" id="radio_Sim" value="1" required="" >Sim
                                                      <br>
                                                      <input type="radio" name="simNao" id="radio_Nao" value="0" required checked>Não
                                                      @endif
                                                  
                                                    
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('nifEmpregador','Empresa? (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('nifEmpregador', $empresas,$user->nifEmpregador,['class'=>'form-control']) !!}

                                          </div>
                                    </div>
                                  
                                    <div class="form-group">
                                          {!! Form::label('salarioBase','Salário Base (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('salarioBase', $user->salarioBase, ['class'=>'form-control', 'id'=>'salarioBase','required'=>'required']) !!}
                                                {!! $errors->first('salarioBase','<p class="alert alert-danger">:message</p>')!!}                        
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('fk_horario','Horário (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::select('fk_horario', $horarios,$user->fk_horario,['class'=>'form-control', 'placeholder'=>'Escolha um Horário']) !!}
                                          </div>
                                    </div>
                                   
                                    <div class="form-group">
                                          {!! Form::label('saldo','Saldo(h):',['class'=>'col-sm-2 control-label']) !!}
                                
                                          <div class="col-sm-5">
                        
                                                @if ($user->id==auth::id())
                                                {!! Form::text('saldo', 
                                                '-'. gmdate("H:i:s", $userscomuns[0]->saldo) ,['class'=>'form-control','readonly'=>'readonly'])!!}
                                                @else
                                                {!! Form::text('saldo', 
                                                '-'. gmdate("H:i:s", $userscomuns[0]->saldo) ,['class'=>'form-control'])!!}
                                                @endif
                        
                                                {!! $errors->first('saldo','<p class="alert alert-danger">:message</p>')!!}
                                
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('anoAnt','Dias Disponíveis de Férias '.Carbon\Carbon::now()->subYear()->format('Y'). ':',['class'=>'col-sm-2 control-label']) !!}
                                
                                          <div class="col-sm-5">
                                                @if ($user->id==auth::id())
                                                {!! Form::text('anoAnt',$userscomuns[0]->anoAnt,['class'=>'form-control','readonly'=>'readonly'])!!}
                                                @else
                                                {!! Form::text('anoAnt',$userscomuns[0]->anoAnt ,['class'=>'form-control'])!!}
                                                @endif
                        
                        
                                            
                                                {!! $errors->first('anoAnt','<p class="alert alert-danger">:message</p>')!!}
                                
                                          </div>
                                    </div>
                              </div>
      
                                    <div class="form-group">
                                          {!! Form::label('ano','Dias Disponíveis de Férias '.Carbon\Carbon::now()->format('Y'). ':',['class'=>'col-sm-2 control-label']) !!}
                                
                                          <div class="col-sm-5">
                        
                                                @if ($user->id==auth::id())
                                                {!! Form::text('ano',$userscomuns[0]->ano,['class'=>'form-control','readonly'=>'readonly'])!!}
                                                @else
                                                {!! Form::text('ano',$userscomuns[0]->ano,['class'=>'form-control'])!!}
                                                @endif
                                            
                                                {!! $errors->first('ano','<p class="alert alert-danger">:message</p>')!!}
                                
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('anoProx','Dias Disponíveis de Férias '.Carbon\Carbon::now()->addYear()->format('Y'). ':',['class'=>'col-sm-2 control-label']) !!}
                                
                                          <div class="col-sm-5">
                                                @if ($user->id==auth::id())
                                                {!! Form::text('anoProx',$userscomuns[0]->anoProx,['class'=>'form-control','readonly'=>'readonly'])!!}
                                                @else
                                                {!! Form::text('anoProx',$userscomuns[0]->anoProx,['class'=>'form-control'])!!}
                                                @endif
                        
                                               
                                                {!! $errors->first('anoProx','<p class="alert alert-danger">:message</p>')!!}
                                
                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="box" style="border-top:0px solid black!important">
                              <div class="box-header with-border">
                                    <h3 class="box-title col-sm-2 control-label" >ACESSOS</h3>
                                    <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                    </div>
                              </div>
                              <div class="box-body" style="">
                                    <div class="form-group">
                                          {!! Form::label('password','Password (*)',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::password('password',null,['class'=>'form-control', 'id'=>'password']) !!}
                                                {!! $errors->first('password','<p class="alert alert-danger">:message</p>')!!}
                                                <meter max="4" id="password-strength-meter"></meter>
                                                <p id="password-strength-text"></p>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          {!! Form::label('pin','PIN',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                                {!! Form::text('pin', $user->pin, ['class'=>'form-control', 'id'=>'pin']) !!}
                                                {!! $errors->first('pin','<p class="alert alert-danger">:message</p>')!!}
                                          </div>
                                    </div>
                              </div>
                        </div>
  
                  <div class="box-footer ">
                        <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  </div>   

                
            {!! Form::close()!!}   
      </div>
           
@stop  