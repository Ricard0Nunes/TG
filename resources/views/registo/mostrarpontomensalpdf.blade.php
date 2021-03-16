
<style>


    @media print {
    html,
    body {
        width: 210mm;
        height: 297mm;
    }
   
}
    table{
        font-size: 8,5px !important;
    }
    td{
        padding: none !important;
    }
 .no-print, .no-print *
    {
        display: none !important;
    }
    table {

  width: 100%; 
  height:50px; 
}
</style>
<link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=50d134a99f38dd18b1cce14412acc94f">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" media="print"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" media=""  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<script class="init">
 
$(document).ready(function() {
	$('#example').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'print',
				customize: function ( win ) {
					$(win.document.body)
						.css( 'font-size', '10pt' )
						.prepend(
                            'aaaaaaaaaaaaaaaaaaaaaaaa'
						);

					$(win.document.body).find( 'table' )
						.addClass( 'compact' )
						.css( 'font-size', 'inherit' );
				}
			}
		]
	} );
} );
</script>

         <h1 class="box-title" style="font-size:10px"><strong>MOSTRAR PONTO MENSAL: {{$user->name}} DE : {{Carbon\Carbon::parse($start)->format('Y-m-d')}} - A - {{Carbon\Carbon::parse($end)->format('Y-m-d')}} </strong><strong style="font-size:10px;text-align:right !important;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MÊS DE PROCESSAMENTO:</strong> {{$mes}}</h1>


     


<div class="container">


        
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
 </div>
