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
      <h1 class="box-title" >PRAZOS ORÇAMENTOS</h1>
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
          
                     <th class="text-center">Dias</th>
                     <th class="text-center">Descrição</th>
                     <th class="text-center">Gerir</th>
                    
                  </tr>
               </thead>
               <tbody>
                  @foreach ($prazo as $prazo)
                  {{-- dados da tabela --}}

                  {{-- @if ($prazo->pk_origem==null) --}}
                  <td class="text-center">{{$prazo->dias}}</td>
                  <td class="text-center">{{$prazo->prazo}}</td>

                  <td>
                    <div class="text-center">
                       {!! Form::open(array('route' => 'editar.crm_origem','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                       {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                       <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$prazo->pk_prazo}} >
                       <button type="submit" class="btn btn-warning far fa-edit" text="Avaliar" title="Editar Origem"> 
                       </button>
                       </a> 
                       {!! Form::close()!!} 

                       
                        
                           
                       
                              
                    </div>
                  </td>
                </tr>
         @endforeach
         </tbody>
         </table>
         {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
         <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-4" >
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2" >
               <a href="{{url('/')}}/criarprazo" ><button type="button" class="btn btn-block btn-success btn-flat">
               Criar Novo Prazo</button></a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2" >
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