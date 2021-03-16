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
                <h1 class="box-title" >MOSTRAR REQUISIÇÕES EQUIPAMENTO</h1>
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
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>

                                <th class="text-center">#</th>
                                
                                <th class="text-center">Requisitante</th>
                                <th class="text-center">Data Inicio</th>
                                <th class="text-center">CPU</th>
                                <th class="text-center">Periféricos</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Data Fim </th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisicao as $requisicao)
                     <tr>
                       
                            <td class="text-center">{{$requisicao->pk_requisicaoequipamento}}</td>
                            <td class="text-center">{{DB::table('users')->where('bi',$requisicao->requisitadoPor)->value('name')}}
                            <td class="text-center">{{$requisicao->dataInicio}}</td>
                            <td class="text-center">{{$requisicao->cpu}}</td>
                            <td class="text-center">
                                @if ($requisicao->peri==null)
                                    Sem periféricos
                                @else
                                {{$requisicao->peri}}
                                @endif
                                
                                </td>
                            <td class="text-center">
                                @if ($requisicao->dataFim==NULL)
                                <span class="badge bg-green">Ativa</span>
                                @else
                                <span class="badge bg-red">Terminada</span>
                                @endif
                              
                            </td>
                            <td class="text-center">{{$requisicao->dataFim}}</td>
                            <td class="text-center"> 
                                @if (DB::table('users')->where('id',auth::id())->value('fk_departamento')==2 and $requisicao->dataFim==NULL)
                                {!! Form::open(array('route' => 'requisicaoequipamento.parar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                            <a>   <input id="invisible_id" name="id" type="hidden"  value="{{$requisicao->pk_requisicaoequipamento}}"}>
                                <button type="submit" class="btn btn-danger far fa-stop-circle"  text="Parar"  title="Parar Requisição"> 
                               </button></a>
                                    {!! Form::close()!!} 
                                    {!! Form::open(array('route' => 'termoresponsabilidade.emitir','method'=>'POST','files'=>'true','style'=>'display:inline-block','target'=>'_blank')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                <a>   <input id="invisible_id" name="id" type="hidden"  value="{{$requisicao->pk_requisicaoequipamento}}"}>
                                    <button type="submit" class="btn btn-info fas fa-file-contract"  text=""  title="Emitir Termo"> 
                                   </button></a>
                                        {!! Form::close()!!} 
                                    @endif
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
                            <a href="{{url('/')}}/requisitarequipamento" ><button type="button" class="btn btn-block btn-success btn-flat">
                                   Requisitar Equipamento</button></a>
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




