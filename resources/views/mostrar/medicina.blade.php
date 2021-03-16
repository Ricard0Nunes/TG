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
<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR MEDICINA NO TRABALHO</h1>
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

                                <th class="text-center">Empresa</th>
                                <th class="text-center">Colaborador</th>
                                <th class="text-center">Data da Consulta</th>
                                <th class="text-center">Tipo de Exame</th>
                                <th class="text-center">Data de Nascimento</th>
                                <th class="text-center">Idade</th>
                                <th class="text-center">Próxima Consulta</th>
                                <th class="text-center">Resultado</th>
                                {{-- <th class="text-center">Histórico</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($medicina as $medicina)
                        <div class="hidden">
                           
                        </div>
                        
                            <tr id="tr" >
                     
                            {{-- dados da tabela --}}
                            <td class="text-center">{{ DB::connection('geraltg')->table('empresascomuns')->where('NIF', DB::table('users')->where('bi',$medicina->bi)->value('nifEmpregador'))->value('nomeCompleto')}}</td>
                            <td class="text-center">{{DB::table('users')->where('bi',$medicina->bi)->value('name')}}</td>
                            <td class="text-center">{{$medicina->dataExame}}</td>
                            <td class="text-center">{{$medicina->tipoExame}}</td>
                            <td class="text-center">{{DB::table('users')->where('bi',$medicina->bi)->value('dtnsc')}}</td>
                            <td class="text-center">{{Carbon\Carbon::now()->diffInYears(Carbon\Carbon::parse(DB::table('users')->where('bi',$medicina->bi)->value('dtnsc')))}}</td>
                            <td class="text-center">{{$medicina->proxExame}}</td>

                            <td class="text-center">
                                @if($medicina->resultado == 'Apto')
                                <span class="label label-success">{{$medicina->resultado}}</span>
                                @elseif($medicina->resultado == 'Apto Condicionalmente')
                                <span class="label label-primary">{{$medicina->resultado}}</span>
                                @elseif($medicina->resultado == 'Inapto Temporariamente')
                                <span class="label label-warning">{{$medicina->resultado}}</span>
                                @elseif($medicina->resultado == 'Inapto Definitivamente')
                                <span class="label label-danger">{{$medicina->resultado}}</span>
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
                            <a href="{{url('/')}}/criarmedicina" ><button type="button" class="btn btn-block btn-success btn-flat">
                                            Criar Consulta</button></a>
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




