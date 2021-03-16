@extends('adminlte::page')
@section('Equipamento', 'AdminLTE')
@section('content')
      <div class="box box-success">
            <div class="box-header with-border">
                  <h3 class="box-title">CRIAR MANUTENÇÃO</h3>
            </div>
            {!! Form::open(array('route' => 'manutencao.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                              {!! Form::label('dataInicio','Data de Inicio(*)',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::date('dataInicio',null,['class'=>'form-control','required'=>'required']) !!}
                                    {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('dataFim','Data de Fim',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::date('dataFim',null,['class'=>'form-control']) !!}
                                    {!! $errors->first('dataFim','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>

                        <div class="form-group">
                              {!! Form::label('descricaoProblema','Descrição Problema',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::text('descricaoProblema',null,['class'=>'form-control','placeholder'=>'Descrição do problema','required'=>'required']) !!}
                                    {!! $errors->first('descricaoProblema','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('resolucaoProblema','Resolução Problema',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::text('resolucaoProblema',null,['class'=>'form-control','placeholder'=>'Resolução do problema']) !!}
                                    {!! $errors->first('resolucaoProblema','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::textarea('observacoes',null,['class'=>'form-control','rows'=>3,'placeholder'=>'Observações']) !!}
                                    {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('proximaVerificacao','Próxima Verificação',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::date('proximaVerificacao',null,['class'=>'form-control']) !!}
                                    {!! $errors->first('proximaVerificacao','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('tecnico','Tecnico',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::text('tecnico',($tecnico[0]->sigla) . " - " .$tecnico[0]->name  ,['class'=>'form-control','readonly']) !!}
                                    <input id="invisible_id" name="tecnico" type="hidden" value={{$tecnico[0]->bi}}>
                                    {!! $errors->first('tecnico','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        <div class="form-group">
                              {!! Form::label('fk_tipo','Tipo',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::select('fk_tipo', $tipo ,null,array('class' => 'form-control', 'id'=>'tipo', 'placeholder' => 'Escolha tipo Manutenção','required'=>'required' )) !!}
                                    {!! $errors->first('fk_tipo','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div> 
                        @if ($tipoEqu==0)
                        <div class="form-group">
                              {!! Form::label('equipamento','Equipamento',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {!! Form::text('equipamento',$equipamento->codigo,['class'=>'form-control','readonly']) !!}
                                    <input id="invisible_id" name="equipamento" type="hidden" value={{$equipamento->pk_equipamento}}>
                                    {!! $errors->first('fk_equipamento','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        @else
                        <div class="form-group">
                              {!! Form::label('fk_veiculo','Veiculo',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                    {{-- {!! Form::select('fk_veiculo', $veiculo ,null,array('class' => 'form-control', 'id'=>'veiculo', 'placeholder' => 'Veiculo','required'=>'required' )) !!} --}}
                                    {!! $errors->first('fk_veiculo','<p class="alert alert-danger">:message</p>')!!}
                              </div>
                        </div>
                        @endif
                  </div>
                  <div class="box-footer ">
                        <button type="submit" class="btn btn-success pull-right">Enviar</button>
                  </div>
            {!! Form::close()!!}
      </div>
@stop
