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
      <h1 class="box-title" >MOSTRAR CONTACTOS COM CLIENTES</h1>
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
                     <th class="text-center">Data de Contacto </th>
                     <th class="text-center">Próximo Contacto</th>
                     <th class="text-center">Parecer</th>
                     <th class="text-center">Mensagem</th>
                     <th class="text-center">Mensagem do Cliente</th>
                    
                     <th class="text-center">Tipo de Contacto</th>
                     
                     <th class="text-center">Lead</th>    
                     <th class="text-center">Responsável</th>                                 
               
                     <th class="text-center">Gerir</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($contacto as $contacto)
                  {{-- dados da tabela --}}
                  <td class="text-center">{{$contacto->dataContacto}}</td>
                
                  <td class="text-center">{{$contacto->proximoContacto}}</td>
                  <td class="text-center">{{$contacto->parecer}}</td>
                  {{-- <td class="text-center"> {{DB::table('users')->where('id',$contacto->fk_formador)->value('name')}}</td> --}}
           
                  <td class="text-center">{{$contacto->mensagem}}</td>
                  <td class="text-center">{{$contacto->mensagemCliente}}</td>

                  <td class="text-center">{{DB::table('tipo_contactos')->where('pk_tipo_contacto',$contacto->fk_tipo_contacto)->value('tipoContacto')}}</td>                 
                    {{-- <td class="text-center">{{DB::table('users')->where('id',$lead->fk_potencialCliente)->value('name')}}</td>  --}}
                   <td class="text-center">{{DB::table('potencialclientes')->where('pk_potencialCliente',$contacto->fk_potencialCliente)->value('nomeAbreviado')}}</td>  

                   <td class="text-center">{{DB::table('users')->where('id',$contacto->fk_responsavel)->value('name')}}</td> 

                <td>
                   
                       {!! Form::open(array('route' => 'edit.contactosComClientes','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                       {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                       <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$contacto->pk_contactoscomclientes}} >
                       <button type="submit" class="btn btn-warning far fa-edit" text="Avaliar" title="Editar Contacto com Cliente"> 
                       </button>
                       </a> 
                       {!! Form::close()!!} 

                       
                   
                       {{-- {!! Form::open(array('route' => 'destroy.contactosComClientes','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                       {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                       <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$contacto->pk_contactoscomclientes}} >
                       <button type="submit" class="btn btn-success far fa-trash-alt" text="Ver" title="Ver"> 
                       </button>
                       </a> 
                       {!! Form::close()!!} --}}
                       
                       {{-- <div class="col-xs-12 col-sm-12 col-md-2" >
                        <a href="/showcontactosComCliente" ><button type="button" class="btn btn-block btn-warning btn-flat">
                        Voltar</button></a>
                     </div> --}}
                  </td> 
                </tr>
         @endforeach
         </tbody>
         </table>
         <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-4" >
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="/newcontactosComClientes" ><button type="button" class="btn btn-block btn-success btn-flat">
                  Adicionar Contacto</button></a>
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