@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">CRIAR UMA CAMPANHA</h3>
   </div>
   {!! Form::open(array('route' => 'campanha.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
         @if(Session::has('success'))
         <div class="alert alert-success">
            {{ Session::get('success')}}
         </div>
         @elseif( Session::has('warning'))
         <div class="alert alert-danger">
            {{ Session::get('warning')}}
            <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
         </div>
         @endif 
      </div>
   </div>
   <div class="box-body">
   
         <div class="box-body" style="">

               <div class="form-group">
                     {!! Form::label('fk_tipo_campanha','Tipo Campanha (*)',['class'=>'col-sm-2 control-label']) !!}
                     <div class="col-sm-5">
                           {!! Form::select('fk_tipo_campanha', $tipo_campanha, null, ['class' => 'form-control','placeholder' => 'Escolha o Tipo Campanha','required'=>'required']) !!}
                           {!! $errors->first('fk_tipo_campanha','<p class="alert alert-danger">:message</p>')!!}
                     </div>    
               </div>

            <div class="form-group">
                  {!! Form::label('fk_responsavel','Responsável (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                     {!! Form::select('fk_responsavel', $users, null, ['class' => 'form-control','placeholder' => 'Escolha o Responsável','required'=>'required']) !!}
                     {!! $errors->first('fk_responsavel','<p class="alert alert-danger">:message</p>')!!}
                  </div>    
            </div>                
      
            <div class="form-group">
               {!! Form::label('dataInicio','Data Início (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::date('dataInicio',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('dataInicio','<p class="alert alert-danger">:message</p> ')!!}
               </div>
            </div>

            <div class="form-group">
               {!! Form::label('dataFim','Data Fim (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::date('dataFim',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('dataFim','<p class="alert alert-danger">:message</p> ')!!}
               </div>
            </div>
        
            <div class="form-group">
               {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('observacoes',null,['class'=>'form-control']) !!}
                  {!! $errors->first('observacoes','<p class="alert alert-danger">:message</p>')!!}
               </div>
            </div>
{{-- 
            <div class="form-group">
               {!! Form::label('eficacia','Eficácia (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('eficacia',null,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('eficacia','<p class="alert alert-danger">:message</p>')!!}
               </div>
            </div> --}}

        

       
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