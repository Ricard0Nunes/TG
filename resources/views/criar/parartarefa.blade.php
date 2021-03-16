@extends('adminlte::page')
@section('title', 'Relatório de Tarefa')
@section('content')
    <div class="row">
        <div class="col-xs-7 col-sm-7 col-md-7">
            <div class="box   box-success">
                <div class="box-header with-border" >
                    <h1 class="box-title" >RELATÓRIO DE TAREFA</h1>
                </div>
                <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                <div class="box-body">
                        {!! Form::open(array('route' => ['tarefa.update'],'method'=>'POST','files'=>'true')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::label('relatorio','Relatório :') !!}
                                    <textarea  name="relatorio" required ></textarea>
                                    <script>
                                            CKEDITOR.replace( 'relatorio' );
                                    </script>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('observação','Observações :') !!}
                                        <br>
                                        {!! Form::textarea('observação', null, ['rows' => 4, 'cols' => 54, 'style' => 'resize:resize']) !!}
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    {!! Form::label('','Adicionar produtos* :') !!}
                                    <br>
                                    {!! Form::text('',null,array('class'=>'form-control','readonly', 'placeholder'=>'Adicionar produtos (a terminar)','required'=>'required')) !!}      
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    {!! Form::label('','Adicionar despesas* :') !!}
                                    <br>
                                    {!! Form::text('',null,array('class'=>'form-control','readonly', 'placeholder'=>'Adicionar despesas (a terminar)','required'=>'required')) !!}      
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" align="center">
                                <div class="col-xs-12 col-sm-12 col-md-4" ></div>
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
            
                               <input id="invisible_id" name="id" type="hidden" value={{$task->id}}>
                                  <button type="submit" class="btn btn-success">Adicionar Relatório
                                 </button>
                                  {!! Form::close()!!}
                            </div>
                        {!! Form::close()!!}                    
                </div>
            </div>
        </div>
        <div class="col-xs-5 col-sm-5 col-md-5">
            <div class="box   box-success">
                <div class="box-header with-border" >
                    <h1 class="box-title" ><strong>DADOS DE TAREFA</strong></h1>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('fk_projeto',' Projeto:') !!}
                                <br>
                                {!! Form::text('fk_projeto',DB::table('projetos')->where('pk_projeto', '=', $task->fk_projeto)->value('nomeProjeto'),array('class'=>'form-control','readonly')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('text','Nome da tarefa :') !!}
                                <br>
                                {!! Form::text('text',$task->text,array('class'=>'form-control','readonly')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('duration','Duração tarefa :') !!}
                                <br>
                                {!! Form::text('duration',$task->duration,array('class'=>'form-control','readonly')) !!}
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('start_date','Data de Inicio :') !!}
                                <br>
                                {!! Form::text('start_date',$task->start_date,array('class'=>'form-control','readonly')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('horaInicioPrev','Hora Inicio Previsto :') !!}
                                <br>
                                @if ($task->horaInicioPrev == null)
                                {!! Form::text('horaInicioPrev','00:00:00',array('class'=>'form-control','readonly')) !!}
                                @else
                                {!! Form::text('horaInicioPrev',$task->horaInicioPrev,array('class'=>'form-control','readonly')) !!}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('end_date','Hora Fim Previsto :') !!}
                                <br>
                                @if ($task->end_date == null)
                                {!! Form::text('end_date','00:00:00',array('class'=>'form-control','readonly')) !!}  
                                @else
                                {!! Form::text('end_date',$task->end_date,array('class'=>'form-control','readonly')) !!} 
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                {!! Form::label('horaInicio',' Hora de Inicio:') !!}
                                <br>
                                @if ($task->horaInicio == null)
                                {!! Form::text('horaInicio','00:00:00',array('class'=>'form-control','readonly')) !!} 
                                @else
                                {!! Form::text('horaInicio',$task->horaInicio,array('class'=>'form-control','readonly')) !!}    
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    {!! Form::label('end_date',' Hora de Fim:') !!}
                                    <br>
                                    @if ($task->end_date == null)
                                    {!! Form::text('end_date','00:00:00',array('class'=>'form-control','readonly')) !!} 
                                    @else
                                    {!! Form::text('end_date',$task->end_date,array('class'=>'form-control','readonly')) !!}   
                                    @endif
                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                        {!! Form::label('duracaoHorasReal',' Duração da tarefa (real):') !!}
                                        <br>
                                        @if ($task->duracaoHorasReal == null)
                                        {!! Form::text('duracaoHorasReal','00:00:00',array('class'=>'form-control','readonly')) !!} 
                                        @else
                                        {!! Form::text('duracaoHorasReal',$task->duracaoHorasReal,array('class'=>'form-control','readonly')) !!}
                                        @endif
                                    </div>
                        </div>
                     
                    </div>

                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                                {!! Form::label('duracaoHorasEstimado',' Duração da tarefa (estimado):') !!}
                                                <br>
                                                @if ($task->duracaoHorasEstimado == null)
                                                {!! Form::text('duracaoHorasEstimado','00:00:00',array('class'=>'form-control','readonly')) !!} 
                                                @else
                                                {!! Form::text('duracaoHorasEstimado',$task->duracaoHorasEstimado,array('class'=>'form-control','readonly')) !!}
                                            
                                                @endif
                                             </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                                {!! Form::label('custoPrevisto',' Custo previsto:') !!}
                                                <br>
                                                @if ($task->custoPrevisto == null)
                                                {!! Form::text('custoPrevisto','NA',array('class'=>'form-control','readonly')) !!}
                                                @else
                                                {!! Form::text('custoPrevisto',$task->custoPrevisto,array('class'=>'form-control','readonly')) !!}
                                                @endif
                                            </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                    <div class="form-group">
                                                {!! Form::label('custoReal',' Custo real:') !!}
                                                <br>
                                                @if ($task->custoReal == null)
                                                {!! Form::text('custoReal','NA',array('class'=>'form-control','readonly')) !!}
                                                @else
                                                {!! Form::text('custoReal',$task->custoReal,array('class'=>'form-control','readonly')) !!}
                                                @endif
                                              </div>
                            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop