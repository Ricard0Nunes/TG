@extends('adminlte::page')

@section('Areas', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR ÁREAS</h1>
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
                                <th class="text-center">Data Criação</th>
                              
                              
                             
                                <th class="text-center">Estado</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($a as $Area)
                
                        @if ($Area->visivel == 1)
                            {{--row a verde--}}
                            <tr id="tr"  class="{{$teste = 'success'}}">
                        @else
                            {{--row a vermelho--}}
                            <tr id="tr"  class="{{$teste = 'danger'}}">
                        @endif
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$Area->pk_area}}</td>
                            <td class="text-center">{{$Area->projArea}}</td>
                            <td class="text-center">{{$Area->created_at}}</td> 
                            @if ($Area->visivel==1)
                            <td class="text-center"> Ativo</td>
                            @else
                            <td class="text-center"> Inativa</td>
                            @endif
                           
                            <td>  {{--opçoes de gestão de clientes--}}
                                    <div class="text-center">
                                    <a href="editarea/{{$Area->pk_area}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Área"></a> {{--Editar recurso--}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{-- <a href="novaarea" class="btn btn-success btn-sm far fa-edit" title="criar Area">Criar Area</a> Editar recurso --}}

                </div>
            </div>
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/novaarea" ><button type="button" class="btn btn-block btn-success btn-flat">
                                    Criar Área</button></a>
                        </div>

                            <div class="col-xs-12 col-sm-12 col-md-2" >
                                    <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                            Voltar</button></a>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
        </div><br><br>
    </div> 
@endsection




