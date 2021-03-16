@extends('adminlte::page')

@section('Projetos', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR PROJETOS</h1>
                <div class="box-tools pull-right">
        
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
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Código Projeto</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Nome Projeto</th>
                                <th class="text-center">Custos Previstos</th>
                                <th class="text-center">Custos Reais</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Departamentos Envolvidos</th>
                                <th class="text-center">Prazos</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($projeto as $projeto)

                        <div class="hidden">
                                {{$pois=DB::table('projdeps')->where('fk_projeto',$projeto->pk_projeto)->get()}}
                        </div>
                       
                        @if ($projeto->fk_estadoproj == 1)
                           
                            <tr id="tr"  class="{{$teste = 'success'}}">
                        @elseif($projeto->fk_estadoproj == 2)
                        
                            <tr id="tr"  class="{{$teste = 'warning'}}">
  
                        @elseif($projeto->fk_estadoproj == 3)
                             <tr id="tr"  class="{{$teste = 'info'}}">
                        @elseif($projeto->fk_estadoproj == 4)
                             <tr id="tr"  class="{{$teste = 'danger'}}">
                           
                        @endif
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{DB::table('departamentos')->where('pk_departamento',$projeto->fk_departamento)->value('abreviatura')}}</td>

                           
                            <td class="text-justify">{{$projeto->codProj}}</td>
                            <td class="text-justify">{{DB::table('estadoprojetos')->where('pk_estadoprojeto',$projeto->fk_estadoproj)->value('descricaoEstado')}}</td>
                            <td class="text-justify">{{DB::table('empresas')->where('pk_empresa',$projeto->fk_empresa)->value('nomeAbreviado')}}</td>
                            <td class="text-justify">{{DB::table('clientes')->where('pk_cliente',$projeto->fk_cliente)->value('nomeAbreviado')}}</td>
                            <td class="text-justify">{{$projeto->nomeProjeto}}</td>
                            <td class="text-justify">{{$projeto->custoPrevisto}}€</td>
                            <td class="text-justify">
                                @if ($projeto->custosReal==null)
                                    -- €
                                @else
                                {{$projeto->custosReal}}€</td>
                                @endif
                            
                            <td class="text-justify">{{DB::table('users')->where('id',$projeto->fk_responsavel)->value('sigla')}}</td>
                            <td class="text-justify">@foreach ($pois as $a)
                                 {{DB::table('departamentos')->where('pk_departamento',$a->fk_departamento)->value('abreviatura')}} <br> 
                            @endforeach</td>

                            <td class="text-justify">Data Prevista Início:
                                    @if ($projeto->dataPrevistaInicio==null)
                                     ---- -- --
                                    @else
                                    {{$projeto->dataPrevistaInicio}} 
                                    @endif
                                     <br>Data Início: 
                                     @if ($projeto->dataInicio==null)
                                         ---- -- --
                                     @else
                                     {{$projeto->dataInicio}}
                                     @endif
                                     <br> Data Prevista Fim:
                                     @if ($projeto->dataPrevistaFim==null)
                                     ---- -- --
                                     @else
                                     {{$projeto->dataPrevistaFim}}
                                     @endif
                                    <br>Data Fim: 
                                    @if ($projeto->dataFim==null)
                                    ---- -- --
                                    @else
                                    {{$projeto->dataFim}}
                                    @endif
                                </td>
                           
                            <td>  {{--opçoes de gestão de clientes--}}
                                <div class="text-center">
                                 @if ($projeto->fk_estadoproj==2)
                                 <a href="startprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm far fa-play-circle" title="Iniciar Projeto"></a>

                                 @elseif($projeto->fk_estadoproj==1 || $projeto->fk_estadoproj==3  )
                                 <a href="stopprojeto/{{$projeto->pk_projeto}}" class="btn btn-danger btn-sm far fa-stop-circle" title="Terminar Projeto"></a>
                                 @elseif($projeto->fk_estadoproj==4)
                                 <a href="restartprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-sm fas fa-redo" title="Reabrir Projeto"></a>

                                 @endif
                                <br>
                                    <a href="verprojeto/{{$projeto->pk_projeto}}" class="btn btn-success btn-sm far fa-eye" title="Ver Projeto"></a>
                                <br>
                                    <a href="editarprojeto/{{$projeto->pk_projeto}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Projeto"></a> {{--Editar recurso--}}
                             
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novoprojeto" class="btn btn-success btn-sm far fa-edit" title="criar projeto">Criar projeto</a> Editar recurso --}}
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




