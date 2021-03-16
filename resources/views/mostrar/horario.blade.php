@extends('adminlte::page')

@section('horarios', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR HORÁRIO</h1>
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
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Hora Entrada</th>
                                <th class="text-center">Hora Saída</th>
                                <th class="text-center">Duração Refeição</th>
                                <th class="text-center">Intervalo de Almoço</th>
                                <th class="text-center">Horas Diárias</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($horario as $horario)
                        @if ($horario->visivel == 1)
                            {{--row a verde--}}
                            <tr id="tr"  class="{{$teste = 'success'}}">
                        @else
                            {{--row a vermelho--}}
                            <tr id="tr"  class="{{$teste = 'danger'}}">
                        @endif

                            <td class="text-center">{{$horario->pk_horario}}</td>
                            <td class="text-center">{{$horario->descricao}}</td>
                            <td class="text-center">{{$horario->horaEntrada}}</td>
                            <td class="text-center">{{$horario->horaSaida}}</td>
                            <td class="text-center">{{$horario->duracaoAlmoco}}</td>
                            <td class="text-center">Refeição das: {{$horario->almocoApartir}} <br> às: {{$horario->almocoAte}} </td>
                            <td class="text-center">{{$horario->horasDiarias}}</td>
                            @if ($horario->visivel==1)
                            <td class="text-center">Horário Ativo</td>
                            @else
                            <td class="text-center">Horário Inativo</td>
                            @endif
                           
                            <td>  {{--opçoes de gestão de clientes--}}
                                    <div class="text-center">
                                    <a href="colaboradoreshorario/{{$horario->pk_horario}}" class="btn btn-info btn-sm fas fa-users" title="Colaboradores">{{count(DB::table('users')->where('visivel',1)->where('fk_horario',$horario->pk_horario)->get())}}</a>

                                    <a href="editarhorario/{{$horario->pk_horario}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Horário"></a> {{--Editar recurso--}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novohorario" class="btn btn-success btn-sm far fa-edit" title="criar horario">Criar horario</a> Editar recurso --}}
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                        <a href="{{url('/')}}/novohorario" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Horário</button></a>
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




