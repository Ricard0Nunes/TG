@extends('adminlte::page')
@section('Equipamento', 'AdminLTE')
@section('content')
<style>
    #tabs.active{
        border-top:3px solid #00a65a !important;
    } 
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">VER EQUIPAMENTO - {{$equipamento[0]->codigo}}</h3>  
    </div>
    <script>
       $(document).ready(function() {
        $('#example').dataTable(  );
    } );
    $(document).ready(function() {
        $('#example2').dataTable(  );
    } );
  
    </script>
    
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                {{-- <img src="{{asset($equipamento->foto)}}" alt="" srcset=""> --}}
                <img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/eb51c2c13a771900639634451ef25d5a/1/5/1558439199_img_1186556.jpg" width="100px"alt="" srcset="">
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Marca </strong> </h4> {{$equipamento[0]->marca}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Modelo</strong> </h4> {{$equipamento[0]->modelo}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Data de Aquisição </strong> </h4> {{$equipamento[0]->dataAquisicao}}
            </div>
        </div>
        <div class="row">
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Fatura </strong> </h4> {{$equipamento[0]->fatura}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Status</strong> </h4> {{$equipamento[0]->status}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>SI </strong> </h4> {{$equipamento[0]->si}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Nº de Série</strong> </h4> {{$equipamento[0]->numeroSerie}}
            </div>
        </div>
        <br>
        <div class="row">
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Fornecedor</strong> </h4> {{$equipamento[0]->fornecedor}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Defeito </strong> </h4> {{$equipamento[0]->defeito}}
            </div>
            <div  class="col-md-3 col-xs-12"> 
                <h4><strong>Nif da Empresa</strong> </h4> {{$equipamento[0]->nifEmpresa}}
            </div>
        </div>
        <br>
    </div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li id="tabs" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Manutenção</a></li>
    
        
                         
                                   
        <li id="tabs" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Requisições</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Data de Início</th>
                                <th class="text-center">Data de Fim</th>
                                <th class="text-center">Descrição do Problema</th>
                                <th class="text-center">Próxima Verificação</th>
                                <th class="text-center">Técnico</th>
                                <th class="text-center">Concluido</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($manutencao as $m)
                
                        <td class="text-justify">{{$m->dataInicio}}</td>
                        <td class="text-justify">{{$m->dataFim}}</td>
                       
                        <td class="text-justify">{{$m->descricaoProblema}}</td>
                        <td class="text-justify">{{$m->proximaVerificacao}}</td>
                        <td class="text-justify">{{$m->tecnico}}</td>
                       
                        <td class="text-justify">
                            @if( $m->concluido ==1)
                            Concluído
                            @else 
                            Por Concluir
                            @endif
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
                                    {{-- {!! Form::open(array('route' => 'manutencaoeq.criar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                <a href="" > --}}
                                    {{-- <button type="button" value="{{$equipamento[0]->pk_equipamento}}"class="btn btn-block btn-success btn-flat">
                                                Criar Manutenção</button></a>
                                                {!! Form::close()!!} 
                                     --}}

                                    {!! Form::open(array('route' => 'manutencaoeq.criar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" > <input id="invisible_id" name="id" type="hidden" value="{{$equipamento[0]->pk_equipamento}}" >
                        <button type="submit" class="btn btn-success " text="Ver Inscritos" title="Avaliar"> Criar Manutenção
                        </button>
                        </a> 
                        {!! Form::close()!!} 
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
        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-12">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Colaborador</th>
                                <th class="text-center">Data de Início</th>
                                <th class="text-center">Data de Fim</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($requisicaoequipamento as $r)
           
                        <td class="text-justify">{{$r->nome}}</td>
                        <td class="text-justify">{{$r->dataInicio}}</td>
                        <td class="text-justify">{{$r->dataFim}}</td>
    
                           
                            
                       
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                    {!! Form::open(array('route' => 'requisicaoequipamento.criar','method'=>'GET','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                    <a href="" > <input id="invisible_id" name="id" type="hidden" value="" >
                                    <button type="submit" class="btn btn-success " text="Criar Requisição" title="Criar Requisição">  Criar Requisição
                                    </button>
                                    </a> 
                                    {!! Form::close()!!} 
                                   
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
@stop
