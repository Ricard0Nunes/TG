@extends('adminlte::page')

@section('Status', 'AdminLTE')

@section('content')
<div class="box   box-success">

            <div class="box-header with-border" >
            <h1 class="box-title" >STATUS DO COLABORADOR       
           </h1>
                    <div class="box-tools pull-right">
                      <!-- Buttons, labels, and many other things can be placed here! -->
                      <!-- Here is a label for example -->
                      {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->

    <div class="box-body">
    

        <div class="row">
          
            <div class="col-xs-12 col-sm-12 col-md-12" >
                <div class="box box-success" >
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                      
                {{-- {!! $empresa !!}{!! $user !!}{!! $user2 !!}{!! $urgencia !!}{!! $projDep !!}{!! $cliente !!}
                <p><strong>Descrição: </strong>{{$projeto->descricaoProjeto}}</p> --}}
              </div>
              <div class="box-body">
                  <div class="row"> 
                   
                      <div class="col-xs-12 col-sm-12 col-md-12" >   
                
                                                         
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-1" ></div>
          <div class="col-xs-12 col-sm-12 col-md-2" >   
            <h4 style="text-align:center">Manhã ({{count($manha)}})</h4>  
            <hr style="  border: 5px solid  #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
            <div class="row"  style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                  
                       
       @foreach ($manha as $manha)
           


                    <div class="box-body">
                        <div class="callout callout-success" style="background-color:white !important;
                        color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;margin-bottom:0px !important;">
                             <div class="row">
                               
                           
                                    <div class="pull-left">
                                      <img src= {{$manha['foto']}}  class="img-circle img-sm" alt="User Image">
                                    </div>
                                    <h4>
                                      {{$manha['name']}}    ({{$manha['sigla']}})
                                     
                                    </h4>
                                   
                               
                          </div>  
	


                   
                      </div>  
                      </div> 

                      @endforeach
                  
                </div>  

             </div>   
            </div>     
  
         
    
        <div class="col-xs-12 col-sm-12 col-md-2" >   
            <h4 style="text-align:center">Almoço ({{count($almoco)}})</h4>  
            <hr style="  border: 5px solid #ffbc00;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
            <div class="row" style="	max-height:450px;overflow-y:auto;">
                    <div class="col-xs-12 col-sm-12 col-md-12" >
                      
                        @foreach ($almoco as $almoco)
           


                        <div class="box-body">
                            <div class="callout callout-warning" style="background-color:white !important;
                            color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #ffbc00 !important;margin-bottom:0px !important;">
                                 <div class="row">
                                   
                                 
                                        <div class="pull-left">
                                          <img src=   {{$almoco['foto']}}   class="img-circle img-sm" alt="User Image">
                                        </div>
                                        <h4>
                                          {{$almoco['name']}}    ({{$almoco['sigla']}})
                                         
                                        </h4>
                                       
                                   
                              </div>  
      
    
    
                       
                          </div>  
                          </div> 
    
                          @endforeach
             
                       </div>   
                    </div> 
          </div>
          <div class="col-xs-12 col-sm-12 col-md-2" >   
          <h4 style="text-align:center"> Tarde ({{count($tarde)}})</h4>  
              <hr style="  border: 5px solid #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row" style="	max-height:450px;overflow-y:auto;">
                    <div class="col-xs-12 col-sm-12 col-md-12" >
                      
                        @foreach ($tarde as $tarde)
           


                    <div class="box-body">
                        <div class="callout callout-success" style="background-color:white !important;
                        color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;margin-bottom:0px !important;">
                             <div class="row">
                               
                           
                                    <div class="pull-left">
                                      <img src= {{$tarde['foto']}}  class="img-circle img-sm" alt="User Image">
                                    </div>
                                    <h4>
                                      {{$tarde['name']}}    ({{$tarde['sigla']}})
                                     
                                    </h4>
                                   
                               
                          </div>  
	


                   
                      </div>  
                      </div> 

                      @endforeach
                    
                    
                        
                              
              </div>     </div>     </div>  
              <div class="col-xs-12 col-sm-12 col-md-2" >   
                    <h4 style="text-align:center">De Saída ({{count($saida)}})</h4>  
                        <hr style="  border: 5px solid #eb4e4e;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
                        <div class="row" style="	max-height:450px;overflow-y:auto;">
                              <div class="col-xs-12 col-sm-12 col-md-12" >
                                
                                  @foreach ($saida as $saida)
           


                                  <div class="box-body">
                                      <div class="callout callout-danger" style="background-color:white !important;
                                      color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #eb4e4e !important;margin-bottom:0px !important;">
                                           <div class="row">
                                             
                                         
                                                  <div class="pull-left">
                                                    <img src= {{$saida['foto']}}  class="img-circle img-sm" alt="User Image">
                                                  </div>
                                                  <h4>
                                                    {{$saida['name']}}    ({{$saida['sigla']}})
                                                   
                                                  </h4>
                                                 
                                             
                                        </div>  
                
              
              
                                 
                                    </div>  
                                    </div> 
              
                                    @endforeach
                              
                              
                                  
                                        
                        </div>     </div>     </div> 
                        <div class="col-xs-12 col-sm-12 col-md-2" >   
                                <h4 style="text-align:center"> Ausente ({{count($ausente)}})</h4>  
                                    <hr style="  border: 5px solid #009abf;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
                                    <div class="row" style="	max-height:450px;overflow-y:auto;">
                                          <div class="col-xs-12 col-sm-12 col-md-12" >
                                            
                                              @foreach ($ausente as $ausente)
           


                                              <div class="box-body">
                                                  <div class="callout callout-info" style="background-color:white !important;
                                                  color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #009abf !important;margin-bottom:0px !important;">
                                                       <div class="row">
                                                         
                                                     
                                                              <div class="pull-left">
                                                                <img src= {{$ausente['foto']}}  class="img-circle img-sm" alt="User Image">
                                                              </div>
                                                              <h4>
                                                                {{$ausente['name']}}    ({{$ausente['sigla']}}) <br>
                                                                @for ($t = 0; $t < count($tasks); $t++)
                                                                 @if ($ausente->bi==$tasks[$t]->biuser)
                                                                -> {{DB::connection('geraltg')->table('justificacoes')->where ('pk_justificacao', $tasks[$t]->fk_justificacao)->value('descricao')
                                                              }}
                                                              <br>
                                                            
                                                             
                                                                @endif
                                                                 
                                                                @endfor
                                                               
                                                              </h4>
                                                             
                                                         
                                                    </div>  
                            
                          
                          
                                             
                                                </div>  
                                                </div> 
                          
                                                @endforeach
                                          
                                          
                                              
                                                    
                                    </div>     </div>     </div>    
            </div>   </div>

        </div>   </div>

        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-5" >
        
                    </div>
                            <div class="col-xs-12 col-sm-12 col-md-2" >
                                   <button onclick="win.collapse()" type="button" class="btn btn-block btn-warning btn-flat">
                                            Voltar</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5" >
        
                    </div>
        </div><br><br>
@stop