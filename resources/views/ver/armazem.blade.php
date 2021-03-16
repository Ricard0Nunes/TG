@extends('adminlte::page')
@section('Armazém', 'AdminLTE')
@section('content')
<style>
    #tabs.active{
        border-top:3px solid #00a65a !important;
    } 
</style>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Ver Armazém - {{$armazem[0]->codigo}}</h3> ({{$armazem[0]->localizacao}})
    </div>
   
    </div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li id="tabs" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Inventário</a></li>
    
        
                         
                                   
        <li id="tabs" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Transportes Ativos</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Artigo</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center">Data de Última Entrada</th>
                                <th class="text-center">Data de Última Saida</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($armazem as $m)
                
                        <td class="text-justify">{{$m->fk_artigo}} Query</td>
                        <td class="text-justify">{{$m->quantidade}}</td>
                       
                        <td class="text-justify">{{$m->dataUltimaEntrada}}</td>
                        <td class="text-justify">{{$m->dataUltimaSaida}}</td>

    
                           
                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_2">
           
                </div>
        </div>
    </div>  

@stop
