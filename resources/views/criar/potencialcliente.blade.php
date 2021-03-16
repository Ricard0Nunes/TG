@extends('adminlte::page')

@section('title', 'TurtleGest')
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
@section('content_header')
@stop
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">CRIAR UM POTENCIAL CLIENTE</h3>
   </div>
   {!! Form::open(array('route' => 'potencialcliente.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
            <h3 class="box-title col-sm-2 control-label">Potencial Cliente</h3>
           
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
               </button>
            </div>
         </div>
<br>
 
            <div class="form-group">
               {!! Form::label('NIF','NIF (*)',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-5">
                  {!! Form::text('NIF',null, ['class' => 'form-control','required'=>'required']) !!} 
                  {!! $errors->first('NIF','
                  <p class="alert alert-danger">:message</p>
                  ')!!}
           
            </div> 
            </div>

           
               <div class="form-group">
                  {!! Form::label('nomeCompleto','Nome Completo (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                     {!! Form::text('nomeCompleto',null, ['class' => 'form-control','required'=>'required']) !!} 
                     {!! $errors->first('nomeCompleto','
                     <p class="alert alert-danger">:message</p>
                     ')!!}
                  </div>
              
               </div>

             
                  <div class="form-group">
                     {!! Form::label('nomeAbreviado','Nome Abreviado (*)',['class'=>'col-sm-2 control-label']) !!}
                     <div class="col-sm-5">
                        {!! Form::text('nomeAbreviado',null, ['class' => 'form-control','required'=>'required']) !!} 
                        {!! $errors->first('nomeAbreviado','
                        <p class="alert alert-danger">:message</p>
                        ')!!}
                     </div>
                    </div>

             

           
                        <div class="form-group">
                           {!! Form::label('email','Email (*)',['class'=>'col-sm-2 control-label']) !!}
                           <div class="col-sm-5">
                              {!! Form::text('email',null, ['class' => 'form-control','required'=>'required']) !!} 
                              {!! $errors->first('email','<p class="alert alert-danger">Insira um email correto</p>')!!}
                           </div>
                        </div> 
                   
                        
                        
                           <div class="form-group">
                              {!! Form::label('morada','Morada (*)',['class'=>'col-sm-2 control-label']) !!}
                              <div class="col-sm-5">
                                 {!! Form::text('morada',null, ['class' => 'form-control','required'=>'required']) !!} 
                                 {!! $errors->first('morada','
                                 <p class="alert alert-danger">:message</p>
                                 ')!!}
                              </div>
                           </div> 
 
                      

                               
                                 <div class="form-group">
                                    {!! Form::label('contacto','Contacto (*)',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-5">
                                       {!! Form::text('contacto',null, ['class' => 'form-control','required'=>'required']) !!} 
                                       {!! $errors->first('contacto','
                                       <p class="alert alert-danger">:message</p>
                                       ')!!}
                                    </div>
                                 </div> 
                            
                                 
                                    <div class="form-group">
                                       {!! Form::label('contactoAlternativo','Contacto Alternativo',['class'=>'col-sm-2 control-label']) !!}
                                       <div class="col-sm-5">
                                          {!! Form::text('contactoAlternativo',null, ['class' => 'form-control']) !!} 
                                          {!! $errors->first('contactoAlternativo','
                                          <p class="alert alert-danger">:message</p>
                                          ')!!}
                                       </div>
                                    </div> 
                                   

                                 
                                       <div class="form-group">
                                          {!! Form::label('observacoes','Observações',['class'=>'col-sm-2 control-label']) !!}
                                          <div class="col-sm-5">
                                             {!! Form::text('observacoes',null, ['class' => 'form-control']) !!} 
                                             {!! $errors->first('observacoes','
                                             <p class="alert alert-danger">:message</p>
                                             ')!!}
                                          </div>  
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
                                         
                                       </div><br>
         </div> 
     
      </div>
      </div>
   
        
  
   {!! Form::close()!!}  
</div>  
@stop