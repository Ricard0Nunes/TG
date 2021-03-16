
@extends('adminlte::page')

@section('Veículo', 'AdminLTE')




@section('content')
<div class="box box-success">
        <div class="box-header with-border">
                <h3 class="box-title">EDITAR UM VEICULO</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->


    <div class="box-body"> 
{!! Form::open(array('route' => ['veiculo.update',$veiculo->pk_veiculo],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
            {!! Form::label('dataMatricula','Data da Matrícula* :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('dataMatricula',$veiculo->dataMatricula,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('dataMatricula','<p class="alert alert-danger">:message</p>')!!} 
            </div>
</div>
 
        <div class="form-group">
              {!! Form::label('matricula','Matrícula* :',['class'=>'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                    {!! Form::text('matricula',$veiculo->matricula,['class'=>'form-control','required'=>'required']) !!}
                    {!! $errors->first('matricula','<p class="alert alert-danger">:message</p>')!!} 
        </div>
  </div>

  
    <div class="form-group">
          {!! Form::label('marca','Marca* :',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-5">
                {!! Form::text('marca',$veiculo->marca,['class'=>'form-control','required'=>'required']) !!}
                {!! $errors->first('marca','<p class="alert alert-danger">:message</p>')!!}       
    </div>
</div> 
    <div class="form-group">
          {!! Form::label('modelo','Modelo* :',['class'=>'col-sm-2 control-label']) !!}
          <div class="col-sm-5">
                {!! Form::text('modelo',$veiculo->modelo,['class'=>'form-control','required'=>'required']) !!}
                {!! $errors->first('modelo','<p class="alert alert-danger">:message</p>')!!} 
    </div>
</div> 
    <div class="form-group">
          {!! Form::label('kms','KMs* :',['class'=>'col-sm-2 control-label']) !!} <div class="col-sm-5">
                {!! Form::text('kms',$veiculo->kms,['class'=>'form-control','required'=>'required']) !!}
                {!! $errors->first('kms','<p class="alert alert-danger">:message</p>')!!} 
          </div>
    </div>
    <div class="form-group">
      {!! Form::label('capacidade','Capacidade (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::text('capacidade',$veiculo->capacidade,['class'=>'form-control','required'=>'required']) !!}
            {!! $errors->first('capacidade','<p class="alert alert-danger">:message</p>')!!}
   
</div>
</div> 
    <div class="form-group">
          {!! Form::label('autonomia','Autonomia* :',['class'=>'col-sm-2 control-label']) !!} 
          <div class="col-sm-5">
                {!! Form::text('autonomia',$veiculo->autonomia,['class'=>'form-control','required'=>'required']) !!}
                {!! $errors->first('autonomia','<p class="alert alert-danger">:message</p>')!!}
 
    </div>
</div> 
      <div class="form-group">
            {!! Form::label('nif','Empresa*:',['class'=>'col-sm-2 control-label']) !!} 
            <div class="col-sm-5">
                  {!! Form::select('nif', $empresas ,$veiculo->nifEmpresa,array('class' => 'form-control', 'id'=>'empresa', 'placeholder' => 'Escolha a Empresa','required'=>'required' )) !!}
                  {!! $errors->first('nif','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
</div>
<div class="box-footer">
      <div class="col-xs-12 col-sm-12 col-md-18" >
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
{{-- removeu-se <input> botao {$veiculo->pk_veiculo} --}}
         <div class="col-xs-12 col-sm-12 col-md-11" >
            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
               Voltar</button></a>

         </div>
      </div>
     
   </div> 
    
    
  
</div>
{!! Form::close()!!}
@stop
