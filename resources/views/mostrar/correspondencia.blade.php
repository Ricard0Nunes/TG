@extends('adminlte::page')

@section('Mostrar Ausências', 'Mostrar Ausências')




@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/type-detection/numeric-comma.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/type-detection/num-html.js"></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>



<script>

$(document).ready(function() {
    $('#mail').DataTable( {
        "order": [[ 0, "desc" ]],
        "language": {
         "url": "js/localeDataTable.js",

          }
    } );
} );

</script>

<div class=" box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR CORRESPONDÊNCIA</h1>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
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
                    <table id="mail" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>  

                                <th class="text-center">Referência</th>  

                                    <th class="text-center">Registo</th>  
                                    <th class="text-center">Estado</th>     
                                    <th class="text-center">Datas:</th>
                                    <th class="text-center">Recebido em:</th>  
                                    <th class="text-center">Remetente</th>        
                                    <th class="text-center">Destinatário</th>         
                                    <th class="text-center">Recebido Por:</th>                      
                                    <th class="text-center">Comentários:</th>
                                    <th class="text-center">Gerir:</th>
                             
                              
                             
                               
                            </tr>
                        </thead>
                        <tbody>
                                
                        @foreach ($correspondencia as $correspondencia)
                    
                      <tr>
                        <td class="text-center">  <br>{{$correspondencia->pk_correspondencia}}</td>

                        <td class="text-center">  <br>0{{$correspondencia->contador}}_{{$correspondencia->ano}}</td>

                        <td class="text-center">  <br>{{$correspondencia->created_at}}</td>


                        @if ($correspondencia->entregue==0)
                        <td class="text-center">  <br><span class="label label-info">Recepcionado</span></td> 
                         @elseif($correspondencia->entregue==1)
                     <td class=text-center>  <br><span class="label label-warning">Entrege Dest.</span></td> 
                            @elseif($correspondencia->entregue==2)
                     <td class=text-center>  <br><span class="label label-success">Recebido Dest.</span></td> 
                         @endif
                        <td class="text-center">Recepcionado: {{$correspondencia->diaRecebimento}}
                            <br> Entregue Destina. a: {{$correspondencia->diaEntrega}}
                            <br> Recebido Destina. a:  {{$correspondencia->diaConfirmacaoEntrega}}
                        
                        
                        
                        
                        
                        </td>
                        <td class="text-center">  <br>{{$correspondencia->localRecebimento}}</td>
                        <td class="text-center">  <br>{{$correspondencia->remetente}}</td>

                        <td class="text-center"> <br> 
                            @if ($correspondencia->interna==0)
                            
                                {{$correspondencia->cliente}}
                            @else
                            <span class="label label-warning">{{DB::table('users')->where('id',$correspondencia->fk_destinatario)->value('sigla')}}</span></td>

                            @endif
                        <td class="text-center"> <br> <span class="label label-success">{{DB::table('users')->where('id',$correspondencia->fk_recetor)->value('sigla')}}</span></td>
                        <td class="text-center">
                            
                            @if ( $correspondencia->fk_recetor==auth::id() or DB::table('users')->where('id',auth::id())->value('fk_departamento')< 4)

<br>
                            {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                            {!! Form::open(array('route' => 'correspondencia.comentar','method'=>'POST','files'=>'true' ,'style'=>'display:inline-block')) !!}

                            {!! Form::textarea('comentario',$correspondencia->comentario,['class'=>'form-control' ,'rows' => 1 ,'cols'=> 30]) !!}
                            <a href="" > <input id="aaa" name="comentar" type="hidden" value={{$correspondencia->pk_correspondencia}}>
                              <button type="submit" class="btn btn-warning fas fa-comment" title="Introduzir Comentário">
                                  </button></a> 
                              {!! Form::close()!!}

                            
                            @else
                            {{$correspondencia->comentarios}}
                            @endif
                           </td>
                  

                     


                            @if (($correspondencia->entregue==0 and $correspondencia->fk_recetor==auth::id()) or ($correspondencia->entregue==0 and DB::table('users')->where('id',auth::id())->value('fk_departamento')< 4  ))

                            <td class="text-center"> 
                                 <br> {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                {!! Form::open(array('route' => 'correspondencia.entregar','method'=>'POST','files'=>'true' ,'style'=>'display:inline-block')) !!}
                                <a href="" > <input id="aaa" name="entregar" type="hidden" value={{$correspondencia->pk_correspondencia}}>
                                  <button type="submit" class="btn btn-info fas fa-shipping-fast" title="Confimar Correspondência">
                                      </button></a> 
                                  {!! Form::close()!!}
                                 
                                    </td>

                                    @elseif(($correspondencia->entregue==1 and $correspondencia->fk_destinatario==auth::id()) or ($correspondencia->interna==0 and $correspondencia->entregue==1  and DB::table('users')->where('id',auth::id())->value('fk_departamento')< 4  )) 


                                    <td class="text-center"> 
                                        <br> {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                       {!! Form::open(array('route' => 'correspondencia.receber','method'=>'POST','files'=>'true' ,'style'=>'display:inline-block')) !!}
                                       <a href="" > <input id="aaa" name="receber" type="hidden" value={{$correspondencia->pk_correspondencia}}>
                                         <button type="submit" class="btn btn-success far fa-check-circle">
                                             </button></a> 
                                         {!! Form::close()!!}
                                        
                                           </td>
                                        
                                               
                                           @else
                                           <td></td>
                                               
                                   
                            {{-- @else
                            <td class="text-justify"> 
                                    {!! Form::open(array('route' => 'ausencia.aprovar','method'=>'POST','files'=>'true')) !!}
                                     {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                    <a href="" > <input id="aaa" name="aprovar" type="hidden" value={{$correspondencia->pk_ausencia}}>
                                      <button type="submit" class="btn btn-success fas fa-thumbs-up">
                                          </button></a> 
                                      {!! Form::close()!!}
                                      {!! Form::open(array('route' => 'ausencia.reprovar','method'=>'POST','files'=>'true')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="reprovar" type="hidden" value={{$correspondencia->pk_ausencia}}>
                                        <button type="submit" class="btn btn-danger fas fa-thumbs-down">
                                            </button></a> 
                                        {!! Form::close()!!}
                                    </td> --}}
                            @endif
                   
                          {{-- <td>{{DB::connection('geraltg')->table('userscomuns')->where('BI',$correspondencia->biuser)->value('nome')}}</td>
                   <td>{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$correspondencia->fk_justificacao)->value('descricao')}}</td>
                   <td class="text-center">{{$correspondencia->start}}</td>
                   <td class="text-center">{{$correspondencia->end}}</td> --}}



                 
{{-- 
             <td class="text-center">
                    <a href="#" class="btn btn-warning btn-sm far fa-edit" title="Editar "></a> Editar recurso
                
                    <a href="#" class="btn btn-danger btn-sm far fa-trash-alt" title="apagar "></a> 
                   </td> --}}


                            
                       

                        </tr>
                      
                    @endforeach
                
                    </tbody>
                    </table>
                    <div class="row" align="center">
                        <div class="col-xs-12 col-sm-12 col-md-3" >
                
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3" >
                                    <a href="correspondencianova" ><button type="submit" class="btn btn-block btn-success btn-flat">
                                            Registar Correspondência</button></a>
                                </div>
            
                                    <div class="col-xs-12 col-sm-12 col-md-2" >
                                            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                    Voltar</button></a>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4" >
                
                            </div>
                </div><br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




