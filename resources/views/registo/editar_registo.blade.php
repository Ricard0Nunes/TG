@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="/css/bootstrap4-clockpicker.css">
<script src="/css/bootstrap4-clockpicker.js"></script>


@section('title', 'Editar Registo')


@section('content')


<style>         td, tr{
      padding:10px;
      font-size:16px;
    }
  
    #tabs.active{
        border-top:3px solid #00a65a !important;
    }
    .card {
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      max-width: 1200px;
      margin: auto;
      padding: 0 0 0 0;
      text-align: center;
      background-color: white;
      font-family: Arial, Helvetica, sans-serif;
      display: flex;
      /* flex:1 1 auto; */
    }
    .title{
      color:grey;
      font-size:18px;
      /* padding-bottom: 10px; */
    
    }
    .itemprop['geo']{
      display: none !important;
    }
    </style>

<div class="box box-widget " style="background-color:transparent">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class=""  >
        <div class="box-body" >
          <span>
            {{-- {{$weather->getByCityName('Setúbal');}} --}}
          </span>
    
          <div class="row" style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
              <div class="col-xs-9 col-md-1" >
                
                <div class="card ">
                  <img class="img-responsive" src="{{asset($user->foto)}}"alt="User Avatar" width="200px">
                </div>
              </div>
              <div class="col-xs-12 col-md-3" >
              <h1 class="" style="">{{$user->name}}</h1>
                <p class="title">{{$cargo}}-{{$departamento}}</p>
              </div>
           
                 
         
               
   
          {{-- </div> --}}
      <div class="col-xs-12 col-md-2">
        

        </div>
        <div class="col-xs-12 col-md-2">

          {{-- {{$weather->getByCityName('casablanca') }}       --}}
           </div>
          <div class="col-xs-12 col-md-4">
      


  </div>

  <!-- Left and right controls -->
  
