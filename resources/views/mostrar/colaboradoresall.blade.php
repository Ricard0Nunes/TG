@extends('adminlte::page')

@section('userss', 'AdminLTE')




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
                <h1 class="box-title" > COLABORADORES</h1>
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

                           
                             
                                <th class="text-center">Sigla</th>
                                <th class="text-center">Nome</th>
                                <th class="text-center">Empresa</th>
                             
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Cargo</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Contacto Profissional</th>
                                <th class="text-center">Contacto Pessoal</th>
                                <th class="text-center">Skype</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Horário</th>
                                
                  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($user as $users)
                
                            <tr id="tr">
                       
                      
                            {{-- dados da tabela --}}
                            <td class="text-justify">{{$users->sigla}} <img src={{asset($users->foto)}} class="img-circle img-sm" alt="User Image"> </td>
                            <td class="text-justify">{{$users->name}}</td>
                            <td class="text-justify">{{DB::connection('geraltg')->table('empresascomuns')->where('NIF',$users->nifEmpregador)->value('nomeAbreviado')}}</td>
                        
                            <td class="text-justify">{{DB::table('departamentos')->where('pk_departamento',$users->fk_departamento)->value('abreviatura')}}</td>
                            <td class="text-justify">{{DB::table('cargos')->where('pk_cargo',$users->fk_cargo)->value('descricao')}}</td>
                            <td class="text-justify">{{$users->email}}</td>
                            <td class="text-justify">{{$users->contactoProfissional}}</td>
                            <td class="text-justify">{{$users->contactoPessoal}}</td>
                            <td class="text-justify">@if ($users->skype==null)
                                <i class="fab fa-skype" > Sem skype
                            @else
                            <a href='skype:{{$users->skype}}?chat&topic=Teste'><i class="fab fa-skype" >{{$users->skype}}</a></td>
                            @endif
                           
                            <td class="text-justify"> @if ($users->status==1)
                                <span class="label label-success">Presente</span>
                                @else 
                                <span class="label label-warning">Ausente</span>
                            @endif


                               </td>
                            <td class="text-justify">{{DB::table('horarios')->where('pk_horario',$users->fk_horario)->value('descricao')}}</td>
 
                        
                   
                         

                           
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                                
    
                                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




