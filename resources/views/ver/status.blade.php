@extends('adminlte::page')

@section('Status', 'AdminLTE')

@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
<script>
  $(document).ready(function() {
    $('#manha').DataTable({"language": {
              "url": "js/localeDataTable.js"
          }}, {
          
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
$(document).ready(function() {
    $('#almoco').DataTable({"language": {
              "url": "js/localeDataTable.js"
          }}, {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
$(document).ready(function() {
    $('#tarde').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }},{
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
$(document).ready(function() {
    $('#saida').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }},{
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
$(document).ready(function() {
    $('#ausente').DataTable({"language": {
              "url": "js/localeDataTable.js"
          }}, {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>
    <!-- timeline time label -->
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <ul class="timeline">
     
    <li class="time-label">
        <i class="fa fas fa-door-open bg-green"></i>
    </li>
    <br>
    <li>
      {{-- <i class="fa fa-door-open bg-green"></i> --}}
      <div class="timeline-item">
        <h3 class="timeline-header"><a href="#">Manhã</a> ({{count($manha)}})</h3>
        <div class="timeline-body">
            <div class="box-body">
              <table id="manha" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Nome</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($manha as $manha)
             <tr>
                    <td class="text-justify"><img src= {{$manha['foto']}}  class="img-circle img-sm" alt="User Image">    ({{$manha['sigla']}})</td>
                    <td class="text-justify"> {{$manha['name']}}</td>
                   </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>

                  </div>  

        </div>
      </div>
    </li>
  </ul>
  </div>
  <div class="col-md-6 col-xs-12">
    <ul class="timeline">
      <li class="time-label">
        <i class="fa fa-utensils bg-yellow"></i>
    </li>
    <br>
      <li>

        <div class="timeline-item">
           
            <h3 class="timeline-header"><a href="#">A Almoçar</a>({{count($almoco)}})</h3>

            <div class="timeline-body">
      
                <div class="box-body">   
                  <table id="almoco" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($almoco as $almoco)
                 <tr>
                        <td class="text-justify"><img src= {{$almoco['foto']}}  class="img-circle img-sm" alt="User Image">   ({{$almoco['sigla']}})</td>
                        <td class="text-justify"> {{$almoco['name']}} </td>
                       </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
    

            </div>
        </div>
    </li>
    </ul>
</div>
</div>
<div class="row">
  <div class="col-md-6 col-xs-12">
    <ul class="timeline">
 
<li class="time-label">
    <i class="fa fas fa-door-open bg-green"></i>
</li>
<br>
<li>
  {{-- <i class="fa fa-door-open bg-green"></i> --}}
  <div class="timeline-item">
    <h3 class="timeline-header"><a href="#">Tarde</a> ({{count($tarde)}})</h3>
    <div class="timeline-body">
        <div class="box-body">
          <table id="tarde" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nome</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tarde as $tarde)
         <tr>
                <td class="text-justify"><img src= {{$tarde['foto']}}  class="img-circle img-sm" alt="User Image">    ({{$tarde['sigla']}})</td>
                <td class="text-justify"> {{$tarde['name']}}</td>
               </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>

              </div>  

    </div>
  </div>
</li>
</ul>
</div>
<div class="col-md-6 col-xs-12">
<ul class="timeline">
  <li class="time-label">
    <i class="fa fa-door-closed bg-red"></i>
</li>
<br>
  <li>

    <div class="timeline-item">
       
        <h3 class="timeline-header"><a href="#">Saída</a>({{count($saida)}})</h3>

        <div class="timeline-body">
  
            <div class="box-body">   
              <table id="saida" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Nome</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($saida as $saida)
             <tr>
                    <td class="text-justify"><img src= {{$saida['foto']}}  class="img-circle img-sm" alt="User Image">    ({{$saida['sigla']}})</td>
                    <td class="text-justify"> {{$saida['name']}}</td>
                   </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>


        </div>
    </div>
</li>
</ul>
</div>
</div> 
   
<div class="row">
  <div class="col-md-12 col-xs-12">
    <ul class="timeline">
 
<li class="time-label">
  <i class="fa fas fa-user-secret bg-blue"></i>
</li>
<br>
<li>
  {{-- <i class="fa fa-door-open bg-green"></i> --}}
  <div class="timeline-item">
    <h3 class="timeline-header"><a href="#">Ausente</a> ({{count($ausente)}})</h3>
    <div class="timeline-body">
        <div class="box-body">
          <table id="ausente" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Ausência</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($ausente as $ausente)
         <tr>
                <td class="text-justify"><img src= {{$ausente['foto']}}  class="img-circle img-sm" alt="User Image">   ({{$ausente['sigla']}})</td>
                <td class="text-justify"> {{$ausente['name']}} </td>
                <td class="text-justify">
                @for ($t = 0; $t < count($tasks); $t++)
                @if ($ausente->bi==$tasks[$t]->biuser)
                {{DB::connection('geraltg')->table('justificacoes')->where ('pk_justificacao', $tasks[$t]->fk_justificacao)->value('descricao')
                }}
                @endif
                @endfor
              </td>
        

            </tr>
        @endforeach
        </tbody>
        </table>

              </div>  

    </div>
  </div>
</li>
</ul>
</div>
</div> 
@stop