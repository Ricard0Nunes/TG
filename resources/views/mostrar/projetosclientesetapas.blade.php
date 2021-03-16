@extends('adminlte::page')

@section('Etapas', 'Etapas')




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
                <h1 class="box-title" >CRIAR ETAPA: ESCOLHA O PROJETO</h1>
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
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Datas</th>
                                <th class="text-center">Estado</th>

                                
                                <th class="text-center">Abrir Etapa</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($projetos as $projetos)
                        <tr id="tr">
                              

                            <td class="text-center" >{{$projetos->codProj}} </td>

                            <td class="text-justify">{{DB::table('users')->where('id',$projetos->fk_responsavel)->value('sigla')}}</td>
                            <td class="text-justify">{{DB::table('clientes')->where('pk_cliente',$projetos->fk_cliente)->value('nomeAbreviado')}}</td>
                           
                            <td class="text-justify">Data Prevista Início:
                                    @if ($projetos->dataPrevistaInicio==null)
                                     ---- -- --
                                    @else
                                    {{$projetos->dataPrevistaInicio}} 
                                    @endif
                                     <br>Data Início: 
                                     @if ($projetos->dataInicio==null)
                                         ---- -- --
                                     @else
                                     {{$projetos->dataInicio}}
                                     @endif
                                     <br> Data Prevista Fim:
                                     @if ($projetos->dataPrevistaFim==null)
                                     ---- -- --
                                     @else
                                     {{$projetos->dataPrevistaFim}}
                                     @endif
                                    <br>Data Fim: 
                                    @if ($projetos->dataFim==null)
                                    ---- -- --
                                    @else
                                    {{$projetos->dataFim}}
                                    @endif
                                </td>


                                <td class="text-justify">{{DB::table('estadoprojetos')->where('pk_estadoprojeto',$projetos->fk_estadoproj)->value('descricaoEstado')}}</td>

                           
                         

                            <td>  {{--opçoes de gestão de taskss--}}
                                <div class="text-center">
                                  
                                    {{-- {!! Form::open(array('route' => 'tarefa.veretapa','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                      <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                        <button type="submit" class="btn btn-success fas fa-eye" text="Ver Projeto"> 
                                       </button>
                                    </a> 
                                        {!! Form::close()!!} 
                                
                                          
                                              <a href="/verprojeto/{{$tasks->fk_projeto}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->fk_projeto}}>
                                                <button type="submit" class="btn btn-info fas fa-hard-hat" text="Ver Projeto"> 
                                               </button>
                                            </a>  --}}
                                              
<br>
                                                {!! Form::open(array('route' => 'etapa.criar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$projetos->pk_projeto}}>
                                                    <button type="submit" class="btn btn-info fas fa-hourglass-start " text="Abrir Etapa" title="Abrir Etapa"> 
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
                                        <a href="{{url('/')}}/novoprojeto" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Projeto</button></a>
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




