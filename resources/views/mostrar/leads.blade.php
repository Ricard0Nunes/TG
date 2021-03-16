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
      <h1 class="box-title" >MOSTRAR LEADS</h1>
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
                     <th class="text-center">#</th> 
                     <th class="text-center">Início</th> 
                     <th class="text-center">Fim</th> 
                     <th class="text-center">Objetivos</th> 
                     <th class="text-center">Notas</th> 
                     <th class="text-center">Responsável</th> 
                     <th class="text-center">Potencial Cliente</th> 
                     <th class="text-center">Gerir</th>

                  </tr>
               </thead>
               <tbody>
                  @foreach ($leads as $leads)
                  {{-- dados da tabela --}} 
                  <td class="text-center">{{$leads->pk_lead}}</td>  
                  <td class="text-center">{{$leads->inicio}}</td>  
                  <td class="text-center">{{$leads->fim}}</td>   
                  <td class="text-center">{{$leads->objetivo}}</td>  
                  <td class="text-center">{{$leads->notas}}</td>  
                  <td class="text-center">{{DB::table('users')->where('id',$leads->fk_responsavel)->value('name')}}</td>
                  <td class="text-center">{{DB::table('potencialclientes')->where('pk_potencialCliente',$leads->fk_potencialCliente)->value('nomeCompleto')}}</td>
         
               <td class="text-center">  

                  {!! Form::open(array('route' => 'editar.lead','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$leads->pk_lead}}><button type="submit" class="fas fa-pencil-alt btn btn-warning" title="Editar Lead"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                  
                  {{-- {!! Form::open(array('route' => 'ver.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'ver')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-eye btn btn-success" title="Ver Potencial Cliente"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                  {!! Form::open(array('route' => 'editar.potencialcliente','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-pencil-alt btn btn-warning" title="Editar Potencial Cliente"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                {!! Form::open(array('route' => 'potencialcliente.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$potencialcliente->pk_potencialCliente}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Eliminar Potencial Cliente"> 
                        </button></a>                 
                        {!! Form::close()!!} --}}
                     </div>
         </div>
         </td>
         </tr>
         @endforeach
         </tbody>
         </table>
   
         <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-4" >
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="{{url('/')}}/newlead" ><button type="button" class="btn btn-block btn-success btn-flat">
                  Criar Lead</button></a>
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