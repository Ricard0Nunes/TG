@extends('adminlte::page')
@section('Cargos', 'AdminLTE')
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
   
   $('#myModal').on('shown.bs.modal', function () {
   $('#myInput').focus()
   })
   
</script>
<div class="box   box-success">
   <div class="box-header with-border" >
      <h1 class="box-title" >MOSTRAR FORMAÇÕES</h1>
      <div class="box-tools pull-right">
         <!-- Buttons, labels, and many other things can be placed here! -->
         <!-- Here is a label for example -->
         {{-- <span class="label label-primary">Criar um Cargo</span> --}}
      </div>
      <!-- /.box-tools -->
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            @if (session('danger'))
            <div class="alert alert-danger" role="alert">
               <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
               <strong> {{ session('danger') }}</strong>
            </div>
            @endif 
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
               <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
               <strong> {{ session('success') }}</strong>
            </div>
            @endif 
         </div>
      </div>
      <!-- Modal -->
      <div class="row">
         <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th class="text-center">Nome Formação</th>
                     <th class="text-center">Formador</th>
                     <th class="text-center">Entidade Formação</th>
                     <th class="text-center">Datas</th>
                     <th class="text-center">Duração</th>
                     <th class="text-center">Local</th>
                     <th class="text-center">NºVagas / NºInscritos</th>
                     <th class="text-center">Custo</th>
                     <th class="text-center">Estado</th>
                     {{-- 
                     <th class="text-center">Colaboradores</th>
                     --}}
                     <th class="text-center">Gerir</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($formacao as $formacao)
                  {{-- dados da tabela --}}
                  <td class="text-center">{{$formacao->nome_formacao}}</td>
                  @if ($formacao->fk_formador==null)
                  <td class="text-center">{{$formacao->nome_formador}}</td>
                  @else 
                  <td class="text-center"> {{DB::table('users')->where('id',$formacao->fk_formador)->value('name')}}</td>
                  @endif 
                  <td class="text-center">{{$formacao->entidade_formacao}}</td>
                  <td class="text-center"><strong>Início:</strong> {{$formacao->dataInicio}} <br> <strong> Fim:</strong> {{$formacao->dataFim}} </td>
                  <td class="text-center">{{$formacao->horas_formacao}}</td>
                  <td class="text-center">{{$formacao->local_formacao}}</td>
                  <td class="text-center">{{$formacao->numero_vagas}} / {{count(DB::table('inscricaos')->where('fk_formacao',$formacao->pk_formacao)->get())}}</td>
                  <td class="text-center">{{$formacao->custo_formacao}}</td>

                  @if ($formacao->estado == 0)
                  <td class="text-center"> <span class="label label-success">Aberta</span>
                  </td>
                  @endif
                  @if ($formacao->estado == 1)
                  <td class="text-center"> <span class="label label-warning">Fechada</span>
                     @endif
                     @if ($formacao->estado == 2)
                  <td class="text-center"> <span class="label label-danger">Terminada</span>
                  </td>
                  @endif
                  @if ($formacao->estado == 3)
                  <td class="text-center"> <span class="label label-primary">Arquivada</span>
                  </td>
                  @endif


                  @if($formacao->estado==3)
                   <td> 

                   </td>

                  @elseif($formacao->estado==2 )
                     @if($formacao->avaliacao_user ==null)
                     <td>
                     <div class="text-center">
                        {!! Form::open(array('route' => 'mostrar.avaliacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$formacao->pk_inscricao}} >
                        <button type="submit" class="btn btn-success far fa-edit" text="Ver Inscritos" title="Avaliar"> 
                        </button>
                        </a> 
                        {!! Form::close()!!} 
                     </div>
                  @else
                  <td>

                  </td>
                  @endif
               @endif
                  {{-- @if (Auth::id() == $formacao->fk_formador) --}}
                  {{-- 
                  <td class="text-center">  {!! Form::select('fk_user', $users ,null,array('class' => 'form-control', 'id'=>'user', 'placeholder' => 'Escolha o Colaborador','required'=>'required' )) !!}</td>
                  --}}
                  {{-- @if($formacao->estado==3)
                  </td>
                  </td>
                  @elseif($formacao->estado==2)
                  <td>
                     <div class="text-center">
                        {!! Form::open(array('route' => 'mostrar.avaliacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$formacao->pk_formacao}} >
                        <button type="submit" class="btn btn-success far fa-edit" text="Ver Inscritos" title="Avaliar"> 
                        </button>
                        </a> 
                        {!! Form::close()!!} 
                     </div>
                     <div class="text-center">
                        {!! Form::open(array('route' => 'arquivar.formacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$formacao->pk_formacao}} >
                        <button type="submit" class="btn btn-success fas fa-paperclip" text="Arquivar" title="Arquivar"> 
                        </button>
                        </a> 
                        {!! Form::close()!!} 
                     </div>
                  </td>
                  @else
                  <td>
                  <div class="text-center">
                     {!! Form::open(array('route' => 'mostrar.avaliacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                     {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                     <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$formacao->pk_formacao}} >
                     <button type="submit" class="btn btn-success far fa-edit" text="Ver Inscritos" title="Avaliar"> 
                     </button>
                     </a> 
                     {!! Form::close()!!} 
                  </div>
                  <td>
                  @endif
                  @else
                  <td>
                     <div class="text-center">
                        {!! Form::open(array('route' => 'mostrar.avaliacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                        {{ Form::hidden('invisible', 'secret', array('id' => 'start')) }}
                        <a href="" > <input id="invisible_id" name="id" type="hidden" value={{$formacao->pk_formacao}} >
                        <button type="submit" class="btn btn-success far fa-edit" text="Ver Inscritos" title="Avaliar"> 
                        </button>
                        </a> 
                        {!! Form::close()!!} 
                     </div>
                  </td>
                  @endif --}}
         </div>
         </tr>
         @endforeach
         </tbody>
         </table>
         {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
         {{-- <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-5" >
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2" >
               <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-block btn-warning btn-flat">
               Voltar</button></a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >
            </div>
         </div> --}}
         <br><br>
      </div>
   </div>
</div>
</div> 
@endsection