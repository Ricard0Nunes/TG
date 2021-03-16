 
@extends('adminlte::page')

@section('Etapa', 'AdminLTE')




@section('content')
<div class="box box-success">
        <div class="box-header with-border">
                <h3 class="box-title">CRIAR UMA ETAPA</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
   
   
   
<div class="box-body">
{!! Form::open(array('route' => 'etapa.guardar','method'=>'POST','files'=>'true','class'=>'form-horizontal' )) !!}
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







      <div class="box-body"> 
            <div class="form-group">
            {!! Form::label('descricao','Descrição* :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('descricao',null,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!} 
            </div> 
            </div>

           
            <div class="form-group">
              {!! Form::label('start_date','Data de Início* :',['class'=>'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                    {!! Form::dateTimeLocal('start_date',null,['class'=>'form-control','required'=>'required']) !!}
                    {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>')!!} 
              </div>
        </div>
   
 
         <div class="form-group">
              {!! Form::label('end_date','Data de Fim* :',['class'=>'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                    {!! Form::dateTimeLocal('end_date',null,['class'=>'form-control','required'=>'required']) !!}
                    {!! $errors->first('end_date','<p class="alert alert-danger">:message</p>')!!} 
              </div> 
         </div>
    
         <div class="form-group">
                    {!! Form::label('fk_tecnico','Responsável* :',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                          {!! Form::select('fk_tecnico',$tecnico,null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                          {!! $errors->first('fk_tecnico','<p class="alert alert-danger">:message</p>')!!} 
                </div>
            </div>
                      <input type="hidden" name="fk_projeto"value="{{$projetos->pk_projeto}}">
          
                    <div class="form-group">
                            {!! Form::label('fk_departamento','Departamento* :',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                  {!! Form::select('fk_departamento',$departamentos,null,['class'=>'form-control' ,'rows' => 1 ,'required'=>'required']) !!}
                                  {!! $errors->first('fk_departamento','<p class="alert alert-danger">:message</p>')!!}
                
                                    </div>
                              
                        </div>
                    </div>
 

{{-- <div class="col-xs-1 col-sm-1 col-md-1 text-center pull-right"> &nbsp; <br>
  {!! Form::submit('Enviar', ['class'=>'btn btn-success']) !!}
      
</div> --}}
</div>
<div class="box-footer">
      <div class="col-xs-12 col-sm-12 col-md-18" >
            <button type="submit" class="btn btn-success pull-right">Enviar</button>  
         <div class="col-xs-12 col-sm-12 col-md-11" >
            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
               Voltar</button></a>

         </div>
      </div>
     
   </div><br><br>
</div>
{!! Form::close()!!}
@stop
