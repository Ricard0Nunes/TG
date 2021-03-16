@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">CRIAR UM CONTACTO COM CLIENTE</h3>
   </div>
   {!! Form::open(array('route' => 'store.contactosComClientes','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
    
         <div class="box-body" style="">
            <div class="form-group">
                {!! Form::label('dataContacto','Data Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                   {!! Form::dateTimeLocal('dataContacto',null, ['class' => 'form-control','required'=>'required']) !!} 
                   {!! $errors->first('dataContacto','
                   <p class="alert alert-danger">:message</p>
                   ')!!}
                </div>
             </div>
             <div class="form-group">
                {!! Form::label('proximoContacto','Próximo Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                   {!! Form::dateTimeLocal('proximoContacto',null, ['class' => 'form-control','required'=>'required']) !!} 
                   {!! $errors->first('proximoContacto','
                   <p class="alert alert-danger">:message</p>
                   ')!!}
                </div>
             </div>

            <div class="form-group">
               {!! Form::label('mensagem','Mensagem (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('mensagem',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('mensagem','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            <div class="form-group">
               {!! Form::label('mensagemCliente','Mensagem Cliente (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('mensagemCliente',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('mensagemCliente','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>
            
            <div class="form-group">
               {!! Form::label('parecer','Parecer (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('parecer',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('parecer','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
               </div>
            </div>

        

      <div class="form-group">
         {!! Form::label('fk_lead','Leads (*)',['class'=>'col-sm-2 control-label']) !!}
         <div class="col-sm-5">
            {{-- {!! Form::select('fk_responsavel', $users ,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Colaborador')) !!} --}}
            {{-- {!! Form::select('fk_lead', $lead,null,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha a Lead')) !!} --}}
            {{-- {!! Form::select('fk_lead', $contacto,null,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Contacto')) !!} --}}
            <select id="lead" class="form-control" name="fk_lead">
               <option value="">Escolha a Lead apropriada</option>

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
            {!! Form::label('fk_tipo_contacto','Tipo de Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
               {{-- {!! Form::select('fk_responsavel', $users ,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Colaborador')) !!} --}}
               {!! Form::select('fk_tipo_contacto', $contacto,null,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Contacto')) !!}
              {!! $errors->first('fk_tipo_contacto','
               <p class="alert alert-danger">:message</p>
               ')!!}
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
     
  



   {!! Form::close()!!}  
</div>
{{-- script para mostrar div "dados_subcontratado"  --}}
<script>
   var radio = document.getElementsByName('internaExterna'); 
   for (var i = 0; i < radio.length; i++) {
         radio[i].onclick = function() {
               var valorRadio = this.value; 
               if(valorRadio == '1'){
                     document.getElementById("dados_internaexterna1").className = "";  
                     document.getElementById("dados_internaexterna").className = "hidden"; 
   
               }
               else if(valorRadio == '0'){
                     document.getElementById("dados_internaexterna1").className = "hidden";  
                     document.getElementById("dados_internaexterna").className = ""; 
               }
         }
   }
</script>
{{-- script para mostrar formulário cargo --}}
@stop