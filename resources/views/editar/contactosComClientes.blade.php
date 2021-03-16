@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">EDITAR UM CONTACTO COM CLIENTE</h3>
   </div>
   {!! Form::open(array('route' => 'update.contactosComClientes','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
      <div class="box" style="border-top:0px solid black!important">
         <div class="box-header with-border">
            <h3 class="box-title col-sm-2 control-label">Editar Contacto com Cliente</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
            </div>
         </div>
         <div class="box-body" style="">
            <div class="form-group">
                {!! Form::label('dataContacto','Data Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                   {!! Form::dateTimeLocal('dataContacto',carbon\Carbon::parse($contacto->dataContacto)->format('Y-m-d\TH:i'), ['class' => 'form-control','required'=>'required']) !!} 
                   {!! $errors->first('dataContacto','
                   <p class="alert alert-danger">:message</p>
                   ')!!}
                </div>
             </div>
             <div class="form-group">
                {!! Form::label('proximoContacto','Próximo Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                   {!! Form::dateTimeLocal('proximoContacto',carbon\Carbon::parse($contacto->proximoContacto)->format('Y-m-d\TH:i'), ['class' => 'form-control','required'=>'required']) !!} 
                   {!! $errors->first('proximoContacto','
                   <p class="alert alert-danger">:message</p>
                   ')!!}
                </div>
             </div>

            <div class="form-group">
               {!! Form::label('mensagem','Mensagem (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('mensagem',$contacto->mensagem, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('mensagem','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            <div class="form-group">
               {!! Form::label('mensagemCliente','Mensagem Cliente (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('mensagemCliente',$contacto->mensagemCliente, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('mensagemCliente','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            
            <div class="form-group">
               {!! Form::label('parecer','Parecer (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('parecer',$contacto->parecer, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('parecer','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
 
  

     <div class="form-group">
        {!! Form::label('fk_lead','Leads (*)',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
         <select id="lead" class="form-control" name="fk_lead">
         <option value="{{$contacto->fk_lead}}">{{DB::table('leads')->leftjoin('potencialclientes','potencialclientes.pk_potencialCliente','leads.fk_potencialCliente')->where('pk_lead',$contacto->fk_lead)->value('potencialclientes.nomeAbreviado')}}</option>

            @foreach ($lead as $lead)
            <option value="{{$lead->pk_lead}}" >{{DB::table('potencialclientes')->where('pk_potencialCliente',$lead->fk_potencialCliente)->value('nomeAbreviado')}}</option>

            @endforeach
            
          </select>
        {!! $errors->first('fk_lead','
           <p class="alert alert-danger">:message</p>
           ')!!}
        </div>
     </div>
    
        

         <div class="form-group">
            {!! Form::label('fk_tipo_contacto','Tipo Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
               {!! Form::select('fk_tipo_contacto', $tipocontacto, $contacto->fk_tipo_contacto,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Contacto')) !!}
               {!! $errors->first('fk_tipo_contacto','
               <p class="alert alert-danger">:message</p>
               ')!!}
            </div>
         </div>


   </div>
    <div class="box-footer">
      <div class="col-xs-12 col-sm-12 col-md-18" >
         <input id="aaa" name="id" type="hidden" value={{$contacto->pk_contactoscomclientes}}>  
         <button type="submit" class="btn btn-success pull-right">Enviar</button>
      
         <div class="col-xs-12 col-sm-12 col-md-11" >
            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
               Voltar</button></a>

         </div>
      </div>
     
   </div>
   {!! Form::close()!!}  
</div>
{{-- script para mostrar div "dados_subcontratado"  --}}

@stop