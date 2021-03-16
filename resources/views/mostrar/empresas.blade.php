@extends('adminlte::page')

@section('empresas', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR EMPRESAS</h1>
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
                                <th class="text-center">Nome Empresa</th>
                                <th class="text-center">Nome Abreviado</th>
                                <th class="text-center">Morada</th>
                                <th class="text-center">Contacto</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">NIF</th>
                                <th class="text-center">Horário</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($empresas as $empresa)
                        @if ($empresa->visivel == 1)
                            {{--row a verde--}}
                            <tr id="tr"  class="{{$teste = 'success'}}">
                        @else
                            {{--row a vermelho--}}
                            <tr id="tr"  class="{{$teste = 'danger'}}">
                        @endif
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$empresa->pk_empresa}}</td>
                            <td class="text-justify">{{$empresa->nomeCompleto}}</td>
                            <td class="text-justify">{{$empresa->nomeAbreviado}}</td>
                            <td class="text-justify">{{$empresa->morada}}</td>
                            <td class="text-justify">{{$empresa->contacto}}</td>
                            <td class="text-justify">{{$empresa->email}}</td>
                            <td class="text-justify">{{$empresa->NIF}}</td>
                            <td class="text-justify">Abertura: {{$empresa->horarioAbertura}} <br>Fecho: {{$empresa->horarioFecho}} </td>
                            @if ($empresa->visivel==1)
                            <td class="text-justify">Atividade Aberta</td>
                            @else
                            <td class="text-justify">Atividade Fechada</td>
                            @endif
                           
                            <td>  {{--opçoes de gestão de empresas--}}
                                <div class="text-center"><a href="verempresa/{{$empresa->pk_empresa}}" class="btn btn-success btn-sm far fa-eye" title="empresa Visível"></a>
                                
                                    <a href="editarempresa/{{$empresa->pk_empresa}}" class="btn btn-warning btn-sm far fa-edit" title="Editar empresas"></a> {{--Editar recurso--}}
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
                                        <a href="{{url('/')}}/novaempresa" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Empresa</button></a>
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




