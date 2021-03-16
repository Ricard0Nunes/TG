@extends('adminlte::page')
@section('Cliente', 'AdminLTE')
@section('content')
<style>
      /* Div - form Area de projeto */
      #hidden_div_areaProjeto {
          display: none;
      }
  
  </style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>



<div class="box box-success">
            <div class="box-header with-border" >
                    <h1 class="box-title" >CRIAR UM PROJETO</h1>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

      {!! Form::open(array('route' => 'projeto.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('codProj','Código de Projeto* :' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('codProj',null,['class'=>'form-control','required'=>'required','placeholder'=>'Código do Projeto']) !!}
                        {!! $errors->first('codProj','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('nomeProjeto','Nome do Projeto* :' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('nomeProjeto',null,['class'=>'form-control','placeholder'=>'Nome do Projeto']) !!}
                        {!! $errors->first('nomeProjeto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('descricaoProjeto','Descrição do Projeto* :' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::textarea('descricaoProjeto',null,['class'=>'form-control','placeholder'=>'Descrição do Projeto','required'=>'required','rows' => 1 ]) !!}
                        {!! $errors->first('descricaoProjeto','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>


         
            <div class="form-group">
                  {!! Form::label('visivel','Rascunho* :',['class'=>'col-sm-2 control-label']) !!}
        
                  <div class="">
                        {!! Form::radio('visivel', 0,['class'=>'form-control']) !!} Sim  &nbsp;&nbsp;&nbsp;
                        {!! Form::radio('visivel', 1,['class'=>'form-control']) !!} Não
                        {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
        
                  </div>
            </div>

            <div class="">
                  {!! Form::number('fk_criadoPor',Auth::id(),['hidden']) !!}
                  {!! $errors->first('fk_criadoPor','<p class="alert alert-danger">:message</p>')!!}

          </div>	



            <div class="form-group">
                  {!! Form::label('dataPrevistaInicio','Data Prevista de Início* :' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('dataPrevistaInicio',null, array('class'=>'form-control','required'=>'required')) !!}
                        {!! $errors->first('dataPrevistaInicio','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>



            <div class="form-group">
                  {!! Form::label('dataPrevistaFim','Data Prevista de Fim*:' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('dataPrevistaFim',null,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('dataPrevistaFim','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>



            <div class="form-group">
                  {!! Form::label('dataInicio','Data de Início:', ['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('dataInicio',null,['class'=>'form-control']) !!}
                        
                        {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>


            <div class="form-group">
                  {!! Form::label('custoPrevisto','Custo Previsto* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('custoPrevisto',null,['class'=>'form-control','required'=>'required','placeholder'=>'Custo Previsto']) !!}
                        {!! $errors->first('custoPrevisto','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>


            <div class="form-group">
                  {!! Form::label('horasPrevistas','Horas Previstas*:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('horasPrevistas',null,['class'=>'form-control','required'=>'required','placeholder'=>'Horas Previstas']) !!}
                        {!! $errors->first('horasPrevistas','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>


            <div class="form-group">
                  {!! Form::label('observacoes','Observações:',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::textarea('observacoes',null,['class'=>'form-control','placeholder'=>'Observações','rows' => 1 ]) !!}
                        {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

            <script>
                  function showDivAreaProjeto(divId, element){
                       document.getElementById(divId).style.display = element.value == 'novaAreaProjeto' ? 'block' : 'none';
                   }
            </script>



<div class="form-group">
      {!! Form::label('fk_areaProj','Área de Projeto* :',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
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
      <br>
      <div id="hidden_div_areaProjeto">
            <div class="col-xs-12 col-sm-12 col-md-3">
                  <div class="box box-solid box-success">
                        <div class="box-header with-border" >
                              <h1 class="box-title" ><strong>CRIAR ÁREA DE PROJETO</strong></h1>
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
</div>




<div class="form-group">
      {!! Form::label('fk_urgencia','Urgência* :',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::select('fk_urgencia', $urgencia ,null, array('class' => 'form-control','required'=>'required')) !!}
            {!! $errors->first('fk_urgencia','<p class="alert alert-danger">:message</p>')!!}

      </div>
</div>

<div class="form-group">
      {!! Form::label('fk_responsavel','Responsável do Projeto*:',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::select('fk_responsavel', $responsavel ,null,
            array('class' => 'form-control','required'=>'required')) !!}
      {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}

      </div>
</div>

<div class="form-group">
      {!! Form::label('fk_cliente','Cliente*:',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::select('fk_cliente', $cliente ,null,
            array('class' => 'form-control','required'=>'required')) !!}
      {!! $errors->first('fk_cliente','<p class="alert alert-danger">:message</p>')!!}

      </div>
</div>

<div class="form-group">
      {!! Form::label('fk_departamento','Departamento* :',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::select('fk_departamento[]', $departamento, null, array('class' => 'form-control', 'id'=>'departamento',  'multiple'=>'multiple','required'=>'required')) !!}
            Pressione CTRL + Clique para escolher mais que um departamento

      </div>

</div>
<strong>* campos de preenchimento obrigatório.</strong> 


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
