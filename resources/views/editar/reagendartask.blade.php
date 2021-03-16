@extends('adminlte::page')

@section('Cargos', 'AdminLTE')




@section('content')
<div class="box   box-success">
            <div class="box-header with-border" >
                    <h1 class="box-title" >EDITAR UM HORÁRIO</h1>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

    <div class="box-body">

{!! Form::open(array( 'route' => ['horario.update',$horario->pk_horario],'method'=>'POST','files'=>'true')) !!}
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
    <div class="row">
   
       
            <div class="col-xs-12 col-sm-12 col-md-2">
                    <div class="form-group">
                            {!! Form::label('descricao','Descrição* :') !!}
                            <div class="">
                                  {!! Form::text('descricao',$horario->descricao,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                  {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                
                            </div>
                      </div>
               
                </div>
    </div>

      <div class="row">
   
       
                  <div class="col-xs-12 col-sm-12 col-md-2">
                       
                                <div class="form-group">
                                      {!! Form::label('horaEntrada','Hora de Entrada* :') !!}
                                      <div class="">
                                            {!! Form::time('horaEntrada',$horario->horaEntrada,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                            {!! $errors->first('horaEntrada','<p class="alert alert-danger">:message</p>')!!}
                          
                                      </div>
                                </div>
                         
                          </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                    <div class="form-group">
                            {!! Form::label('horaSaida','Hora de Saída* :') !!}
                            <div class="">
                                  {!! Form::time('horaSaida',$horario->horaSaida,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                  {!! $errors->first('horaSaida','<p class="alert alert-danger">:message</p>')!!}
                
                                    </div>
                              
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2">
                            <div class="form-group">
                                    {!! Form::label('duracaoAlmoco','Duração de Almoço* :') !!}
                                    <div class="">
                                          {!! Form::time('duracaoAlmoco',$horario->duracaoAlmoco,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                          {!! $errors->first('duracaoAlmoco','<p class="alert alert-danger">:message</p>')!!}
                        
                                            </div>
                                      
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                    <div class="form-group">
                                            {!! Form::label('almocoApartir','Almoço a partir de* :') !!}
                                            <div class="">
                                                  {!! Form::time('almocoApartir',$horario->almocoApartir,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                  {!! $errors->first('almocoApartir','<p class="alert alert-danger">:message</p>')!!}
                                
                                                    </div>
                                              
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                            <div class="form-group">
                                                    {!! Form::label('almocoAte','Almoço até* :') !!}
                                                    <div class="">
                                                          {!! Form::time('almocoAte',$horario->almocoAte,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                          {!! $errors->first('almocoAte','<p class="alert alert-danger">:message</p>')!!}
                                        
                                                            </div>
                                                      
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-2">
                                                    <div class="form-group">
                                                            {!! Form::label('horasDiarias','Horas Diárias* :') !!}
                                                            <div class="">
                                                                  {!! Form::time('horasDiarias',$horario->horasDiarias,['class'=>'form-control' ,'rows' => 1 ]) !!}
                                                                  {!! $errors->first('horasDiarias','<p class="alert alert-danger">:message</p>')!!}
                                                
                                                                    </div>
                                                              
                                                        </div>
                                                    </div>
                            
                  </div>
                 

                
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                      {!! Form::label('visivel','Visibilidade* :') !!}
                            
                                      <div class="">
                                            @if ($horario->visivel == 1)
                                            {{ Form::radio('visivel', 1, true, ['checked' => 'checked']) }} Visível
                                            <br />
                                            {{ Form::radio('visivel', 0, false, []) }} Invisível
                                        @else
                                            {{ Form::radio('visivel',1, false, []) }} Visível
                                            <br />
                                            {{ Form::radio('visivel', 0, true, ['checked' => 'checked']) }} Invisível
                                        @endif
                                            {!! $errors->first('visivel','<p class="alert alert-danger">:message</p>')!!}
                            
                                      </div>
                                </div>
                            </div>
</div>


{{-- <div class="col-xs-1 col-sm-1 col-md-1 text-center pull-right"> &nbsp; <br>
  {!! Form::submit('Adicionar Departamento', ['class'=>'btn btn-success']) !!}
      
</div> --}}
</div>
<div class="row" align="center">
        <div class="col-xs-12 col-sm-12 col-md-4" >

            </div>
            <div class="col-xs-12 col-sm-12 col-md-2" >
                    <a href="" ><button type="submit" class="btn btn-block btn-success btn-flat">
                            Alterar Horário</button></a>
                </div>

                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                    Voltar</button></a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4" >

            </div>
</div><br><br>

{!! Form::close()!!}
</div>
@stop
