@extends('adminlte::page')

@section('Noticias', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR NOTÍCIAS</h1>
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
                                <th class="text-center">Mensagem</th>
                               
                                <th class="text-center">De</th>
                                <th class="text-center">A</th>
                                <th class="text-center">Notifica</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($noticia as $noticia)
                     
                            <tr id="tr" >
                     
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$noticia->pk_alerta}}</td>
                            <td class="text-justify">{{$noticia->mensagem}}</td>
                            <td class="text-justify">{{$noticia->de}}</td>
                            <td class="text-justify">{{$noticia->a}}</td>
                            @if ($noticia->todos==1)
                            <td class="text-justify">Todos</td>
                            @else
                            <td class="text-justify">Listagem de Users</td>  
                            @endif
                            
                           
                           
                            <td>  {{--opçoes de gestão de clientes--}}
                                    <div class="text-center">

                                            {!! Form::open(array('route' => 'noticia.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                              <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$noticia->pk_alerta}}>
                                                <button type="submit" class="btn btn-warning fas fa-pencil-alt" text="Ver Projeto"> 
                                               </button>
                                            </a> 
                                                {!! Form::close()!!} 

                                                 
                                   {!! Form::open(array('route' => 'noticia.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$noticia->pk_alerta}}><button type="submit" class="fas fa-trash-alt btn btn-danger">
                                       </button></a> 
                                   {!! Form::close()!!}
                                    </div>
                                </div>
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
                                <a href="{{url('/')}}/criarnoticia" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Notícia</button></a>
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




