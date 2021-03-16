@extends('adminlte::page')

@section('Clientes', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR REGISTOS</h1>
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

                                    <th class="text-center">Gerir</th>                  
                                                  <th class="text-center">Data Pedido</th>
                                <th class="text-center">Dia</th>
                                <th class="text-center">Pedido Por</th>
                                 <th class="text-center">Empresa</th>
                                <th class="text-center">Ponto Antigo</th>
                                <th class="text-center">Ponto Novo</th>
                                <th class="text-center">Justificação</th>
                                <th class="text-center">Observações</th>
                             
                                <th class="text-center">Estado</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($registos as $registos)
                        @if ($registos->estado == 1)

                       
                            {{--row a verde--}}
                            <tr id="tr"  class="{{$teste = 'success'}}">
                        @elseif($registos->estado == 2)
                            {{--row a vermelho--}}
                            <tr id="tr"  class="{{$teste = 'danger'}}">
                                @else
                                <tr id="tr"  class="{{$teste = 'info'}}">
                        @endif
                            {{-- dados da tabela --}}
                            @if ($registos->estado>0)
                            <td class="text-center">  Aprovado Por : {{$registos->aprovadoPor}}
                                    </td>
                            @else
                            <td class="text-center"> 
                                    {!! Form::open(array('route' => 'ponto.aprovar','method'=>'POST','files'=>'true')) !!}
                                     {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                    <a href="" > <input id="aaa" name="aprovar" type="hidden" value={{$registos->pk_pedidoAlteracaoPonto}}>
                                      <button type="submit" class="btn btn-success fas fa-thumbs-up" title="Aprovar Ponto">
                                          </button></a> 
                                      {!! Form::close()!!}
                                      {!! Form::open(array('route' => 'ponto.reprovar','method'=>'POST','files'=>'true')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="reprovar" type="hidden" value={{$registos->pk_pedidoAlteracaoPonto}}>
                                        <button type="submit" class="btn btn-danger fas fa-thumbs-down" title="Reprovar Ponto">
                                            </button></a> 
                                        {!! Form::close()!!}
                                    </td>
                            @endif

                            <td class="text-center">{{$registos->created_at}}</td>
                            <td class="text-center">{{$registos->dia}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('userscomuns')->where('bi',$registos->ccuser)->value('nome')}}</td>
                            <td class="text-center">{{DB::connection('geraltg')->table('empresascomuns')->where('nif',$registos->nifempresa)->value('nomeAbreviado')}}</td>
                            <td class="text-center">
                                @if ($registos->entradaManha!=null)
                                    <strong class="pull-left"> EM: {{$registos->entradaManha}} </strong>
                                @else
                                <strong class="pull-left"> EM:--:--:-- </strong>
                                @endif
                                @if ($registos->saidaManha!=null)
                                    <strong class="pull-left"> SM: {{$registos->saidaManha}} </strong>
                                @else
                                <strong class="pull-right"> SM: --:--:-- </strong>
                                @endif <br>
                                @if ($registos->entradaTarde!=null)
                                <strong class="pull-left"> ET: {{$registos->entradaTarde}}</strong>
                                @else
                                <strong class="pull-left"> ET: --:--:-- </strong>
                                @endif 
                                @if ($registos->saidaTarde!=null)
                                <strong class="pull-right"> ST: {{$registos->saidaTarde}} </strong>
                                @else
                                <strong  class="pull-right"> ST: --:--:-- <strong>
                                @endif
                                
                        </td>

                        <td class="text-center">
                                @if ($registos->entradaManhaNova!=null)
                                <strong class="pull-left"> EM: {{$registos->entradaManhaNova}} </strong>
                            @else
                            <strong class="pull-left"> EM:--:--:-- </strong>
                            @endif
                            @if ($registos->saidaManhaNova!=null)
                                <strong class="pull-right"> SM: {{$registos->saidaManhaNova}} </strong>
                            @else
                            <strong class="pull-right"> SM: --:--:-- </strong>
                            @endif <br>
                            @if ($registos->entradaTardeNova!=null)
                            <strong class="pull-left"> ET: {{$registos->entradaTardeNova}}</strong>
                            @else
                            <strong class="pull-left"> ET: --:--:-- </strong>
                            @endif 
                            @if ($registos->saidaTardeNova!=null)
                            <strong class="pull-right"> ST: {{$registos->saidaTardeNova}} </strong>
                            @else
                            <strong  class="pull-right"> ST: --:--:-- <strong>
                            @endif
                                
                        </td>

            
                       
                    <td class="text-center"> @if ($registos->fk_justificacao>1)
                            {{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$registos->fk_justificacao)->value('descricao')}}
                    @else
                        Sem Justificação Apresentada
                    @endif
                       </td>
                        <td>{{$registos->comentario}}</td>
                            @if ($registos->estado==1)
                           <td class="text-center"><span class="label label-success">Aprovado</span></td> 
                            @elseif($registos->estado==0)
                        <td class=text-center><span class="label label-warning">Pendente</span></td> 
                               @elseif($registos->estado==2)
                        <td class=text-center><span class="label label-danger">Reprovado</span></td> 
                            @endif
                  

                           
                           
                        
                            {{-- </td> --}}
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                {{-- </div>
                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                        <a href="{{url('/')}}/novocliente" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Cliente</button></a>
                                    </div>

                                        <div class="col-xs-12 col-sm-12 col-md-2" >
                                                <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
                                                        Voltar</button></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4" >
                     --}}
                                </div>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




