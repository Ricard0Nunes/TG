@extends('adminlte::page')
@section('Requisição', 'AdminLTE')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
@section('content')
<style>
      SELECT {
            width: 100%;
            box-sizing: border-box;
      }
  

    
</style>
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">EDITAR UMA REQUISIÇÃO DE CARRO</h3>
      </div>
      {!! Form::open(array('route' => 'requisicaocarro.update','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('requisitante','Requisitante (*):' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('requisitante',$user,['class'=>'form-control','readonly']) !!}
                        {!! $errors->first('requisitante','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('dataPartida','Data (*):' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::date('dataPartida',$requisicao->dataPartida,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('dataPartida','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('partidaPrevista','Hora Prev. de Partida' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('partidaPrevista',$requisicao->partidaPrevista,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('partidaPrevista','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
           
            <div class="form-group">
                  {!! Form::label('chegadaPrevista','Hora Prev. de Chegada' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::time('chegadaPrevista',$requisicao->chegadaPrevista,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('chegadaPrevista','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('rota','Rota (*):' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('rota',$requisicao->rota,['class'=>'form-control','required'=>'required','placeholder' => 'Local Partida-Destino-Local Partida' ]) !!}
                        {!! $errors->first('rota','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('ocupantes','Ocupantes:' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">

                        <div class="hidden" >  @foreach (explode( ',', $requisicao->ocupantes) as $string)
                  
                               {{$string1[]=$string}}
         
                               @endforeach
                              
                            
                              {{   $var= json_encode(array_map('trim',$string1))}}
                        </div>

                        {!! Form::select('ocupantes[]', $users,json_decode($var), array('class' => 'form-control', 'id'=>'departamento',  'multiple'=>'multiple')) !!}
                        Pressione CTRL + Clique para escolher mais que um ocupante

                  </div>
            </div>

            <div class="form-group">
                  {!! Form::label('fk_veiculo','Veículo (*):' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_veiculo', $veiculo,$requisicao->fk_veiculo,array('class' => 'form-control', 'id'=>'fk_veiculo','required'=>'required', 'placeholder' => 'Escolha o Veículo' )) !!}
                        {!! $errors->first('fk_veiculo','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('notas','Notas' ,['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::textarea('notas',null,['class'=>'form-control','rows'=>4]) !!}
                        {!! $errors->first('notas','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
         
            <div class="form-group">
                  {!! Form::label('opcoes','Projeto:      |      Sprint:     |     Cliente:' ,['class'=>'col-sm-2 control-label']) !!}

                  <div class="col-sm-6" >
                        <select  id="rightValues" size="5" multiple>
                              @for ($i = 0; $i < count($tasks); $i++)
                                    <option  value={{$tasks[$i]->id}}>
                                          {{' '.DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('codProj')}}
                                          | {{$tasks[$i]->text}} | 
                                          {{DB::table('clientes')->where('pk_cliente',DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('fk_cliente'))->value('nomeAbreviado')}}
                                    </option>
                              @endfor     
                        </select>
                  </div>
            </div>
           
            <div class="form-group">
                  {!! Form::label('notas','Selecione a/s sprint/s que envolvêm a requisição.' ,['class'=>'col-sm-2 control-label']) !!}

                  <div class="col-sm-5" style="text-align:center;">
                
                        <input type="button" class="btn btn-light btn-sm" id="btnRight" value="ʌ" /><br><br>

                        <input type="button" class="btn btn-light btn-sm" id="btnLeft" value="v" />

                  </div>
            </div>
         
            <div class="form-group">
                  {!! Form::label('selecionados','Selecionados:' ,['class'=>'col-sm-2 control-label']) !!}

                  <div class="col-sm-6">
                        <select name="sprints[]" id="leftValues" size="5" multiple required>
                              @for ($i = 0; $i < count($custosextra); $i++)
                              <option  value={{$custosextra[$i]->fk_sprint}} selected>
                                    {{' '.DB::table('projetos')->where('pk_projeto',$custosextra[$i]->fk_projeto)->value('codProj')}}
                                    | {{$custosextra[$i]->nomeSprint}} | 
                                    {{DB::table('clientes')->where('pk_cliente',DB::table('projetos')->where('pk_projeto',$custosextra[$i]->fk_projeto)->value('fk_cliente'))->value('nomeAbreviado')}}
                              </option>
                        @endfor 
                        </select>
                  </div>
            </div>
           
                        {{-- <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-5">           
                                          <p><span><strong>Selecionados:</strong></span></p>
                                          <input id="invisible_id" name="sprints[]" type="hidden" value=null>
                                          <select name="sprints[]" id="leftValues" size="5" multiple ></select>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-2" style="text-align:center;">     
                                          <p> <strong>Selecione a/s sprint/s <br> que envolvêm a requisição.</strong></p>
                                          <input type="button" id="btnLeft" value="&lt;&lt;" />
                                          <input type="button" id="btnRight" value="&gt;&gt;" />
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-5">     
                                    <p><span> <strong>Projeto:      |      Sprint:     |     Cliente:</strong></span></p> 
                                    <select  id="rightValues" size="5" multiple>
                                          @for ($i = 0; $i < count($tasks); $i++)
                                                <option  value={{$tasks[$i]->id}}>
                                                      {{' '.DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('codProj')}}
                                                      | {{$tasks[$i]->text}} | 
                                                      {{DB::table('clientes')->where('pk_cliente',DB::table('projetos')->where('pk_projeto',$tasks[$i]->fk_projeto)->value('fk_cliente'))->value('nomeAbreviado')}}
                                                </option>
                                          @endfor     
                                    </select>
                              </div>
                        </div>    --}}
                
            
      </div>
      <br>
    
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
      {{-- <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br> 
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br>
      <br> <br> <br> <br> <br> <br> --}}
 
<script>
      $("#btnLeft").click(function () {
            var selectedItem = $("#rightValues option:selected");
            $("#leftValues").append(selectedItem);
      });
  
      $("#btnRight").click(function () {
            var selectedItem = $("#leftValues option:selected");
            $("#rightValues").append(selectedItem);
      });
  
      $("#rightValues").change(function () {
            var selectedItem = $("#rightValues option:selected");
            $("#txtRight").val(selectedItem.text());
      });
</script>
@stop
