
@extends('adminlte::page')

@section('Urgência', 'AdminLTE')




@section('content')
<div class="box">
      @foreach ($task as $task)
          
     
        <div class="box-header with-border">
                <h3 class="box-title">REAGENDAR UMA TAREFA  ({{$task->start_date}})</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
    <div class="box-body">

{!! Form::open(array('route' => 'tarefa.reagendar','method'=>'POST','files'=>'true')) !!}
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
<div class="col-xs-12 col-sm-12 col-md-4">
      <div class="form-group">
            {!! Form::label('date','Data de Início* :') !!}  
            <div class="">
                  {!! Form::date('date',null,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('date','<p class="alert alert-danger">:message</p>')!!}

            </div>
      </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
              {!! Form::label('time','Hora de Início* :') !!}
              <div class="">
                    {!! Form::time('time',null,['class'=>'form-control','required'=>'required']) !!}
                    {!! $errors->first('time','<p class="alert alert-danger">:message</p>')!!}
  
              </div>
        </div>
  </div>

    
   


{{-- <div class="col-xs-1 col-sm-1 col-md-1 text-center pull-right"> &nbsp; <br>
  {!! Form::submit('Enviar', ['class'=>'btn btn-success']) !!}
      
</div> --}}
</div>
<div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-4" >
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >



                        <a href="" ><button type="submit" class="btn btn-block btn-success btn-flat" name="id" value={{$task->id}}>
                                Reagendar Tarefa</button></a>
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
@endforeach
@stop
