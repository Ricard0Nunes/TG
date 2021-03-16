
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

         <h1 class="box-title" style="font-size:10px"><strong>RELATÓRIO PROCESSAMENTO {{ $processar[0]->intervaloProcessamento}}:   MÊS DE PROCESSAMENTO:</strong> {{$processar[0]->mes}}</h1>


     


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


<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tbody><tr>
        <th class="text-center">Empresa</th>
        <th class="text-center">Nome Colaborador</th>
        <th class="text-center">Mês</th>
        <th class="text-center">Dias Trabalhados</th>
        <th class="text-center">Dias Utéis</th>
        <th class="text-center">Férias</th>
        {{-- <th class="text-center">Alimentação</th> --}}
        <th class="text-center">Faltas Injustificadas</th>
        <th class="text-center">Faltas C/ Retribuição</th>
        <th class="text-center">Faltas S/ Retribuição</th>
        <th class="text-center">Observações</th>

      </tr>
      
       
{{-- @FOR ($processar as $processar) --}}
@for ($i = 0; $i <count($processar) ; $i++)
    
        {{-- @if ($processar[$i]->nifEmpresa==$processar[$i-1]->nifEmpresa)
        <tr id="tr">
        @else --}}
        
        <tr id="tr" class="odd even"> 
     

{{-- @endif --}}



        <td class="text-center"  style="background-color: {{DB::connection('geraltg')->table('empresascomuns')->where('nif',$processar[$i]->nifEmpresa)->value('observacoes')}};">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$processar[$i]->nifEmpresa)->value('nomeAbreviado')}}</td>
                            <td class="text-center">{{$processar[$i]->nome}}</td>
                            <td class="text-center">{{$processar[$i]->mes}}</td>
                            <td class="text-center">{{$processar[$i]->diasTrabalhados}}</td>
                            <td class="text-center">{{$processar[$i]->diasUteis}}</td>
                            <td class="text-center">{{$processar[$i]->ferias}}</td>
                            {{-- <td class="text-center">{{$processar[$i]->diasSubsidioAlimentacao}}</td> --}}
                            <td class="text-center">{{$processar[$i]->diasFaltasInjustificadas}}</td>
                            <td class="text-center">{{$processar[$i]->diasFaltasComRetribuicao}}</td>
                            <td class="text-center">{{$processar[$i]->diasFaltasSemRetribuicao}}</td>
                            <td class="text-center">{{$processar[$i]->observacoes}}</td>
<br>
    
@endfor
      </tr>
     
    </tbody></table>
  </div>






{{-- 
     <div class="row">
         <div class="col-md-12">
             <table id="example" class="table table-hover" style="width:100%">
                 <thead>
                     <tr>
                      
                       
                      
                     </tr>
                 </thead>
                 <tbody>


      
     </div> --}}

{{-- 
@foreach ($processar as $processar)

<tr id="tr">

                            <td class="text-justify">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$processar->nifEmpresa)->value('nomeAbreviado')}}</td>
                            <td class="text-center">{{$processar->nome}}</td>
                            <td class="text-center">{{$processar->mes}}</td>
                            <td class="text-center">{{$processar->diasTrabalhados}}</td>
                            <td class="text-center">{{$processar->diasUteis}}</td>
                            <td class="text-center">{{$processar->ferias}}</td>
                            <td class="text-center">{{$processar->diasSubsidioAlimentacao}}</td>
                            <td class="text-center">{{$processar->diasFaltasInjustificadas}}</td>
                            <td class="text-center">{{$processar->diasFaltasComRetribuicao}}</td>
                            <td class="text-center">{{$processar->diasFaltasSemRetribuicao}}</td>
</tr>
    
@endforeach
<br><br><br> <br><br><br> <br><br><br> <br><br><br> --}}


                                    <div  style="font-size:8px;">
                                         
                                    <div style="position:absolute; right:0px;" >
                                        {{-- Dias Úteis:{{$diasuteis}} <br>
                                        Presente: {{$diastrabalhados}} <br>
                                        Alimentação: {{$alimentacao}} <br>
                                        Faltas (Justificadas/Injustificadas): {{$faltasjustificadas .' / '. $faltasinjustificadas}} <br>
                                        Férias: {{$ferias}} --}}
                                        ______________________________________ <br>
                                        Assinatura do Responsável RH
                                    </div>
                                            <br><br><br>

                                            {{-- ______________________________________ <br>
                                            Assinatura do Colaborador --}}
                                            
                                            <br><br><br><br>
                                       
                                            
                                        </div>
                            
      
     