</div>


        
      </div>
          </div>
        </div>

            <br>
         {{--  --}}
        
         {!! Form::open(array('route' => 'tarefa.salvarpontoeditado','method'=>'POST','files'=>'true')) !!}
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

     
                        <div class="panel panel-default">{{--Div que define o formato do formulário com a formatação de panel-default--}}
                         <div class="panel-heading">{{--Div que define a formatação para a de um panel heading--}}
                         <div class="panel-title">Editar Registo Diário :   {{Carbon\Carbon::parse($data)->formatLocalized('%A %d de %B de %Y')}}
                         </div>{{--Texto apresentado dentro do panel heading e com a formatação de panel title--}}
                         </div>
                         <div class="panel-body">{{--Div que define a primeira parte do formulário como panel-body, de modo a este ter uma formatação especial--}}
                         {{-- =========================================================primeira parte da página=========================================================== --}} 
                         <div class="row">
                         <div class="col-xs-12 col-sm-12 col-md-2">
                         <div class="form-group">
                                {!! Form::label('Entrada de Manhã','Entrada de Manhã: ') !!} 
                                @if ($contagemponto>=1)
                                @if ($ponto[0]->entradaManha!=null)
                                {{$entradaManha=Carbon\Carbon::parse($ponto[0]->entradaManha)->format('H:i')}}
                                
                                @else
                                    {{$entradaManha='--:--'}}
                                @endif 
                                @else
                                {{$entradaManha='--:--'}}
                                @endif 
                                <div class="">
                                      {!! Form::time('entradaManha',$entradaManha,['class'=>'form-control']) !!}

                                      {!! $errors->first('entradaManha','<p class="alert alert-danger">:message</p>')!!}
                    
                                  
                                </div>
                          </div>
                         </div>
                         <div class="col-xs-12 col-sm-12 col-md-2">
                                <div class="form-group">
                                       {!! Form::label('Saida de Manhã','Saida de Manhã: ') !!} 
                                       @if ($contagemponto>=1)
                                       @if ($ponto[0]->saidaManha!=null)
                                       {{$saidaManha=Carbon\Carbon::parse($ponto[0]->saidaManha)->format('H:i')}}
                                       
                                       @else
                                           {{$saidaManha='--:--'}}
                                       @endif
                                       @else
                                       {{$saidaManha='--:--'}}
                                       @endif
                                       
                                       <div class="">
                                             {!! Form::time('saidaManha',$saidaManha,['class'=>'form-control']) !!}
                                             {!! $errors->first('saidaManha','<p class="alert alert-danger">:message</p>')!!}
                           
                                     
                                       </div>
                                 </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                        <div class="form-group">
                                               {!! Form::label('Entrada de Tarde','Entrada de Tarde: ') !!} 
                                               @if ($contagemponto>0)
                                               @if ($ponto[0]->entradaTarde!=null )
                                               {{$entradaTarde=Carbon\Carbon::parse($ponto[0]->entradaTarde)->format('H:i')}}
                                       
                                               @else
                                                   {{$entradaTarde='--:--'}}
                                                   @endif
                                                   @else
                                                   {{$entradaTarde='--:--'}}
                                               @endif
                                               <div class="">
                                                     {!! Form::time('entradaTarde',$entradaTarde,['class'=>'form-control']) !!}
                                                     {!! $errors->first('entradaTarde','<p class="alert alert-danger">:message</p>')!!}
                                   
                                  
                                               </div>
                                         </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-2">
                                                <div class="form-group">
                                                        
                                                       {!! Form::label('Saída de Tarde','Saída de Tarde: ') !!} 
                                                       @if ($contagemponto>0)
                                                       @if ($ponto[0]->saidaTarde!=null )
                                                       {{$saidaTarde=Carbon\Carbon::parse($ponto[0]->saidaTarde)->format('H:i')}}
                                                       
                                                       @else
                                                           {{$saidaTarde='--:--'}}
                                                       @endif 
                                                       @else
                                                       {{$saidaTarde='--:--'}}
                                                       @endif
                                                       <div class="">
                                                             {!! Form::time('saidaTarde',$saidaTarde,['class'=>'form-control']) !!}
                                                             {!! $errors->first('saidaTarde','<p class="alert alert-danger">:message</p>')!!}
                                           
                                                       </div>
                                                 </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-2">
                                                        <div class="form-group">
                                                               {!! Form::label('Tempo de Almoço','Tempo de Almoço: ') !!}
                                                               <div class="">
                                                                     @if ($contagemponto>0)
                                                                     {!! Form::time('tempoAlmoco', $ponto[0]->tempoAlmoco,['class'=>'form-control','readonly']) !!}
                                                                     {!! $errors->first('tempoAlmoco','<p class="alert alert-danger">:message</p>')!!}
                                                                     @else 
                                                                     {!! Form::time('tempoAlmoco', '--:--:--',['class'=>'form-control','readonly']) !!}
                                                                     {!! $errors->first('tempoAlmoco','<p class="alert alert-danger">:message</p>')!!}
                                                                 
                                                                     @endif
                                                                    
                                                   
                                                                   
                                                               </div>
                                                         </div>
                                                       
                             </div>
                             
                             <div class="col-xs-12 col-sm-12 col-md-2">
                                    <div class="form-group">
                                           {!! Form::label('Total do dia','Total do dia: ') !!}
                                           <div class="">
                                                      @if ($contagemponto>0)
                                                 {!! Form::time('totaDia',$ponto[0]->totalDia,['class'=>'form-control','readonly']) !!}
                                                 {!! $errors->first('totaDia','<p class="alert alert-danger">:message</p>')!!}
                                                 @else 
                                                 {!! Form::time('totaDia','--:--',['class'=>'form-control','readonly']) !!}
                                                 {!! $errors->first('totaDia','<p class="alert alert-danger">:message</p>')!!}
                                                 @endif
                                           </div>
                                     </div>
                                    </div> 
                                </div>
                                <div class="row">
                                        <style>textarea{max-height: 50px;}</style>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                               {!! Form::label('Descrição','Comentário: ') !!}
                                               <div class="">
                                                      @if ($contagemponto>0)
                                                     {!! Form::textarea('comentario',$ponto[0]->comentario,['class'=>'form-control','placeholder'=>'Motivo da Edição de Ponto','required'=>'required']) !!}
                                                     {!! $errors->first('comentario','<p class="alert alert-danger">:message</p>')!!}
                                                 @else 
                                                 {!! Form::textarea('comentario',null,['class'=>'form-control','placeholder'=>'Motivo da Edição de Ponto','required'=>'required']) !!}
                                                 {!! $errors->first('comentario','<p class="alert alert-danger">:message</p>')!!}
                                             
                                                     @endif
                                               </div>
                                         </div>
                                        </div> </div>
                                        <div class="row">
                                              
                                                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                       {!! Form::label('Justificação','Justificação: ') !!}
                                                       <div class="">
                                                            {!! Form::select('fk_justificacao', $justificacoes,null,array('class' => 'form-control', 'id'=>'justificacao', 'placeholder' => 'Escolha a justificação ')) !!}                                                       
                                                                  {!! $errors->first('fk_justificacao','<p class="alert alert-danger">:message</p>')!!}
                                           
                                                         
                                                       </div>
                                                 </div>
                                                </div>  --}}
                                          </div>
     <div>&ensp;</div> 
     <div class="form-group align center" >{{--Div de class form-group de forma a alinhar os buttons ao centro da página--}}
             <div class="row" align="center">{{--Div que define uma row no formulário--}}
                 <span><button type="button" class="btn" style="width:150px;height:50px;" ><a href="{{ URL::previous() }}">Voltar</a></button></span>{{--Button que servirá para voltar à página anterior--}}
                 <span style="padding:15px;"><button action="" role="submit"style="width:150px;height:50px;" class="btn btn-success" >Guardar</button></span>{{--Button que servirá para guardar os dados inseridos no formulário e inseri-los na base de dados--}}
             </div>
         </div>       
         {{ Form::hidden('Pedido Por', DB::table('users')->where('id',auth::id())->value('bi'), array('id' => 'reagendar')) }}
         {{ Form::hidden('Ponto de', $user->bi, array('id' => 'reagendar')) }}
         @if ($contagemponto>0)
         {{ Form::hidden('ponto', $ponto[0]->pk_ponto, array('id' => 'reagendar')) }}
          @endif
          {{ Form::hidden('dia', $data, array('id' => 'reagendar')) }}
         {!! Form::close()!!}
        
  


   

     

   
          
        


@stop