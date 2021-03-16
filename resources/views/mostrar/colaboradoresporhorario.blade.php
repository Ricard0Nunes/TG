@extends('adminlte::page')

@section('Colaboradores por Departamento', 'AdminLTE')




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
                <h1 class="box-title" >MOSTRAR COLABORADORES DO  HORÁRIO: {{$horario}}</h1> 
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
                                    <th class="text-center">Sigla</th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Departamento</th>
                                    <th class="text-center">Cargo</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contacto</th>
                                    <th class="text-center">Contacto Pessoal</th>
                                    <th class="text-center">NIF</th>
                                    <th class="text-center">Horário</th>
                                    <th class="text-center">Subcontratado</th>
                                    <th class="text-center">Gerir</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($colabhorario as $colabhorario)
                                @if ($colabhorario->visivel == 1)
                                    {{--row a verde--}}
                                    <tr id="tr"  class="{{$teste = 'success'}}">
                                @else
                                    {{--row a vermelho--}}
                                    <tr id="tr"  class="{{$teste = 'danger'}}">
                                @endif
                                    {{-- dados da tabela --}}
                                    <td class="text-center">{{$colabhorario->id}}</td>
                                    <td class="text-center">{{$colabhorario->sigla}}</td>
                                    <td class="text-center">{{$colabhorario->name}}</td>
                                    <td class="text-center">{{DB::table('departamentos')->where('pk_departamento',$colabhorario->fk_departamento)->value('abreviatura')}}</td>
                                    <td class="text-center">{{DB::table('cargos')->where('pk_cargo', $colabhorario->fk_cargo)->value('descricao')}}</td>
                                    <td class="text-center">{{$colabhorario->email}}</td>
                                    <td class="text-center">{{$colabhorario->contactoPessoal}}</td>
                                    <td class="text-center">{{$colabhorario->contactoProfissional}}</td>
                                    <td class="text-center">{{$colabhorario->nif}}</td>
                                    <td class="text-center">{{DB::table('horarios')->where('pk_horario',$colabhorario->fk_horario)->value('descricao')}}</td>
                                  @if ($colabhorario->subcontratado==1)
                                  <td class="text-justify">Sim</td>
                                  @else
                                  <td class="text-justify">Não</td>
        
                                  @endif
                           
                                 
        
                                    <td>  {{--opçoes de gestão de colabhorarios--}}
                                        <div class="text-center">
                                          
                                        <a href="{{url('/')}}/veruser/{{$colabhorario->id}}" class="btn btn-success btn-sm far fa-eye" title="Colaborador Horário Visível"></a>
                                        <a href="{{url('/')}}/editaruser/{{$colabhorario->id}}" class="btn btn-warning btn-sm far fa-edit" title="Editar Colaborador"></a> {{--Editar recurso--}}

                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                    </table>

                    </div>
                {{-- <a href="novodepartamento" class="btn btn-success btn-sm far fa-edit" title="criar cargo">Criar departamento</a> Editar recurso --}}

            </div>
        </div>
        <div class="row" align="center">
                <div class="col-xs-12 col-sm-12 col-md-5" >
        
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




