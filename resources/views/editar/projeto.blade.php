@extends('adminlte::page')
@section('Projeto', 'Editar')

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
</style>

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<div class="box   box-success">
        <div class="box-header with-border" >
            <h1 class="box-title" >EDITAR UM PROJETO</h1>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        {!! Form::open(array('route' => ['projeto.update',$projeto->pk_projeto],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}

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
                  {!! Form::label('codProj','Código de Projeto (*):',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('codProj',$projeto->codProj,['class'=>'form-control']) !!}
                        {!! $errors->first('codProj','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('nomeProjeto','Nome do projeto (*):',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::text('nomeProjeto',$projeto->nomeProjeto,['class'=>'form-control']) !!}
                        {!! $errors->first('nomeProjeto','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('descricaoProjeto','Descrição (*):',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::text('descricaoProjeto',$projeto->descricaoProjeto,['class'=>'form-control']) !!}
                        {!! $errors->first('descricaoProjeto','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('dataPrevistaInicio','Data Prevista de Inicio (*):',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::date('dataPrevistaInicio',$projeto->dataPrevistaInicio,['class'=>'form-control']) !!}
                        {!! $errors->first('dataPrevistaInicio','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('dataInicio','Data de Inicio:',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::date('dataInicio',$projeto->nomeProjeto,['class'=>'form-control']) !!}
                        {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>


            <div class="form-group">
                  {!! Form::label('dataPrevistaFim','Data Prevista de Fim:',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::date('dataPrevistaFim',$projeto->dataPrevistaFim,['class'=>'form-control']) !!}
                        {!! $errors->first('dataPrevistaFim','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('dataFim','Data de Fim:',['class'=>'col-sm-2 control-label']) !!}
      
                  <div class="col-sm-5">
                        {!! Form::date('dataFim',$projeto->dataFim,['class'=>'form-control']) !!}
                        {!! $errors->first('dataFim','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
            </div>

      
                  <div class="form-group">
                          {!! Form::label('custoPrevisto','Custo Previsto (*):',['class'=>'col-sm-2 control-label']) !!}
              
                          <div class="col-sm-5">
                              {!! Form::text('custoPrevisto',$projeto->custoPrevisto,['class'=>'form-control']) !!}
                                {!! $errors->first('custoPrevisto','<p class="alert alert-danger">:message</p>')!!}
             
                          </div>
                    </div>
        

          <div class="form-group">
            {!! Form::label('custoReal','Custo Real:',['class'=>'col-sm-2 control-label']) !!}

            <div class="col-sm-5">
                  @if ($projeto->custoReal == null)
                  {!! Form::text('custoReal','NA',['class'=>'form-control']) !!}
                  @else
                  {!! Form::text('custoReal',$projeto->custoReal,['class'=>'form-control']) !!}
                  {!! $errors->first('custoReal','<p class="alert alert-danger">:message</p>')!!}

                  @endif
               
            </div>
      </div>

      <div class="form-group">
            {!! Form::label('horasPrevistas','Horas Previstas:',['class'=>'col-sm-2 control-label']) !!}

            <div class="col-sm-5">
                  {!! Form::text('horasPrevistas',$projeto->horasPrevistas/3600,['class'=>'form-control']) !!}
                  {!! $errors->first('horasPrevistas','<p class="alert alert-danger">:message</p>')!!}

            </div>
      </div>

      <div class="form-group">
            {!! Form::label('horasGastas','Horas Gastas:',['class'=>'col-sm-2 control-label']) !!}
 
            <div class="col-sm-5">
                  {!! Form::text('horasGastas',$projeto->horasGastas/3600,['class'=>'form-control']) !!}
                  {!! $errors->first('horasGastas','<p class="alert alert-danger">:message</p>')!!}
                  <input id="invisible_id" name="fk_criadoPor" type="hidden" value={{$projeto->fk_criadoPor}}>
                  <input id="invisible_id" name="fk_empresa" type="hidden" value={{$projeto->fk_empresa}}>

            </div>
      </div>

      <div class="form-group">
            {!! Form::label('observacoes','Observações:',['class'=>'col-sm-2 control-label']) !!}

            <div class="col-sm-5">
                  @if ($projeto->observacoes == '')
                  {!! Form::textarea('observacoes',null,['class'=>'form-control', 'rows' => 1, 'placeholder'=>"NA"]) !!}
                  @else
                  {!! Form::textarea('observacoes',$projeto->observacoes,['class'=>'form-control', 'rows' => 1 ]) !!}
                  {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}  
                  @endif
            </div>
      </div>

      <div class="form-group">

                              

            {!! Form::label('visivel','Visibilidade (*):',['class'=>'col-sm-2 control-label']) !!}

            <div class="col-sm-5">
                  @if ($projeto->visivel == 1)
                      {{ Form::radio('visivel', 1, true, ['checked' => 'checked']) }} Visível 
                      &nbsp;&nbsp;&nbsp;
                      {{ Form::radio('visivel', '0', false, []) }} Invisível  
                  @else
                      {{ Form::radio('visivel', '1', false, []) }} Visível  
                      &nbsp;&nbsp;&nbsp;
                      {{ Form::radio('visivel', '0', true, ['checked' => 'checked']) }} Invisível 
                  @endif
                  {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
  
          </div>
      </div>


      <div class="form-group">
            {!! Form::label('fk_areaProj','Area de Projeto (*):',['class'=>'col-sm-2 control-label']) !!}
            
            <div class="col-sm-5">
                  {!! Form::select('fk_areaProj', $area ,$projeto->fk_areaProj,
                   array('class' => 'form-control')) !!}
                  {!! $errors->first('fk_areaProj','<p class="alert alert-danger">:message</p>')!!}
                  
                   </div>

            </div>

            <div class="form-group">
                  {!! Form::label('fk_urgencia','Urgência (*):',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_urgencia', $urgencia ,$projeto->fk_urgencia,
                              array('class' => 'form-control')) !!}
                        {!! $errors->first('fk_urgencia','<p class="alert alert-danger">:message</p>')!!}
      
                  </div>
      </div>
      <div class="form-group">
            {!! Form::label('fk_responsavel','Responsavel do Projeto (*):',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::select('fk_responsavel', $responsavel ,$projeto->fk_responsavel,
                        array('class' => 'form-control')) !!}
                  {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}

            </div>
</div>


   
                  <div class="form-group">
                              {!! Form::label('fk_cliente','Cliente (*):',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::select('fk_cliente', $cliente ,$projeto->fk_cliente,
                                          array('class' => 'form-control')) !!}
                                    {!! $errors->first('fk_cliente','<p class="alert alert-danger">:message</p>')!!}
                  
                              </div>
                        </div>
    
                        <div class="col-xs-12 col-sm-12 col-md-2">
                        </div>
      <div class="col-xs-12 col-sm-12 col-md-3">

<div class="box box-success">
      <div class="box-header with-border">
                                <h3 class="box-title">Departamentos no Projeto</h3>
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body">
                                <table class="table table-bordered">
                                  <tbody><tr>
                                    <th>Departamento</th>
                                    <th style="width: 40px">Participa?</th>
                                    <th style="width: 40px">Label</th>
                                  </tr>
                                 

                                    @foreach ($departamentonoprojeto as $dep)
                                    <tr>
                                    <td>{{$dep->abreviatura}}</td>
                                
                                  
                                     
                                    <td><span class="badge bg-green far fa-check-circle"> </span></td>
                              
                                    
                                   <td> <a href="{{url('/')}}/removerdepproj/{{$dep->pk_departamento}}/{{$projeto->pk_projeto}}" class="btn btn-danger btn-sm fas fa-trash" title="Remover Departamento"></a> {{--Editar recurso--}}
                                   </td>
                         
                        
                                          </tr>
                                   @endforeach
                                      @foreach ($departamento as $dep)
                                    <tr>
                                    <td>{{$dep->abreviatura}}</td>
                                
                                  
                                     
                                    <td><span class="badge bg-red far fa-times-circle"> </span></td>
                                    
                              

                                <td>
                                <a href="{{url('/')}}/adicionardepproj/{{$dep->pk_departamento}}/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm fas fa-plus-circle" title="Adicionar Departamento"></a> {{--Editar recurso--}}
                                </td>
                                         
                         
                        
                                          </tr>
                                    @endforeach
                                   
                                  
                                
                                </tbody></table>
                              </div>
                              <!-- /.box-body -->
                         
                            </div>


                  {{-- <div class="form-group">



                              {!! Form::label('fk_departamento','Departamento* :') !!}
                        <div> 
                              {!! Form::select('fk_departamento[]', $departamento,  $departamento, array('class' => 'form-control', 'id'=>'departamento',  'multiple'=>'multiple')) !!}
                        </div>
                        Pressione CRL + Clique para escolher mais que um departamento
                     </div> --}}
      </div>

</div>


<script  type="text/javascript">
      $('#empresa').on('change', function(e){
          console.log(e);
          var pk_empresa = e.target.value;

      $.get('/ajax-departamento?pk_empresa='+ pk_empresa, function(data){
      $('#departamento').empty();
      $.each(data, function(index, departamentoObj){
                                                                                                      /*nome do departamento*/
      $('#departamento').append('<option value="' + departamentoObj.fk_departamento + '">' + departamentoObj.abreviatura + '</option>');
            });
      });
      });
  </script>

<div class="box-footer">
      <div class="col-xs-12 col-sm-12 col-md-18" >
            <button type="submit" class="btn btn-success pull-right">Enviar</button>


         <div class="col-xs-12 col-sm-12 col-md-11" >
            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
               Voltar</button></a>

         </div>
      </div>
     
   </div>
      </div>


     

                  


      {!! Form::close()!!}
</div>



@stop
