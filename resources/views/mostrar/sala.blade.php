@extends('adminlte::page')

@section('Sala', 'AdminLTE')




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
<style>
td:hover{
    background-color: #e2e2e2;
}


</style>
<div class="box  box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" > MOSTRAR SALA </h1>
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

                                <th class="text-center">Nome</th>
                                <th class="text-center">Localização</th>
                                <th class="text-center">Lotação</th>
                                <th class="text-center">Custo</th> 
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sala as $sala)
                  
                            {{-- dados da tabela --}}
                            
                            <td class="text-center">{{$sala->nome}}</td>
                            <td class="text-center">{{$sala->local}}</td>
                            <td class="text-center">{{$sala->lotacao}} pessoas</td> 
                            <td class="text-center">{{$sala->custo}}€</td> 
                            <td class="text-center">   
                              <a href="editarsala/{{$sala->pk_sala}}" class="fas fa-pencil-alt btn btn-warning" title="Editar Sala"></a>  
                              {!! Form::open(array('route' => 'sala.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                              <a href="" > <input id="aaa" name="id" type="hidden" value={{$sala->pk_sala}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Apagar Sala"> 
                              </button></a>                  
                              {!! Form::close()!!}
                               </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
                

            </div>
      
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/novasala" ><button type="button" class="btn btn-block btn-success btn-flat">
                                    Criar Sala</button></a>
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




