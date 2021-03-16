
@extends('adminlte::page')

@section('Contacto', 'AdminLTE')




@section('content')
{{-- <div class="box   box-success">
        <div class="box-header">
            <h3 class="box-title">Editar uma Urgência</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            Urgência: {{$urgencia->pk_urgencia}}
        </div><!-- /.box-body -->
    </div> --}}
<div class="box   box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >EDITAR UM CONTACTO</h1>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
 
{!! Form::open(array('route' => ['contactocomcliente.update'],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::label('nome','Nome* :',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                              {!! Form::text('nome',$contacto->nome,['class'=>'form-control']) !!}
                              {!! $errors->first('nome','<p class="alert alert-danger">:message</p>')!!}

                        
                  </div>
            </div>
 
                <div class="form-group">
                      {!! Form::label('funcao','Função* :',['class'=>'col-sm-2 control-label']) !!}
                      <div class="col-sm-5">
                            {!! Form::text('funcao',$contacto->funcao,['class'=>'form-control']) !!}
                            {!! $errors->first('funcao','<p class="alert alert-danger">:message</p>')!!}

                      
                </div>
          </div> 
            <div class="form-group">
                  {!! Form::label('contacto1','Contacto* :',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('contacto1',$contacto->contacto1,['class'=>'form-control']) !!}
                        {!! $errors->first('contacto1','<p class="alert alert-danger">:message</p>')!!}
 
            </div>
      </div> 
        <div class="form-group">
              {!! Form::label('contacto2','Contacto Alternativo* :',['class'=>'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                    {!! Form::text('contacto2',$contacto->contacto2,['class'=>'form-control']) !!}
                    {!! $errors->first('contacto2','<p class="alert alert-danger">:message</p>')!!}
 
        </div>
  </div>
    
    <div class="form-group">
          {!! Form::label('email','Email* :',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-5">
                {!! Form::text('email',$contacto->email,['class'=>'form-control']) !!}
                <input id="invisible_id" name="id" type="hidden" value={{$contacto->pk_contacto}}>
                <input id="invisible_id" name="fk_cliente" type="hidden" value={{$contacto->fk_cliente}}>  
                {!! $errors->first('email','<p class="alert alert-danger">:message</p>')!!}
 
    </div>
</div> 
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
