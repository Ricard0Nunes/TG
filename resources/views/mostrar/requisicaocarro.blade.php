@extends('adminlte::page')

@section('Requisição', 'AdminLTE')




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

<div class="box box-success">
        <div class="box-header with-border" >
                <h1 class="box-title" >MOSTRAR REQUISIÇÕES</h1>
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

                                <th class="text-center">Validar</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Requisitante</th>
                                <th class="text-center">Veiculo</th>
                                <th class="text-center">Rota</th>
                                <th class="text-center">Ocupantes</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @for ($i = 0; $i < count($requisicao); $i++)
                            
                        
                         {{-- ($requisicao as $requisicao) --}}
                      
                            {{-- dados da tabela --}}
                            @if ($requisicao[$i]->validado==0)
                            @if (DB::table('users')->where('id',auth::id())->value('fk_departamento')==2)
                            <td class="text-justify">  {!! Form::open(array('route' => 'requisicaocarro.aprovar','method'=>'POST','files'=>'true')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                            <a href="" > <input id="aaa" name="aprovar" type="hidden" value={{$requisicao[$i]->pk_requisicao}}>
                                <button type="submit" class="btn btn-success fas fa-thumbs-up"  title="Aprovar Requisição">
                                    </button></a> 
                                {!! Form::close()!!}
                                {!! Form::open(array('route' => 'requisicaocarro.reprovar','method'=>'POST','files'=>'true')) !!}
                                {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                <a href="" > <input id="aaa" name="reprovar" type="hidden" value={{$requisicao[$i]->pk_requisicao}}>
                                <button type="submit" class="btn btn-danger fas fa-thumbs-down" title="Reprovar Requisição">
                                    </button></a> 
                                {!! Form::close()!!}
                                    </td>
                            @else
                            <td class="text-center"> <br> <span class="badge bg-yellow">Aguarda Aprovação</span>
                            </td>
                            @endif
                           
                            @elseif($requisicao[$i]->validado==2)
                            <td class="text-justify"> Aprovado por: <br>{{$requisicao[$i]->aprovadoPor}}
                            </td>
                            @else
                            <td class="text-justify"> Aprovado por: <br>
                                {{$requisicao[$i]->aprovadoPor}}
                                   
                                    </td>
                            @endif
                            <td class="text-justify">Data: {{$requisicao[$i]->dataPartida}} <br>Partida Prev.:
                                {{$requisicao[$i]->partidaPrevista}}h <br> Chegada Prev.:{{$requisicao[$i]->chegadaPrevista}}h
                            
                            </td>
                            <td class="text-center"><br>{{DB::table('users')->where('bi',$requisicao[$i]->requisitadoPor)->value('name')}}
                                <td class="text-center"><br>
                              
                                    Veículo: {{DB::connection('geraltg')->table('veiculos')->where('pk_veiculo',$requisicao[$i]->fk_veiculo)->value('descricao')}}
      
      
                                     </td>
                            <td class="text-center"> <br>{{$requisicao[$i]->rota}}   </td> 
        
                            <td class="text-justify">
                             {{-- {{   $contents = utf8_encode($requisicao[$i]->ocupantes)}} --}}
                             <div class="hidden">
                                {{-- {{$results =  (utf8_decode($requisicao[$i]->ocupantes))}} --}}
                             </div>
                             @foreach (explode( ',',
                            $requisicao[$i]->ocupantes) as $string)
                
                             -  {{DB::connection('geraltg')->table('userscomuns')->where('BI',$string)->value('nome')}} <br>

                             @endforeach
                              
                                </td>
                            <td class="text-center"> <br>
                                @if ($requisicao[$i]->validado==0)
                                <span class="badge bg-yellow">Pendente</span>
                                @elseif($requisicao[$i]->validado==1)
                                <span class="badge bg-green">Aprovado</span>
                                @elseif($requisicao[$i]->validado==2)
                                <span class="badge bg-red">Reprovado</span>
                                @else 
                                <span class="badge bg-blue">Terminado</span>
                                @endif
                                </td>
                          
                        
                                <td class="text-center"> <br>
                                    @if ($requisicao[$i]->requisitadoPor==DB::table('users')->where('id',auth::id())->value('BI'))
                                 
                                    {!! Form::open(array('route' => 'requisicaocarro.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$requisicao[$i]->pk_requisicao}}">
                                            <button type="submit" class="btn btn-success btn-sm far fa-eye pull-right"  title="Ver Requisição">
                                           </button></a> 
                                           <div class="pull-right">
                                              <span style=" display: inline;">
                                          
                             
                                          
                                              {!! Form::close()!!}

                                              {!! Form::open(array('route' => 'requisicaocarro.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                              <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$requisicao[$i]->pk_requisicao}}">
                                                      <button type="submit" class="btn btn-warning btn-sm far fa-edit pull-right" title="Editar Requisição">
                                                     </button></a> 
                                                     <div class="pull-right">
                                                        <span style=" display: inline;">
                                                        {!! Form::close()!!}
                                                        
                                                {!! Form::open(array('route' => 'requisicaocarro.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$requisicao[$i]->pk_requisicao}}">
                                                    <button type="submit" class="btn btn-danger btn-sm fas fa-trash-alt pull-right" title="Apagar Requisição">    
                                                 
                                                        </button></a> 
                                                        <div class="pull-right">
                                                            <span style=" display: inline;">
                                                        
                                            
                                                        
                                               {!! Form::close()!!}
          

                                    @else 
                                    {!! Form::open(array('route' => 'requisicaocarro.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$requisicao[$i]->pk_requisicao}}">
                                            <button type="submit" class="btn btn-success btn-sm far fa-eye pull-right"  title="Ver Requisição">
                                           </button></a> 
                                           <div class="pull-right">
                                              <span style=" display: inline;">
                                          
                             
                                          
                                              {!! Form::close()!!}
                                @endif

                                </td>
                           
                        </tr>
                    @endfor
                    </tbody>
                    </table>

                </div>
               
                {{-- <a href="novorequisicao" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar requisicao</a> Editar recurso --}}

            </div>
      
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-4" >
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2" >
                            <a href="{{url('/')}}/requisitarcarro" ><button type="button" class="btn btn-block btn-success btn-flat">
                                   Requisitar Veículo</button></a>
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




