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
          }});
   });
</script>
@if ($formacoes->estado == 0)
<div class=" box box-success">
   <div class="box-header with-border" >
      <h1 class="box-title" >MOSTRAR INSCRIÇÃO DA FORMAÇÃO: {{$formacoes->nome_formacao}} | Nº INICIAL DE VAGAS: {{$formacoes->numero_vagas}} - Nº INSCRITOS: {{count($inscricao)}} |</h1>
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
         <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">Nome Inscritos</th>
                     <th class="text-center">Data de Inscrição</th>
                     <th class="text-center">Avaliação User</th>
                     <th class="text-center">Avaliação Colaborador</th>
                     <th class="text-center">Gerir</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($inscricao as $inscricao)
                  {{-- dados da tabela --}}
                  <td class="text-center">{{$inscricao->pk_inscricao}}</td>
                  <td class="text-center"> {{$inscricao->name}}</td>
                  <td class="text-center">{{carbon\carbon::parse($inscricao->data_inscricao)->formatLocalized(' %A, %d de %B de %Y')}}</td>
                  <td class="text-center">{{$inscricao->avaliacao_user}}</td>
                  <td class="text-center">{{$inscricao->avaliacao_formador}}</td>
                  <td class="text-center"> 
                     {!! Form::open(array('route' => 'inscrito.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                     {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                     <a href="" > <input id="aaa" name="id" type="hidden" value={{$inscricao->pk_inscricao}}><button type="submit" class="fas fa-trash-alt btn btn-danger"> 
                     </button></a>                  
                     {!! Form::close()!!}
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            <div class="row" align="center">
               <div class="col-xs-12 col-sm-12 col-md-5" >
               </div>
               <div class="col-xs-12 col-sm-12 col-md-2" >
                  <a href="{{url('/')}}/formacao/" ><button type="submit" class="btn btn-block btn-warning btn-flat">Voltar</button></a> 
               </div>
            </div>
            <br><br>
            {{-- 
            <div class="col-sm-5">
               {!! Form::select('fk_ausencia', $naoinscritos ,null,array('class' => 'form-control', 'id'=>'justificacao', 'placeholder' => 'Inscreva o Colaborador' ,'required'=>'required')) !!}
               {!! $errors->first('fk_ausencia','
               <p class="alert alert-danger">:message</p>
               ')!!}
            </div>
            --}}
            {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
         </div>
      </div>
   </div>
</div>
<br>






<div class=" box box-success">
<div class="box-header with-border" >
   <h1 class="box-title" >Não Inscritos - {{$formacoes->nome_formacao}}</h1>
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
      @if(Session::has('success'))
      <div class="alert alert-success">
         {{ Session::get('success')}}
      </div>
      @endif 
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <table id="example2" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th class="text-center">Nome Colaboradores</th>
               <th class="text-center">Inscrever</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($naoinscritos as $naoinscritos)
            {{-- dados da tabela --}}
            <td class="text-center">{{$naoinscritos->name}}</td>
            <div class="text-center">
               <td class="text-center">
                  {!! Form::open(array('route' => 'inscricao.inserir','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  <a href="" > <input id="invisible_id"  name="id_inscrito" type="hidden" value="{{$naoinscritos->id}}">
                  <a href="" > <input id="invisible_id" name="id_formacao" type="hidden" value={{$formacoes->pk_formacao}}>
                  <button type="submit" class="btn btn-success">
                  Inscrever </button></a> 
                  <div class="pull-left">
                     <span style=" display: inline;">
                     {!! Form::close()!!}
               </td>
               </tr>
               @endforeach
         </tbody>
      </table>
      {{-- <a href="novocargo" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar Cargo</a> Editar recurso --}}
      </div>
      </div>
   </div>
</div>

@else

<div class="box box-success">
   <div class="box-header with-border" >
      <h1 class="box-title" >Mostrar Inscrição da Formação: {{$formacoes->nome_formacao}} | Nº Inicial de Vagas: {{$formacoes->numero_vagas}} - Nº Inscritos: {{count($inscricao)}} |</h1>
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
         <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th class="text-center">#</th>
                     <th class="text-center">Nome Inscritos</th>
                     <th class="text-center">Data de Inscrição</th>
                     <th class="text-center">Avaliação User</th>
                     <th class="text-center">Avaliação Colaborador</th>
                     {{-- <th class="text-center">Gerir</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($inscricao as $inscricao)
                  {{-- dados da tabela --}}
                  <td class="text-center">{{$inscricao->pk_inscricao}}</td>
                  <td class="text-center"> {{$inscricao->name}}</td>
                  <td class="text-center">{{carbon\carbon::parse($inscricao->data_inscricao)->formatLocalized(' %A, %d de %B de %Y')}}</td>
                  <td class="text-center">{{$inscricao->avaliacao_user}}</td>
                  <td class="text-center">{{$inscricao->avaliacao_formador}}</td>
                  {{-- <td class="text-center"> 
                     {!! Form::open(array('route' => 'inscrito.apagar','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                     {{ Form::hidden('invisible', 'secret', array('id' => 'apagar')) }}
                     <a href="" > <input id="aaa" name="id" type="hidden" value={{$inscricao->pk_inscricao}}><button type="submit" class="fas fa-trash-alt btn btn-danger"> 
                     </button></a>                  
                     {!! Form::close()!!}
                  </td> --}}
                  </tr>
                  @endforeach
               </tbody>
            </table>
            <div class="row" align="center">
               <div class="col-xs-12 col-sm-12 col-md-5" >
               </div>
               <div class="col-xs-12 col-sm-12 col-md-2" >
                  {{-- <a href="{{url('/')}}/formacao" ><button type="button" class="btn btn-block btn-success btn-flat">
                     Criar Horário</button></a>

                  {!! Form::open(array('route' => 'formacao','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                  {{ Form::hidden('invisible', 'secret', array('id' => 'editar')) }}
                  <a href="{{url('/')}}/formacao/" ><button type="submit" class="btn btn-block btn-warning btn-flat">Voltaraaa</button></a> 
                  {!! Form::close()!!}  --}}
                  <a href="/formacao"><button type="button" class="btn btn-block btn-warning btn-flat">Voltar</button></a>

               </div>
            </div>
            <br><br>
            <br><br>
             </div>
      </div>
   </div>
</div>
@endif

@endsection