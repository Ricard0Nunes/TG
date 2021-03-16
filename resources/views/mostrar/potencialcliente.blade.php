@extends('adminlte::page')
@section('Cargos', 'AdminLTE')
@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});
   });

   $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
  
</script>

<div class="box box-success">
   <div class="box-header with-border" >
      <h1 class="box-title" >MOSTRAR POTENCIAL CLIENTE</h1>
      <div class="box-tools pull-right">
         <!-- Buttons, labels, and many other things can be placed here! -->
         <!-- Here is a label for example -->
         {{-- <span class="label label-primary">Criar um Cargo</span> --}}
      </div>
      <!-- /.box-tools -->
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            @if (session('danger'))
            <div class="alert alert-danger" role="alert">
               <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
               <strong> {{ session('danger') }}</strong>
            </div>
            @endif 
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
               <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
               <strong> {{ session('success') }}</strong>
            </div>
            @endif 
         </div>
      </div>

   <!-- Modal -->



      <div class="row">
         <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr> 
                     <th class="text-center">NIF</th> 
                     <th class="text-center">Nome Completo</th> 
                     <th class="text-center">Nome Abreviado</th> 
                     <th class="text-center">Estado</th> 
                     <th class="text-center">Email</th> 
                     <th class="text-center">Morada</th> 
                     <th class="text-center">Contacto</th> 
                     <th class="text-center">Contacto Alternativo</th> 
                     <th class="text-center">Observações</th> 
                     <th class="text-center">Criado Por</th>
                     <th class="text-center">Gerir</th>

                  </tr>
               </thead>
               <tbody>
                  @foreach ($potencialcliente as $potencialcliente)
                  {{-- dados da tabela --}} 
                  <td class="text-center">{{$potencialcliente->NIF}}</td>  
                  <td class="text-center">{{$potencialcliente->nomeCompleto}}</td>   
                  <td class="text-center">{{$potencialcliente->nomeAbreviado}}</td>  
                   <td class="text-center">@if ($potencialcliente->convertido==0)
                       Não convertido
                   @else
                       Cliente Convertido
                   @endif
                      
                  </td>      
                  <td class="text-center">{{$potencialcliente->email}}</td>  
                  <td class="text-center">{{$potencialcliente->morada}}</td>   
                  <td class="text-center">{{$potencialcliente->contacto}}</td>   
                  <td class="text-center">{{$potencialcliente->contactoAlternativo}}</td>   
                  <td class="text-center">{{$potencialcliente->observacoes}}</td>    
                  <td class="text-center"> {{DB::table('users')->where('id',$potencialcliente->fk_criador)->value('name')}}</td>


               <td class="text-center">   
                  @if ($potencialcliente->convertido==0)
                  {!! Form::open(array('route' => 'ver.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'ver')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-eye btn btn-success" title="Ver Potencial Cliente"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                      
                  @else
        
                     
                         {!! Form::open(array('route' => 'cliente.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                         {{ Form::hidden('invisible', 'secret', array('id' => 'ver')) }}
                         <a href="" > <input id="aaa" name="id" type="hidden" value={{App\cliente::where('fk_potencialCliente',$potencialcliente->pk_potencialCliente)->value('pk_cliente')}}><button type="submit" class="fas fa-eye btn btn-success" title="Ver Cliente"> 
                         </button></a>                  
                         {!! Form::close()!!} 
           
                        
                           
                  @endif

                  @if ($potencialcliente->convertido==0)
                  {!! Form::open(array('route' => 'editar.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-pencil-alt btn btn-warning" title="Editar Potencial Cliente"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                  @endif
                  {!! Form::open(array('route' => 'converter.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  @if ($potencialcliente->convertido==0)
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-retweet btn btn-info" title="Converter Cliente"> 

                  @else
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-retweet btn btn-info" title="Converter Cliente" disabled> 

                  @endif
                  </button></a>                  
                  {!! Form::close()!!} 
               
                     </div>
         </div>
         </td>
         </tr>
         @endforeach
         </tbody>
         </table>
 
         <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-5" >
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="{{url('/')}}/newpotencialcliente" ><button type="button" class="btn btn-block btn-success btn-flat">
                  Criar Potencial Cliente</button></a>
               </div>

                     
                            <div class="col-xs-12 col-sm-12 col-md-5" >
    
                </div>
    </div><br><br>


      </div>
   </div>
</div>
</div> 
@endsection