</div>
     <div class="row">
         <div class="col-md-12">
             <table id="example" class="table table-hover" style="width:100%">
                 <thead>
                     <tr>
                         <th class="no-print"># </th>
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
                     
                     
                
                     
                         <div class="no-print">
                                {{-- ver se é dias de fds --}}

                                {{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized(' %a' )}}
                                {{ $sabado=(strstr($dia[$i], 'Sáb'))}}
                                {{ $domingo=(strstr($dia[$i], 'Dom'))}}
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
                                         <td  class="no-print">{{$i}}</td>
                                         <td class="font-weight-bold">{{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized('%a %d  %b de %Y ')}} 
                                        @if ($test>=0)
                                        <td class="text-center"><span class="label label-success">Presente</span></td>
                                        <td class="text-center">
                                                @if ($ponto[$test]->entradaManha!=null)
                                                <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                            @else
                                            <strong > EM:--:--:-- </strong>
                                            @endif </td>
                                            <td class="text-center">
                                                    @if ($ponto[$test]->saidaManha!=null)
                                                        <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                                    @else
                                                    <strong > SM: --:--:-- </strong>
                                                    @endif </td>
                                                
                                            <td class="text-center">
                                                    @if ($ponto[$test]->tempoAlmoco!=null)
                                                    <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                                @else
                                                <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                                
                                                @endif </td>
                                            <td class="text-center">
                                            @if ($ponto[$test]->entradaTarde!=null)
                                            <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                            @else
                                            <strong > ET: --:--:-- </strong>
                                            @endif       </td>
                                        
                                            <td class="text-center">
                                            @if ($ponto[$test]->saidaTarde!=null)
                                            <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                            @else
                                            <strong  > ST: --:--:-- <strong>
                                            @endif
                                                
                                            </td>
                                                    
                                    
                                            <td class="text-center">
                                            @if ($ponto[$test]->totalDia!=null)
                                            <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                            @else
                                            <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                            @endif 
                                        
                                        
                                                </td>
                                            <td  class="text-center">
                                            @if ($ponto[$test]->fk_justificacao==1)
                                       
                                                
                                            @else
                                            @endif
                                        
                                            @if ($ponto[$test]->comentario==null)
                                            
                                            @else
                                            {{$ponto[$test]->comentario}}
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
                                         <td  class="no-print">{{$i}}</td>
                                
                               
                                         <td class="font-weight-bold">{{$dia[$i]= Carbon\Carbon::parse($start)->addDays($i)->formatLocalized('%a %d  %b de %Y ')}} 
                                  @if ($test<0)
                                                
                                      <td class="text-center"><span class="label label-danger">Falta</span></td>
                                     <td class="text-center">EM:--:--:--</td>
                                     <td class="text-center">SM:--:--:--</td>
                                     <td class="text-center"> <i class="fas fa-utensils"></i> {{' --:--:--'}}</td>
                                     <td class="text-center">EM:--:--:--</td>
                                     <td class="text-center">SM:--:--:--</td>
                                     <td class="text-center">    <i class="far fa-clock"></i>   {{' --:--:--'}}</td>
                                     <td class="text-center"> </button>
                                     </td>
                                  
                                  
                                   @else
                                   @if ($falta>0)
                                                
                                   <td class="text-center"><span class="label label-danger">Falta</span></td>
                                  <td class="text-center">EM:--:--:--</td>
                                  <td class="text-center">SM:--:--:--</td>
                                  <td><i class="fas fa-utensils"></i> {{' --:--:--'}}</td>
                                  <td class="text-center">EM:--:--:--</td>
                                  <td class="text-center">SM:--:--:--</td>
                                  <td class="text-center">    <i class="far fa-clock"></i>   {{' --:--:--'}}</td>
                                  <td class="text-center"></button>
                                  </td>
                                  @elseif($ponto[$test]->totalDia=='00:00:00' and  $ponto[$test]->entradaManha=='00:00:00')
                                  <td class="text-center"><span class="label label-warning">Ausente</span></td>
                                  <td class="text-center">
                                     @if ($ponto[$test]->entradaManha!=null)
                                     <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                 @else
                                 <strong > EM:--:--:-- </strong>
                                 @endif </td>
                                 <td class="text-center">
                                         @if ($ponto[$test]->saidaManha!=null)
                                             <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                         @else
                                         <strong > SM: --:--:-- </strong>
                                         @endif </td>
                                     
                                 <td class="text-center">
                                         @if ($ponto[$test]->tempoAlmoco!=null)
                                         <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                     @else
                                     <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                     
                                     @endif </td>
                                 <td class="text-center">
                                 @if ($ponto[$test]->entradaTarde!=null)
                                 <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                 @else
                                 <strong > ET: --:--:-- </strong>
                                 @endif       </td>
                             
                                 <td class="text-center">
                                 @if ($ponto[$test]->saidaTarde!=null)
                                 <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                 @else
                                 <strong  > ST: --:--:-- <strong>
                                 @endif
                                     
                                 </td>
                                         
                         
                                 <td class="text-center">
                                 @if ($ponto[$test]->totalDia!=null)
                                 <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                 @else
                                 <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                 @endif 
                             
                             
                                     </td>
                                 <td  class="text-center">
                                 @if ($ponto[$test]->fk_justificacao==0)
                                   
                                 @else
                                 {{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao', $ponto[$test]->fk_justificacao)->value('descricao')}}
                                 @endif
                             
                                 @if ($ponto[$test]->comentario==null)
                             
                                 @else
                                   / {{$ponto[$test]->comentario}}
                                 @endif 
                                  @else
                                     <td class="text-center"><span class="label label-success">Presente</span></td>
                                     <td class="text-center">
                                             @if ($ponto[$test]->entradaManha!=null)
                                             <strong > EM: {{$ponto[$test]->entradaManha}} </strong>
                                         @else
                                         <strong > EM:--:--:-- </strong>
                                         @endif </td>
                                         <td class="text-center">
                                                 @if ($ponto[$test]->saidaManha!=null)
                                                     <strong > SM: {{$ponto[$test]->saidaManha}} </strong>
                                                 @else
                                                 <strong > SM: --:--:-- </strong>
                                                 @endif </td>
                                             
                                         <td class="text-center">
                                                 @if ($ponto[$test]->tempoAlmoco!=null)
                                                 <i class="fas fa-utensils"></i> <span > {{'    '.$ponto[$test]->tempoAlmoco.' '}}</span>
                                             @else
                                             <span>   <i class="fas fa-utensils"></i> {{'--:--:--'}}</span>
                                             
                                             @endif </td>
                                         <td class="text-center">
                                         @if ($ponto[$test]->entradaTarde!=null)
                                         <strong > ET: {{$ponto[$test]->entradaTarde}}</strong>
                                         @else
                                         <strong > ET: --:--:-- </strong>
                                         @endif       </td>
                                     
                                         <td class="text-center">
                                         @if ($ponto[$test]->saidaTarde!=null)
                                         <strong > ST: {{$ponto[$test]->saidaTarde}} </strong>
                                         @else
                                         <strong  > ST: --:--:-- <strong>
                                         @endif
                                             
                                         </td>
                                                 
                                 
                                         <td class="text-center">
                                         @if ($ponto[$test]->totalDia!=null)
                                         <span >  <i class="far fa-clock"></i>   {{' '.$ponto[$test]->totalDia.' '}}</span>
                                         @else
                                         <span>   <i class="far fa-clock"></i>   {{'--:--:--'}}</span>
                                         @endif 
                                     
                                     
                                             </td>
                                         <td  class="text-center">
                                         @if ($ponto[$test]->fk_justificacao==0)
                                      
                                         @else
                                         {{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao', $ponto[$test]->fk_justificacao)->value('descricao')}}
                                         @endif
                                     
                                         @if ($ponto[$test]->comentario==null)
                                       
                                         @else
                                         / {{$ponto[$test]->comentario}}
                                             {{-- <button type="button" class="btn btn-xs btn-success fas fa-comments" title= {{$ponto[$test]->comentario}}></button> --}}
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


                                    <div  style="font-size:8px;">
                                         
                                    <div style="position:absolute; right:0px;" >
                                        Dias Úteis:{{$diasuteis}} <br>
                                        Presente: {{$diastrabalhados}} <br>
                                        Alimentação: {{$alimentacao}} <br>
                                        Faltas (Justificadas/Injustificadas): {{$faltasjustificadas .' / '. $faltasinjustificadas}} <br>
                                        Férias: {{$ferias}}
                                    </div>
                                            <br><br><br>

                                            ______________________________________ <br>
                                            Assinatura do Colaborador
                                            
                                            <br><br><br><br>
                                            ______________________________________ <br>
                                            Assinatura do Responsável RH
                                            
                                        </div>
                            
      
     