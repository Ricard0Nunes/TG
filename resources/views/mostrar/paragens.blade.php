@extends('adminlte::page')

@section('Paragens Empresa', 'AdminLTE')




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
<div class=" box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR PARAGENS EMPRESA</h1>
                <div class="box-tools pull-right">
                        <a href="  /processarparagem" ><button type="button" class="btn btn-block btn-info btn-flat">
                                Processar</button></a>
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
              
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
                                     <th class="text-center">Tipo</th>
                                <th class="text-center">Dia</th>
                                <th class="text-center">Descrição</th>
                                <th class="text-center">Ano</th>
                        
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($paragens as $paragens)
                     
                            <tr id="tr">
                  
                            {{-- dados da tabela --}}
                            <td class="text-center">{{$paragens->pk_paragem}}</td>
                            <td class="text-center">{{  $justificacoes = DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$paragens->fk_justificacao)->value('descricao')}}</td>
                            <td class="text-center">{{$paragens->dia}}</td>
                            <td class="text-center">{{$paragens->descricao}}</td>
                            <td class="text-center">{{$paragens->ano}}</td>
                    
                           
                           
                            <td>  {{--opçoes de gestão de clientes--}}
                                    <div class="text-center">

                                            {!! Form::open(array('route' => 'paragem.edit','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                            {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                              <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$paragens->pk_paragem}}>
                                                <button type="submit" class="btn btn-warning fas fa-pencil-alt" text="Ver Projeto" title="Editar Paragem"> 
                                               </button>
                                            </a> 
                                                {!! Form::close()!!} 

                                                 
                                   {!! Form::open(array('route' => 'paragem.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                   {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                                 <a href="" > <input id="aaa" name="id" type="hidden" value={{$paragens->pk_paragem}}><button type="submit" class="fas fa-trash-alt btn btn-danger" title="Apagar Paragem">
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
                                <a href="{{url('/')}}/adicionardiaparagem" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Adicionar Dia</button></a>
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




