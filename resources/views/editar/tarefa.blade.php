
@extends('adminlte::page')

@section('title', 'TurtleGest')


 


@section('content')

<div class="box box-success">
        <div class="box-header with-border">
                <h3 class="box-title">EDITAR UMA TAREFA</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                  {{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$task->fk_estadoIntervencao)->value('descricao')}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->




    <div class="box-body"> 
{!! Form::open(array('route' => 'tarefa.update2','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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

     
 
     
      {{-- <div class="col-xs-9 col-md-3" >    
            <div class="card">
              <img class="img-responsive"  src={{asset($tecnico->foto)}}  alt="User Avatar" width="400px">
            </div>
          </div>   --}}
    
           
    
            <div class="box-body"> 
                <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}  
                    {!! Form::label('','Nome do Colaborador',['class'=>'col-sm-2 control-label']) !!} 
                    <div class="col-sm-5">
                          {!! Form::text('',$tecnico->name,['class'=>'form-control','required'=>'required','readonly']) !!} 
                          {!! $errors->first('','<p class="alert alert-danger">:message</p>')!!} 
                          </div>
                        </div> 


             <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}  
            {!! Form::label('','Cliente (*)',['class'=>'col-sm-2 control-label']) !!} 
            <div class="col-sm-5">
                  {!! Form::text('',$projeto[0]->nomeCompleto,['class'=>'form-control','required'=>'required','readonly']) !!} 
                  {!! $errors->first('','<p class="alert alert-danger">:message</p>')!!} 
                  </div>
                </div>
        
                
                 
                    <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}
                        {!! Form::label('','Projeto (*)',['class'=>'col-sm-2 control-label']) !!} 
                        <div class="col-sm-5">
                              {!! Form::text('',$projeto[0]->codProj,['class'=>'form-control','required'=>'required','readonly']) !!}
                              <input id="fk_projeto" name="fk_projeto" type="hidden" value={{$task->fk_projeto}}> 
                              {!! $errors->first('modelo','<p class="alert alert-danger">:message</p>')!!} 
                              </div>
                    </div>
                 
                        <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}
                            {!! Form::label('','Etapa (*)',['class'=>'col-sm-2 control-label']) !!} 
                            <div class="col-sm-5">
                                  {!! Form::text('',$etapa->text,['class'=>'form-control','required'=>'required','readonly']) !!} 
                                  <input id="fk_etapa" name="fk_etapa" type="hidden" value={{$task->parent}}>
                                  {!! $errors->first('','<p class="alert alert-danger">:message</p>')!!} 
                                  </div>
                    </div>
              
                       
                    <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}
                        {!! Form::label('descricao','Descrição  (*)',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5"> 
                        {!! Form::text('descricao',str_replace('Tarefa: ', '', $task->text),['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!} 
                            </div> 
                        </div>

                    
                           <div class="form-group">
                                {!! Form::label('diaInicio','Data de Início* :',['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-5"> 
                                    @if ($task->fk_estadoIntervencao==3)
                                    {!! Form::date('diaInicio',carbon\carbon::parse($task->start_date)->format('Y-m-d'), ['class' => 'form-control','required'=>'required','readonly']) !!} 

                                    @else
                                    {!! Form::date('diaInicio',carbon\carbon::parse($task->start_date)->format('Y-m-d'), ['class' => 'form-control','required'=>'required']) !!} 

                                    @endif
                                    {!! $errors->first('diaInicio','<p class="alert alert-danger">:message</p>')!!} 
                                </div> 
                              </div>
                          
                            
                              <div class="form-group">
                                    {!! Form::label('horaInicio','Hora de Início* :',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5"> 
                                    @if ($task->fk_estadoIntervencao==3)
                                    {!! Form::time('horaInicio',carbon\carbon::parse($task->start_date)->format('H:i'), ['class' => 'form-control','required'=>'required','readonly']) !!} 

                                    @else
                                    {!! Form::time('horaInicio',carbon\carbon::parse($task->start_date)->format('H:i'), ['class' => 'form-control','required'=>'required']) !!} 

                                    @endif
                                        {!! $errors->first('horaInicio','<p class="alert alert-danger">:message</p>')!!} 
                                    </div>
                                </div>
                           

                                <div class="form-group">
                                    {!! Form::label('diaFim','Data de Início* :',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5"> 
                                        @if ($task->fk_estadoIntervencao==3)

                                        {!! Form::date('diaFim',carbon\carbon::parse($task->end_date)->format('Y-m-d'), ['class' => 'form-control','required'=>'required','readonly']) !!} 

                                        @else
                                        {!! Form::date('diaFim',carbon\carbon::parse($task->end_date)->format('Y-m-d'), ['class' => 'form-control','required'=>'required']) !!} 

                                        @endif
                                        {!! $errors->first('diaFim','<p class="alert alert-danger">:message</p>')!!} 
                                    </div> 
                                    </div>
                                 
                                   
                                    <div class="form-group">
                                        {!! Form::label('horaFim','Hora de Fim* :',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-5"> 
                                            @if ($task->fk_estadoIntervencao==3)

                                            {!! Form::time('horaFim',carbon\carbon::parse($task->end_date)->format('H:i'), ['class' => 'form-control','required'=>'required','readonly']) !!} 

                                            @else
                                            {!! Form::time('horaFim',carbon\carbon::parse($task->end_date)->format('H:i'), ['class' => 'form-control','required'=>'required']) !!} 

                                            @endif
                                            {!! $errors->first('horaFim','<p class="alert alert-danger">:message</p>')!!} 
                                        </div>
                                    </div>
                                    
                            <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

                              <div class="form-group">
                                      {!! Form::label('relatorio','Relatório (*):',['class'=>'col-sm-2 control-label']) !!}
                                      <div class="col-sm-9"> 
                                      @if ($task->fk_estadoIntervencao==3)
                                      <textarea  name="relatorio" required >{!!$task->relatorio!!}</textarea>
                                      @else
                                      <textarea  name="relatorio" ></textarea>
                                      @endif
                                
                                      <script>
                                              CKEDITOR.replace( 'relatorio' );
                                      </script>
                                </div>
                          </div>  </div>
                            <br><br>
                          <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-18" >
                                  <button type="submit" class="btn btn-success pull-right">Enviar</button> 
                                  <input id="id_task" name="id_task" type="hidden" value={{$task->id}}>
                               <div class="col-xs-12 col-sm-12 col-md-11" >
                                  <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                                     Voltar</button></a>
                      
                               </div>
                            </div>
                           
                         </div>
                        </div>
            </div>  
{!! Form::close()!!}



@stop

