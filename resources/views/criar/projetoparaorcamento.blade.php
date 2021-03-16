
@extends('adminlte::page')

@section('Cliente', 'AdminLTE')

<style>
    /* Div - form Area de projeto */
    #hidden_div_areaProjeto {
        display: none;
    }

</style>

@section('content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



<div class="box   box-success">
            <div class="box-header with-border" >
                    <h1 class="box-title" ><strong>CRIAR UM PROJETO</strong></h1>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

<div class="box-body">
      {!! Form::open(array('route' => 'projetoorcamento.store','method'=>'POST','files'=>'true')) !!}
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
           
            
            <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                        {!! Form::label('nomeProjeto','Nome do Projeto* :') !!}
                        <div class="">
                        {!! Form::text('nomeProjeto',null,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('nomeProjeto','<p class="alert alert-danger">:message</p>')!!}
                        </div>
                  </div>
            </div>
  <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
              {!! Form::label('descricaoProjeto','Descrição do Projeto* :') !!}
              <div class="">
                    {!! Form::textarea('descricaoProjeto',null,['class'=>'form-control','required'=>'required','rows' => 1 ]) !!}
                    {!! $errors->first('descricaoProjeto','<p class="alert alert-danger">:message</p>')!!}
  
              </div>
        </div>
  </div>

   
   
    		

</div>

<div class="row">
          
                        {{-- <div class="form-group" class="hidden">
                              {!! Form::label('fk_criadoPor','Custo Previstoaa*:') !!} --}}
                              <div class="">
                                    {!! Form::number('fk_criadoPor',Auth::id(),['hidden']) !!}
                                    {!! $errors->first('fk_criadoPor','<p class="alert alert-danger">:message</p>')!!}
                  
                            
                     
                  </div>	

          
</div>
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                      {!! Form::label('custoPrevisto','Custo Previsto* :') !!}
                      <div class="">
                            {!! Form::text('custoPrevisto',null,['class'=>'form-control','required'=>'required']) !!}
                            {!! $errors->first('custoPrevisto','<p class="alert alert-danger">:message</p>')!!}
          
                      </div>
                </div>
          </div>	
          <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                        {!! Form::label('horasPrevistas','Horas Previstas*:') !!}
                        <div class="">
                              {!! Form::text('horasPrevistas',null,['class'=>'form-control','required'=>'required']) !!}
                              {!! $errors->first('horasPrevistas','<p class="alert alert-danger">:message</p>')!!}
            
                        </div>
                  </div>
            </div>



			

          <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="form-group">
                        {!! Form::label('observacoes','Observações:') !!}
                        <div class="">
                              {!! Form::textarea('observacoes',null,['class'=>'form-control' ,'rows' => 1 ]) !!}
                              {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
            
                        </div>
                  </div>
            </div>
</div>

 {{-- script para mostrar formulário para criar nova Área de Projeto --}}
 <script>
      function showDivAreaProjeto(divId, element){
           document.getElementById(divId).style.display = element.value == 'novaAreaProjeto' ? 'block' : 'none';
       }
</script>

      <div class="row">
            <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-3">
                        {!! Form::label('fk_areaProj','Área de Projeto* :') !!}
                        <select id="" name="fk_areaProj" class="form-control" onchange="showDivAreaProjeto('hidden_div_areaProjeto', this)">
                              <option value="">Escolha a área de projeto</option>
                              <option name="areaProjeto" value="novaAreaProjeto">Nova Área de Projeto</option>
                              @foreach ($areas as $a)
                                    @if ($a->visivel == 1)
                                          <option value="{{$a->pk_area}}">{{$a->projArea}}</option>
                                    @endif
                              @endforeach
                        </select>        
                        {!! $errors->first('fk_areaProj','<p class="alert alert-danger">:message</p>')!!}    
                  </div>
                  {{-- Formulário para criação de nova Área de projeto --}}
                  <div id="hidden_div_areaProjeto">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                              <div class="box   box-success">
                                    <div class="box-header with-border" >
                                          <h1 class="box-title" >CRIAR ÁREA DE PROJETO</h1>
                                    </div>
                                    <div class="box-body">
                                          {!! Form::label('novaArea','Nova Área de projeto* :') !!} 
                                          {!! Form::text('novaArea', null,['class'=>'form-control', 'placeholder'=>'Descrição da nova área de projeto']) !!}
                                          {!! $errors->first('novaArea','<p class="alert alert-danger">:message</p>')!!}
                                    </div>
                              </div>   
                              <br>
                             
                        </div>
                  </div>
                  {{-- Fim: Formulário para criação de nova Área de projeto --}}
            </div>
      </div>
      <br>

  <div class="row">
  
            <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group">
                              {!! Form::label('fk_urgencia','Urgência* :') !!}
                              <div class="">
                                          {!! Form::select('fk_urgencia', $urgencia ,null,
                                          array('class' => 'form-control','required'=>'required')) !!}
                                    {!! $errors->first('fk_urgencia','<p class="alert alert-danger">:message</p>')!!}
                  
                              </div>
                        </div>
                  </div> 
                  <div class="col-xs-12 col-sm-12 col-md-3">
                              <div class="form-group">
                                    {!! Form::label('fk_responsavel','Responsavel do Projeto* :') !!}
                                    <div class="">
                                                {!! Form::select('fk_responsavel', $responsavel ,null,
                                                array('class' => 'form-control','required'=>'required')) !!}
                                          {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}
                        
                                    </div>
                              </div>
                        </div> 
                        <div class="col-xs-12 col-sm-12 col-md-3">
                                    <div class="form-group">
                                          {!! Form::label('fk_cliente','Cliente*:') !!}
                                          <div class="">
                                                      {!! Form::text('fk_cliente', $cliente,
                                                      array('class' => 'form-control','required'=>'required','readonly'=>'readonly')) !!}
                                                {!! $errors->first('fk_cliente','<p class="alert alert-danger">:message</p>')!!}
                              
                                          </div>
                                    </div>
                              </div> 
  </div>

  <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3">
           <p> Horas por departamento:</p>
           @for ($i = 0; $i < count($departamento); $i++)
               
     
            {{ $departamento[$i]->descricao}} <input value="0" type="text" placeholder="custo" name={{$departamento[$i]->pk_departamento}}> <br>
            @endfor
         <br>
           
      </div>

    
  </div>

<strong>* campos de preenchimento obrigatório.</strong> 
 



		


</div>
<div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-4" >
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <input id="invisible_id"  name="fk_orcamento" type="hidden" value="{{$orcamento->pk_orcamento}}">

                        <a href="" ><button type="submit" class="btn btn-block btn-success btn-flat">
                                Adicionar Projeto</button></a>
                    </div>

                        <div class="col-xs-12 col-sm-12 col-md-2" >
                                <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                        Voltar</button></a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4" >
    
                </div>
    </div><br><br>
</div>
{!! Form::close()!!}
@stop
