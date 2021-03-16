@extends('adminlte::page')

@section('Requisição', 'AdminLTE')




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
</script>
<style>
td:hover{
    background-color: #e2e2e2;
}


</style>

<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR REQUISIÇÕES SALAS</h1>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                   @if (session('danger'))
                   <div class="alert alert-danger" role="alert">
                      <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                       {{ session('danger') }}
                   </div>
                   @endif 
                </div>
             </div>
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                      <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                      {{ session('success') }}
                   </div>
                   @endif 
                </div>
             </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>

                                <th class="text-center">#</th>
                                
                                <th class="text-center">Requisitante</th>
                                <th class="text-center">Sala</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Hora Início</th>
                                <th class="text-center">Hora Fim</th>
                                <th class="text-center">Observações</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisicaosala as $requisicaosala)
                     <tr>
                       
                            <td class="text-center">{{$requisicaosala->pk_requisicaosala}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('userscomuns')->where('BI',$requisicaosala->requisitadoPor)->value('nome')}}</td>
                            {{-- <td class="text-center">{{DB::table('users')->where('id',$requisicaosala->requisitadoPor)->value('name')}} --}}
                            <td class="text-center">{{DB::connection('geraltg')->table('salas')->where('pk_sala',$requisicaosala->fk_sala)->value('nome')}}</td>
                            <td class="text-center">{{carbon\carbon::parse($requisicaosala->data)->formatLocalized(' %d de %B de %Y')}}</td>
                            <td class="text-center">{{$requisicaosala->horaInicio}}</td>
                            <td class="text-center">{{$requisicaosala->horaFim}}</td>
                            <td class="text-center">{{$requisicaosala->observacoes}}</td>

                            <td class="text-center"> 
                            
                                {!! Form::open(array('route' => 'requisicaosala.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                <a href="" > <input id="aaa" name="id" type="hidden" value={{$requisicaosala->pk_requisicaosala}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Apagar Requisição Sala"> 
                                </button></a>                  
                                {!! Form::close()!!}

                                 </td>
                               
                     </tr>
                     @endforeach
                    </tbody>
                    </table>

                </div>
               
                {{-- <a href="novorequisicao" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar requisicao</a> Editar recurso --}}

            </div>
      
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-3" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3" >
                            <a href="{{url('/')}}/requisitarsala" ><button type="button" class="btn btn-block btn-success btn-flat">
                                   Requisitar Sala</button></a>
                        </div>

                            <div class="col-xs-12 col-sm-12 col-md-3" >
                                    <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                            Voltar</button></a>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3" >
        
                    </div>
        </div><br><br>
    </div> 
@endsection




