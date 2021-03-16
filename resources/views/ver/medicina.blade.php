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
          }});;
    });
</script>
<div class="box   box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR MEDICINA NO TRABALHO - COLABORADOR</h1>
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

                                <th class="text-center">Data do Exame</th>
                                <th class="text-center">Tipo de Exame</th>
                               
                                <th class="text-center">Resultado</th>
 
                                <th class="text-center">Próximo Exame</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($medicina as $medicina)
                     
                            <tr id="tr" >
                     
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$medicina->dataExame}}</td>
                            <td class="text-justify">{{$medicina->tipoExame}}</td>
                            <td class="text-justify">{{$medicina->resultado}}</td>
                            <td class="text-justify">{{$medicina->proxExame}}</td>
                         
                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
                 
            </div>
        </div>
    </div> 
@endsection




