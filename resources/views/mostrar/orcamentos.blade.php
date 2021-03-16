@extends('adminlte::page')

@section('Medicina no Tabalho', 'AdminLTE')




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
<div class="box  box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR ORÇAMENTOS</h1>
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

                                <th class="text-center">#Proposta </th>
                                <th class="text-center">Cliente/Potêncial</th>
                                <th class="text-center">Datas</th>
                                <th class="text-center">Area</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Valor proposta(s/Iva)</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Gerir</th>
                                {{-- <th class="text-center">Histórico</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($orcamento as $orcamento)
                        <div class="hidden">
                           
                        </div>
                        
                            <tr id="tr" >
                     
                            {{-- dados da tabela --}}
                            <td class="text-center">@if ($orcamento->numeroOrcamento==null)
                                *****{{$orcamento->contador}}
                            @else
                            {{$orcamento->numeroOrcamento}}
                            @endif</td>
                            <td class="text-center">@if ($orcamento->fk_cliente!=null)
                               (C) {{DB::table('clientes')->where('pk_cliente',$orcamento->fk_cliente)->value('nomeAbreviado')}}
                            @else
                            (P) {{DB::table('potencialclientes')->where('pk_potencialCliente',$orcamento->fk_potCliente)->value('nomeAbreviado')}}
                            @endif</td>
                            <td class="text-left">Data Proposta: <strong>{{$orcamento->dataProposta}}</strong>  <br>
                                                    Data Envio Proposta:<strong>  {{$orcamento->dataEnvioProposta}} </strong><br>

                                                    Data Validade:<strong>  {{$orcamento->dataValidade}}</strong> <br>
                                                    Data Adjudicação:<strong> {{$orcamento->dataAdjudicacao}} </strong></td>
                            <td class="text-center">{{App\orc_Tipo::where('pk_orcTipo',$orcamento->fk_tipo)->value('tipoOrcamento')}}  </td>
                            <td class="text-center"> @if ($orcamento->fk_estado==1)
                                 <span class="label label-primary">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}</span>

                                @elseif ($orcamento->fk_estado==2)
                                 <span class="label label-warning">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}</span>
                                @elseif ($orcamento->fk_estado==3)
                                 <span class="label label-success">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}</span>
                                @else
                                 <span class="label label-danger">{{DB::table('orc_estado')->where('pk_orcEstado',$orcamento->fk_estado)->value('estado')}}</span>

                                @endif</td>
                            <td class="text-center">{{number_format($orcamento->valorSemIva,2 ,'.', '')}}€</td>
                            <td class="text-center">{{ DB::table('users')->where('id',$orcamento->fk_responsavel)->value('name')}}<img src={{asset( DB::table('users')->where('id',$orcamento->fk_responsavel)->value('foto'))}} class="img-circle img-sm" alt="User Image"></td>
                            <td class="text-center">  
                               
                                {!! Form::open(array('route' => 'orcamento.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$orcamento->pk_orcamento}}>
                                    <button type="submit" class="btn btn-success btn-sm far fa-eye" text="Ver Proposta"> 
                                   </button>
                                </a> 
                                    {!! Form::close()!!} 



                                @if ( $orcamento->fk_responsavel==auth::id() and $orcamento->fk_estado==1)
                                {!! Form::open(array('route' => 'orcamento.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}

                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$orcamento->pk_orcamento}}>
                                  <button type="submit" class="btn btn-warning btn-sm far fa-edit" text="Ver Proposta"> 
                                 </button>
                              </a> 
                                  {!! Form::close()!!} 

                                @endif
                            </td>
                            {{-- <td class="text-justify">Botão de ver Histórico</td> --}}
                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <div class="row" align="center">
                        <div class="col-xs-12 col-sm-12 col-md-4" >
                
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/novoorcamento" ><button type="button" class="btn btn-block btn-success btn-flat">
                                            Novo Orçamento</button></a>
                                </div>

                                    <div class="col-xs-12 col-sm-12 col-md-2" >
                                            <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                    Voltar</button></a>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4" >
                
                            </div>
                </div><br><br>
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                 
            </div>
        </div>
    </div> 
@endsection




