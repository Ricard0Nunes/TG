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
      <h1 class="box-title" >MOSTRAR TIPO DE CAMPANHA</h1>
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
                     <th class="text-center">Tipo de Campanha</th> 
                     <th class="text-center">Gerir</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($tipo_campanha as $tipo_campanha)
                  {{-- dados da tabela --}} 
                  <td class="text-center">{{$tipo_campanha->tipoCampanha}}</td>  
               <td class="text-center">   {!! Form::open(array('route' => 'editar.tipo_campanha','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  <a href="" > <input id="aaa" name="id" type="hidden" value={{$tipo_campanha->pk_tipo_campanha}}><button type="submit" class="fas fa-pencil-alt btn btn-warning" title="Editar Tipo de Campanha"> 
                  </button></a>                  
                  {!! Form::close()!!} 
                {!! Form::open(array('route' => 'tipo_campanha.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                        <a href="" > <input id="aaa" name="id" type="hidden" value={{$tipo_campanha->pk_tipo_campanha}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Eliminar Tipo de Campanha"> 
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
            <div class="col-xs-12 col-sm-12 col-md-2" >
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >
               <a href="{{url('/')}}/newtipocampanha" ><button type="button" class="btn btn-block btn-success btn-flat">
               Criar um tipo de campanha</button></a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >
               <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                       Voltar</button></a>
           </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >
            </div>
         </div> 
         <br><br>
      </div>
   </div>
</div>
</div> 
@endsection