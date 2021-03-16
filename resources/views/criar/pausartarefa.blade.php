@extends('adminlte::page')

@section('title', 'Relatório de Tarefa')


@section('content')
    <div class="row">
        <div class="col-xs-7 col-sm-7 col-md-7">
            <div class="box   box-success">
                <div class="box-header with-border" >
                    <h1 class="box-title" ><strong>RELATÓRIO DE TAREFA</strong></h1>
                </div>
                <div class="box-body">
              <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

                        {!! Form::open(array('route' => ['tarefa.update'],'method'=>'POST','files'=>'true')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('relatorio','Relatório* :') !!}
                                    <br>
                                    <textarea  name="relatorio" required ></textarea>
                                    <script>
                                            CKEDITOR.replace( 'relatorio' );
                                    </script>                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
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
                    <div class="row">
                        <div id="radioButtons"class="col-xs-12 col-sm-12 col-md-4">
                                <label for="radioLabel">Pretende reagendar esta tarefa ?</label>
                                <br>
                                <input type="radio" name="Agendar" id="radio_Sim" value="1" required="" >Sim
                                <br>
                                <input type="radio" name="Agendar" id="radio_Nao" value="0" required>Não
                            </div> 

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <span><p>Indique a percentagem de conclusão da tarefa*</p></span>
                                <style>input[type=range]{-webkit-appearance:none;width:100%;background:transparent}input[type=range]::-webkit-slider-thumb{-webkit-appearance:none}input[type=range]:focus{outline:none}input[type=range]::-ms-track{width:100%;cursor:pointer;background:transparent;border-color:transparent;color:transparent}</style><style>input[type=range]::-webkit-slider-thumb{-webkit-appearance:none;border:1px solid #000;height:36px;width:16px;border-radius:3px;background:#fff;cursor:pointer;margin-top:-14px;box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d}input[type=range]::-moz-range-thumb{box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d;border:1px solid #000;height:36px;width:16px;border-radius:3px;background:#fff;cursor:pointer}input[type=range]::-ms-thumb{box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d;border:1px solid #000;height:36px;width:16px;border-radius:3px;background:#fff;cursor:pointer}input[type=range]::-webkit-slider-runnable-track{width:100%;height:8.4px;cursor:pointer;box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d;background:#40a431;border-radius:1.3px;border:.2px solid #010101}input[type=range]:focus::-webkit-slider-runnable-track{background:#40a431}input[type=range]::-moz-range-track{width:100%;height:8.4px;cursor:pointer;box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d;background:#3071a9;border-radius:1.3px;border:.2px solid #010101}input[type=range]::-ms-track{width:100%;height:8.4px;cursor:pointer;background:transparent;border-color:transparent;border-width:16px 0;color:transparent}input[type=range]::-ms-fill-lower{background:#2a6495;border:.2px solid #010101;border-radius:2.6px;box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d}input[type=range]:focus::-ms-fill-lower{background:#40a431}input[type=range]::-ms-fill-upper{background:#40a431;border:.2px solid #010101;border-radius:2.6px;box-shadow:1px 1px 1px #000000,0 0 1px #0d0d0d}input[type=range]:focus::-ms-fill-upper{background:#40a431}</style>
                                <div class="range-field">
                                        <input type="range" name="percentagem"min="0" max="100" />
                                    </div>
                                    <div style="text-align: center; padding-top:20px;font-size:20px">
                                            <span class="pull-left">0</span>
                                            
                                                    <span >50</span>
                                               
                                            
                                            <span class="pull-right">100</span>
                                        </div>
                        </div>
                    </div>
                        <br>
                        <script>
                            var radio = document.getElementsByName('Agendar'); 
            
                            for (var i = 0; i < radio.length; i++) {
                                radio[i].onclick = function() {
                                var valorRadio = this.value; 
            
                                    if(valorRadio == '1'){ 
                                    document.getElementById("reagendar_tarefa").className = "";  
                                    }
                                    else if(valorRadio == '0'){
                                    document.getElementById("reagendar_tarefa").className = "hidden"; 
                                    }
                                }
                            }
                        </script>

                        <div class="hidden" id="reagendar_tarefa" class="form-group"> {{-- radio button "É cliente" = "sim". São apresentados os campos para: nome, email e telefone --}}
                            <div class="row">
                              
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    {!! Form::label('horaInicioPrev','Hora Inicio Previsto :') !!}
                                    <br>
                                  
                                    {!! Form::dateTimeLocal('horaInicioPrev',null, array('class'=>'form-control')) !!}
                                </div>
                               
                            </div>
                        </div>

                        <br>
                        <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" ></div>
                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
        
                            <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$task->id}}>
                              <button type="submit" class="btn btn-success">Adicionar Relatório
                             </button></a> 
                              {!! Form::close()!!}
                        </div>



                       


                        {!! Form::close()!!}                    
                </div>
            </div>
        </div>
        <div class="col-xs-5 col-sm-5 col-md-5">
            <div class="box   box-success">
                <div class="box-header with-border" >
                    <h1 class="box-title" >DADOS DE TAREFA</h1>
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