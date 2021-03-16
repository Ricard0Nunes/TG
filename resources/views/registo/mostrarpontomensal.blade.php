@extends('adminlte::page')

@section('Relatorio Ponto', 'AdminLTE')




@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>


<script>
    $(document).ready(function() {
    $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
</script>
    
<div class="box   box-success">
        <div class="box-header with-border" >
       
                <h1 class="box-title" >MOSTRAR PONTO MENSAL: {{$user->name}} DE : {{Carbon\Carbon::parse($start)->format('Y-m-d')}} - A - {{Carbon\Carbon::parse($end)->format('Y-m-d')}} </h1>
            
            
      

            </div>
<div class="container">


<div class="row">

        
                </div>
                </div><!-- /.box-tools -->
                <div class="box-body">
                    <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box bg-green">
                                      <div class="inner">
                                            <h3>{{$diasuteis=$diference+1-$diasFds-$diasparagem}} <small style="color:white">Dias Utéis</small></h3>
                          
                                        <p>Total dias Processados: {{$diference+1}}</p>
                                      </div>
                                      <div class="icon">
                                            <i class="fas fa-business-time"></i>
                                      </div>
                                      
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-green">
                                                <div class="inner">
                                                  <h3>{{count($ponto)-count($faltas)-$diasparagem}} <small style="color:white">Presente </small></h3>
                                    
                                                  <p>Faltas: {{$diasuteis + $diasparagem-count($ponto)}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="ion ion-stats-bars"></i>
                                                </div>
                                                
                                              </div>
                                      </div>
                                      <div class="col-md-4">
                                  
                                            {!! Form::open(array('route' => 'registo.mostrarpontomensal','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                             
                                          
                                                <span >
                                            
                                                        <div class="row">
                                                                <div class="col-md-4">
                              Data Início: 
                                            {!! Form::date('inicio',$start,['class'=>'form-control','style'=>'display:inline-block']) !!}
                                        </div>
                                        <div class="col-md-4">
                                           Data Fim:
                                            {!! Form::date('fim',$end,['class'=>'form-control','style'=>'display:inline-block']) !!}
                                        </div>
                                        <div class="col-md-4">
                                            <br>
                                        <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-success fas fa-search ">
                                           </button></a>    
                                              {!! Form::close()!!}<br><br>
                                              {!! Form::open(array('route' => 'registo.processar','method'=>'POST','files'=>'true','style'=>'display:inline-block','target'=>'_blank')) !!}

                                              <button class="btn  btn-primary pull-right"><i class="fas fa-recycle"></i><a href=""></a> Processar</button>
                                              <input id="invisible_id"  name="user_id" type="hidden" value="{{$user->id}}">
                                              <input id="invisible_id"  name="start" type="hidden" value="{{$start}}">
                                              <input id="invisible_id"  name="end" type="hidden" value="{{$end}}">
                                              {!! Form::close()!!}
                                        </div>
                                      
                                                </span>
                                              
                                             
                            </div>
                        
                     
                    </div>
                    <div class="row">
                            <div class="col-md-4"></div>
                           
            
                           
                            <div class="col-md-4"></div> </div>
                    
                    </div>
                </div>
              </div><!-- /.box-header -->
     
            
              
        <div class="box-body">
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                              @if(Session::has('success'))
                        <div class="alert alert-success">
                              {{ Session::get('success')}}
                        </div>
                             @endif 
                        </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                    <th class="text-center">Data </th>
                                 
                                    <th class="text-center">Estado </th>
                                <th class="text-center">Entrada Manhã</th>
                                <th class="text-center">Saída Manhã</th>
                                <th class="text-center">Tempo Almoço</th>
                                <th class="text-center">Entrada Tarde</th>
                                <th class="text-center">Saída Tarde</th>
                                <th class="text-center">Total Diário</th>
                                 <th class="text-center"> Justificações/Comentários</th>
                             
                            </tr>
                        </thead>
                        <tbody>


                @if (count($ponto)==0)
                    
                 @else
                    
                             @for ($i = 0; $i <= $diference; $i++)
                            
                            
                       
                            
                                <div class="hidden">
                                       {{-- ver se é dias de fds --}}

                                       {{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized(' %A' )}}
                                       {{ $sabado=(strstr($dia[$i], 'sábado'))}}
                                       {{ $domingo=(strstr($dia[$i], 'domingo'))}}
                                       {{-- ver se é dias de fds --}}
                                        {{$test=-1}}
                                        {{$falta=-1}}
                                        {{$day=Carbon\Carbon::parse($start)->addDays($i)->format('Y-m-d')}}

                                        @for ($a = 0; $a < count($ponto); $a++)
                                       
                                        {{$dayPonto=Carbon\Carbon::parse($ponto[$a]->data)->format('Y-m-d')}}
                                       @if ($day==Carbon\Carbon::parse($ponto[$a]->data)->format('Y-m-d'))
                                       {{$test=$a}}
                                            @if ($ponto[$a]->fk_tipo==6)
                                            
                                              {{$falta=$a}}
                                            
                                              @endif
                                       @else
                                       {{$ver[$i]=$a.'nao tem ponto'}}
                                       @endif
                                     
                                      
                                        @endfor
                                        
                                </div>
                           

                              



                                 @if ($sabado or $domingo)
                                        <tr id="tr"  style="background-color: #f5f5f5"class="odd even">
                                                <td>{{$i}}</td>
                                                <td class="font-weight-bold">{{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized(' %A - %d  %b de %Y ')}} 
                                               @if ($test>=0)
                                               <td class="text-center"><span class="label label-success">Presente</span></td>
                                               <td class="text-justify">
                                                       @if ($ponto[$test]->entradaManha!=null)
                                                       <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                                   @else
                                                   <strong > EM:--:--:-- </strong>
                                                   @endif </td>
                                                   <td class="text-justify">
                                                           @if ($ponto[$test]->saidaManha!=null)
                                                               <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                                           @else
                                                           <strong > SM: --:--:-- </strong>
                                                           @endif </td>
                                                       
                                                   <td class="text-justify">
                                                           @if ($ponto[$test]->tempoAlmoco!=null)
                                                           <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                                       @else
                                                       <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                                       
                                                       @endif </td>
                                                   <td class="text-justify">
                                                   @if ($ponto[$test]->entradaTarde!=null)
                                                   <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                                   @else
                                                   <strong > ET: --:--:-- </strong>
                                                   @endif       </td>
                                               
                                                   <td class="text-justify">
                                                   @if ($ponto[$test]->saidaTarde!=null)
                                                   <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                                   @else
                                                   <strong  > ST: --:--:-- <strong>
                                                   @endif
                                                       
                                                   </td>
                                                           
                                           
                                                   <td class="text-justify">
                                                   @if ($ponto[$test]->totalDia!=null)
                                                   <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                                   @else
                                                   <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                                   @endif 
                                               
                                               
                                                       </td>
                                                   <td  class="text-center">
                                                   @if ($ponto[$test]->fk_justificacao==0)
                                                       <button type="button" class="btn btn-xs btn-primary disabled fas fa-file-import" ></button>
                                                       
                                                   @else
                                                   <button type="button" class="btn btn-xs btn-success fas fa-file-import" title="{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[$test]->fk_justificacao)->value('descricao')}}"></button>
                                                   @endif
                                               
                                                   @if ($ponto[$test]->comentario==null)
                                                   <button type="button" class="btn btn-xs btn-primary disabled fas fa-comments" title="Sem Comentários"></button>
                                                   
                                                   @else
                                                       <button type="button" class="btn btn-xs btn-success fas fa-comments" title="{{$ponto[$test]->comentario}}"></button>
                                                   @endif 
                                               @else
                                               <td class="text-center"><span class="label label-info">Fim de Semana</span></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               @endif
                                                    

                                              {{-- presente ao fds --}}
                                                    
                                                        
                                               
                                          {{-- sabado ou domingo fim --}}
                                  @else 
                                        <tr id="tr" >
                                                <td>{{$i}}</td>
                                       
                                      
                                                <td class="font-weight-bold">{{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized('%A- %d  %b de %Y ')}} 
                                         @if ($test<0)
                                                       
                                             <td class="text-center"><span class="label label-danger">Falta</span></td>
                                            <td>EM:--:--:--</td>
                                            <td>SM:--:--:--</td>
                                            <td><i class="fas fa-utensils"></i> {{' --:--:--'}}</td>
                                            <td>EM:--:--:--</td>
                                            <td>SM:--:--:--</td>
                                            <td>    <i class="far fa-clock"></i>   {{' --:--:--'}}</td>
                                            <td class="text-center"><button type="button" class="btn btn-xs btn-primary disabled fas fa-file-import" ></button> <button type="button" class="btn btn-xs btn-primary disabled fas fa-comments" title="Sem Comentários"></button>
                                            </td>
                                         
                                         
                                          @else
                                          @if ($falta>0)
                                                       
                                          <td class="text-center"><span class="label label-danger">Falta</span></td>
                                         <td>EM:--:--:--</td>
                                         <td>SM:--:--:--</td>
                                         <td><i class="fas fa-utensils"></i> {{' --:--:--'}}</td>
                                         <td>EM:--:--:--</td>
                                         <td>SM:--:--:--</td>
                                         <td>    <i class="far fa-clock"></i>   {{' --:--:--'}}</td>
                                         <td class="text-center"><button type="button" class="btn btn-xs btn-primary disabled fas fa-file-import" ></button> <button type="button" class="btn btn-xs btn-primary disabled fas fa-comments" title="Sem Comentários"></button>
                                         </td>
                                         @elseif($ponto[$test]->totalDia=='00:00:00' and $ponto[$test]->entradaManha=='00:00:00')
                                         <td class="text-center"><span class="label label-warning">Ausente</span></td>
                                         <td class="text-justify">
                                            @if ($ponto[$test]->entradaManha!=null)
                                            <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                        @else
                                        <strong > EM:--:--:-- </strong>
                                        @endif </td>
                                        <td class="text-justify">
                                                @if ($ponto[$test]->saidaManha!=null)
                                                    <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                                @else
                                                <strong > SM: --:--:-- </strong>
                                                @endif </td>
                                            
                                        <td class="text-justify">
                                                @if ($ponto[$test]->tempoAlmoco!=null)
                                                <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                            @else
                                            <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                            
                                            @endif </td>
                                        <td class="text-justify">
                                        @if ($ponto[$test]->entradaTarde!=null)
                                        <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                        @else
                                        <strong > ET: --:--:-- </strong>
                                        @endif       </td>
                                    
                                        <td class="text-justify">
                                        @if ($ponto[$test]->saidaTarde!=null)
                                        <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                        @else
                                        <strong  > ST: --:--:-- <strong>
                                        @endif
                                            
                                        </td>
                                                
                                
                                        <td class="text-justify">
                                        @if ($ponto[$test]->totalDia!=null)
                                        <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                        @else
                                        <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                        @endif 
                                    
                                    
                                            </td>
                                        <td  class="text-center">
                                        @if ($ponto[$test]->fk_justificacao==0)
                                            <button type="button" class="btn btn-xs btn-primary disabled fas fa-file-import" ></button>
                                            
                                        @else
                                        <button type="button" class="btn btn-xs btn-success fas fa-file-import" title="{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[$test]->fk_justificacao)->value('descricao')}}"></button>
                                        @endif
                                    
                                        @if ($ponto[$test]->comentario==null)
                                        <button type="button" class="btn btn-xs btn-primary disabled fas fa-comments" title="Sem Comentários"></button>
                                        
                                        @else
                                            <button type="button" class="btn btn-xs btn-success fas fa-comments" title= "{{$ponto[$test]->comentario}}"></button>
                                        @endif 
                                         @else
                                            <td class="text-center"><span class="label label-success">Presente</span></td>
                                            <td class="text-justify">
                                                    @if ($ponto[$test]->entradaManha!=null)
                                                    <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                                @else
                                                <strong > EM:--:--:-- </strong>
                                                @endif </td>
                                                <td class="text-justify">
                                                        @if ($ponto[$test]->saidaManha!=null)
                                                            <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                                        @else
                                                        <strong > SM: --:--:-- </strong>
                                                        @endif </td>
                                                    
                                                <td class="text-justify">
                                                        @if ($ponto[$test]->tempoAlmoco!=null)
                                                        <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                                    @else
                                                    <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                                    
                                                    @endif </td>
                                                <td class="text-justify">
                                                @if ($ponto[$test]->entradaTarde!=null)
                                                <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                                @else
                                                <strong > ET: --:--:-- </strong>
                                                @endif       </td>
                                            
                                                <td class="text-justify">
                                                @if ($ponto[$test]->saidaTarde!=null)
                                                <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                                @else
                                                <strong  > ST: --:--:-- <strong>
                                                @endif
                                                    
                                                </td>
                                                        
                                        
                                                <td class="text-justify">
                                                @if ($ponto[$test]->totalDia!=null)
                                                <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                                @else
                                                <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                                @endif 
                                            
                                            
                                                    </td>
                                                <td  class="text-center">
                                                @if ($ponto[$test]->fk_justificacao==0)
                                                    <button type="button" class="btn btn-xs btn-primary disabled fas fa-file-import" ></button>
                                                    
                                                @else
                                                <button type="button" class="btn btn-xs btn-success fas fa-file-import" title="{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ponto[$test]->fk_justificacao)->value('descricao')}}"></button>
                                                @endif
                                            
                                                @if ($ponto[$test]->comentario==null)
                                                <button type="button" class="btn btn-xs btn-primary disabled fas fa-comments" title="Sem Comentários"></button>
                                                
                                                @else
                                                    <button type="button" class="btn btn-xs btn-success fas fa-comments" title="{{$ponto[$test]->comentario}}"></button>
                                                @endif 
                                         
                                         @endif
                                         @endif
                                        @endif
                                    
                                    
                         
                            
                             @endfor  
                            </tr> 
                             @endif
   
                    </tbody>
                    </table> 
                
                    <br><br>
                </div>
            </div>
   
  
@endsection




