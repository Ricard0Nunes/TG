@extends('adminlte::page')

@section('Etapas', 'Etapas')




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
                <h1 class="box-title" >MOSTRAR ETAPAS</h1>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->

        <div class="box-body">
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            @if (session('Success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                              <strong> {{ session('Success') }}</strong>
                            </div>
                            @endif  
                            @if (session('Danger'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                              <strong> {{ session('Danger') }}</strong>
                            </div>
                            @endif 
                            @if (session('Warning'))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                              <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                              <audio id="myAudio"  onload="playAudio()"src="{{url('/erro.wav')}}" autoplay ></audio>
                              <strong> {{ session('Warning') }}  {!! Form::open(array('route' => 'etapa.pararconfirma','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                {{ Form::hidden('confirma', 'sim', array('id' => 'start')) }}
                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{session('id')}}>
                                    <button type="submit" class="btn btn " text="Ver Projeto"> Sim
                                   </button>
                                </a> </strong>
                              

                            </div>
                            @endif  
                        </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">Etapa</th>
                                <th class="text-center">Projeto</th>
                                <th class="text-center">Responsável</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Estado</th>

                                
                                <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tasks as $tasks)
                        <tr id="tr">
                                <td class="text-justify">{{$tasks->text}}</td>

                            <td class="text-center" >{{' '.DB::table('projetos')->where('pk_projeto',$tasks->fk_projeto)->value('codProj')}}                 </td>

                            <td class="text-justify">{{DB::table('users')->where('id',$tasks->fk_tecnico)->value('sigla')}}</td>
                            <td class="text-justify">{{DB::table('clientes')->where('pk_cliente',DB::table('projetos')->where('pk_projeto',$tasks->fk_projeto)->value('fk_cliente'))->value('nomeAbreviado')}}</td>

                            @if ($tasks->fechado == 0)
                            <td class="text-center"> <span class="label label-success">Aberta</span>
                            </td>

                        @else
                         
                        <td class="text-center"> <span class="label label-danger">Fechada</span>

                             
                        @endif

                           
                         

                            <td>  {{--opçoes de gestão de taskss--}}
                                <div class="text-center">
                                  @if ($tasks->fechado==0)
                                  {!! Form::open(array('route' => 'etapa.pararetapa','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                  {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                    <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                      <button type="submit" class="btn btn-danger fas fa-stop" text="Ver Projeto"  title="Apagar Etapa"> 
                                     </button>
                                  </a> 
                                      {!! Form::close()!!} 
                                      
                                  @endif


                                    {!! Form::open(array('route' => 'tarefa.veretapa','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                    {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                      <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                        <button type="submit" class="btn btn-success fas fa-eye" text="Ver Projeto"  title="Ver Etapa"> 
                                       </button>
                                    </a> 
                                        {!! Form::close()!!} 
                                
                                
                                          
                                              <a href="/verprojeto/{{$tasks->fk_projeto}}" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->fk_projeto}}>
                                                <button type="submit" class="btn btn-info fas fa-hard-hat" text="Ver Projeto"  title="Projeto"> 
                                               </button>
                                            </a> 
                                              

                                                {!! Form::open(array('route' => 'tarefa.editar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                                {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                                                  <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$tasks->id}}>
                                                    <button type="submit" class="btn btn-warning fas fa-pencil-alt" text="Ver Projeto"  title="Editar Etapa"> 
                                                   </button>
                                                </a> 
                                                    {!! Form::close()!!} 
                                    
                                 

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
                                        <a href="{{url('/')}}/novaetapa" ><button type="button" class="btn btn-block btn-success btn-flat">
                                                Criar Intervenção</button></a>
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




