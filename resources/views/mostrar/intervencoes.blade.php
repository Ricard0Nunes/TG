@extends('adminlte::page')

@section('userss', 'AdminLTE')




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
<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR INTERVENÇÕES</h1>
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
                                <th class="text-center">Projeto</th>
                                <th class="text-center">Etapa</th>
                                <th class="text-center">Nome da Tarefa</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Estado</th>

                                
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $tasks)
                        <tr id="tr">
                            {{-- dados da tabela --}}
                            <td class="text-center" >{{' '.DB::table('projetos')->where('pk_projeto',$tasks->fk_projeto)->value('codProj')}}
                                
                             </td>
                            <td class="text-center">{{DB::table('tasks')->where('id',$tasks->parent)->value('text')}}</td>
                            <td class="text-center">{{$tasks->text}}</td>
                            <td class="text-center">{{DB::table('users')->where('id',$tasks->fk_tecnico)->value('sigla')}}</td>
                            <td class="text-center">{{DB::table('clientes')->where('pk_cliente',DB::table('projetos')->where('pk_projeto',$tasks->fk_projeto)->value('fk_cliente'))->value('nomeAbreviado')}}</td>

                            @if ($tasks->fk_estadoIntervencao == 3 or $tasks->fk_estadoIntervencao == 7)
                            <td class="text-center"> <span class="label label-success">{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks->fk_estadoIntervencao)->value('descricao')}}</span>
                            </td>

                        @elseif ($tasks->fk_estadoIntervencao == 1 or $tasks->fk_estadoIntervencao == 4)
                         
                        <td class="text-center"> <span class="label label-info">{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks->fk_estadoIntervencao)->value('descricao')}}</span>

                                @elseif ($tasks->fk_estadoIntervencao == 2)
                         
                                <td class="text-center"> <span class="label label-warning">{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks->fk_estadoIntervencao)->value('descricao')}}</span>

                                    @else
                         
                                    <td class="text-center"> <span class="label label-danger">{{DB::table('estadoIntervencoes')->where('pk_estadoIntervencoes',$tasks->fk_estadoIntervencao)->value('descricao')}}</span>

                        @endif

                           
                         

                            <td>  {{--opçoes de gestão de taskss--}}
                                <div class="text-center">
                                  
                                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                      <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                        <button type="submit" class="btn btn-success fas fa-eye" text="Ver Projeto" title="Ver Intervenção"> 
                                       </button>
                                    </a> 
                                        {!! Form::close()!!} 
                                
                                            {!! Form::open(array('route' => 'projeto.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                              <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->fk_projeto}}>
                                                <button type="submit" class="btn btn-info fas fa-hard-hat" text="Ver Projeto" title="Projeto"> 
                                               </button>
                                            </a> 
                                                {!! Form::close()!!}

                                                {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                                    <button type="submit" class="btn btn-warning fas fa-pencil-alt" text="Ver Projeto" title="Editar Intervenção"> 
                                                   </button>
                                                </a> 
                                                    {!! Form::close()!!} 
                                    
                                 

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
                                        <a href="{{url('/')}}/criartarefa" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Intervenção</button></a>
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




