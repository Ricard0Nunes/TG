@extends('adminlte::page')

@section('Processamento', 'AdminLTE')




@section('content')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>


<script>
    $(document).ready(function() {
    $('#example').DataTable( {"language": {
              "url": "js/localeDataTable.js"
          }});;
    });
</script>
<div class="box box-success">
              <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR PROCESSAMENTO</h1>
          <div class="box-tools pull-right">
              <div style="display: flex">
                <input id="invisible_id"  name="id" type="hidden">
                <div class="col-sm-10">
                {!! Form::open(array('route' => 'registo.processarmensal','method'=>'POST','files'=>'true','style'=>'display:inline-block','target'=>'_blank')) !!}
                        
                {!! Form::label('mes','Gerar folha resumo mês *') !!}
                
            </div>
                </div>
                <div class="col-sm-10">
             
                    {!! Form::select('mes', $mes ,null,array('class' => 'form-control', 'id'=>'mes', 'placeholder' => 'Escolha o mês para gerar','required'=>'required' )) !!}
                    {!! $errors->first('users','<p class="alert alert-danger">:message</p>')!!}

                </div>
          
                <button type="submit" class="btn btn-success fas fa-search ">
                </button>
                 </div>
                 {!! Form::close()!!}
          </div>



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

                                <th class="text-center">Intervalo</th>
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Nome</th>
                                <th class="text-center">Mês</th>
                                <th class="text-center">Dias Trabalhados</th>
                                <th class="text-center">Dias Utéis</th>
                                <th class="text-center">Férias</th>
                                <th class="text-center">Alimentação</th>
                                <th class="text-center">Faltas Injustificadas</th>
                                <th class="text-center">Faltas C/ Retribuição</th>
                                <th class="text-center">Faltas S/ Retribuição</th>
                                <th class="text-center">Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($processar as $processar)
                     
                            <tr id="tr">
                  
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$processar->intervaloProcessamento}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$processar->nifEmpresa)->value('nomeAbreviado')}}</td>
                            <td class="text-center">{{$processar->nome}}</td>
                            <td class="text-center">{{$processar->mes}}</td>
                            <td class="text-center">{{$processar->diasTrabalhados}}</td>
                            <td class="text-center">{{$processar->diasUteis}}</td>
                            <td class="text-center">{{$processar->ferias}}</td>
                            <td class="text-center">{{$processar->diasSubsidioAlimentacao}}</td>
                            <td class="text-center">{{$processar->diasFaltasInjustificadas}}</td>
                            <td class="text-center">{{$processar->diasFaltasComRetribuicao}}</td>
                            <td class="text-center">{{$processar->diasFaltasSemRetribuicao}}</td>
                            <td>  {{--opçoes de gestão de clientes--}}
                                <div class="text-center">

                                        {!! Form::open(array('route' => 'processamento.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block','target'=>'_blank')) !!}
                                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                          <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$processar->pk_processamento}}>
                                                                                  
                                            <button type="submit" class="btn btn-info fas fa-file-powerpoint" text="Ver Processamento" title="Gerar Folha do Mês"> 
                                           </button>
                                        </a> 
                                            {!! Form::close()!!} 

                                             
                               
                                </div>
                            </div>
                        </td>
                           
                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                
                    <br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




