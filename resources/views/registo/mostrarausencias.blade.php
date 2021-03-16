@extends('adminlte::page')

@section('Mostrar Ausências', 'Mostrar Ausências')




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
                <h1 class="box-title" >MOSTRAR AUSÊNCIAS</h1>
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
                                    <th class="text-center">Estado</th>                
                                    <th class="text-center">Colaborador</th>
                                    <th class="text-center">Descrição</th>
                                
                                <th class="text-center">Inicio</th>
                                <th class="text-center">Fim</th>
                             
                              
                             
                               
                            </tr>
                        </thead>
                        <tbody>
                                
                        @foreach ($ausencias as $ausencias)
                    
                      <tr>


                            @if ($ausencias->estado>0)

                            <td class="text-justify">  Aprovado Por : {{$ausencias->aprovadoPor}}  {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                {!! Form::open(array('route' => 'ausencia.apagar','method'=>'POST','files'=>'true' ,'style'=>'display:inline-block')) !!}
                                <a href="" > <input id="aaa" name="apagar" type="hidden" value={{$ausencias->pk_ausencia}}>
                                  <button type="submit" class="btn btn-danger fas fa-trash-alt" title="Apagar Ausência">
                                      </button></a> 
                                  {!! Form::close()!!}
                                    </td>
                            @else
                            <td class="text-justify"> 
                                    {!! Form::open(array('route' => 'ausencia.aprovar','method'=>'POST','files'=>'true')) !!}
                                     {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                    <a href="" > <input id="aaa" name="aprovar" type="hidden" value={{$ausencias->pk_ausencia}}>
                                      <button type="submit" class="btn btn-success fas fa-thumbs-up" title="Aprovar Ausência">
                                          </button></a> 
                                      {!! Form::close()!!}
                                      {!! Form::open(array('route' => 'ausencia.reprovar','method'=>'POST','files'=>'true')) !!}
                                      {{ Form::hidden('invisible', 'secret', array('id' => 'reagendar')) }}
                                      <a href="" > <input id="aaa" name="reprovar" type="hidden" value={{$ausencias->pk_ausencia}}>
                                        <button type="submit" class="btn btn-danger fas fa-thumbs-down" title="Reprovar Ausência">
                                            </button></a> 
                                        {!! Form::close()!!}
                                    </td>
                            @endif
                            @if ($ausencias->estado==1)
                            <td class="text-center"><span class="label label-success">Aprovado</span></td> 
                             @elseif($ausencias->estado==0)
                         <td class=text-center><span class="label label-warning">Pendente</span></td> 
                                @elseif($ausencias->estado==2)
                         <td class=text-center><span class="label label-danger">Reprovado</span></td> 
                             @endif
                          <td>{{DB::connection('geraltg')->table('userscomuns')->where('BI',$ausencias->biuser)->value('nome')}}</td>
                   <td>{{DB::connection('geraltg')->table('justificacoes')->where('pk_justificacao',$ausencias->fk_justificacao)->value('descricao')}}</td>
                   <td class="text-center">{{$ausencias->start}}</td>
                   <td class="text-center">{{$ausencias->end}}</td>



                 
{{-- 
             <td class="text-center">
                    <a href="#" class="btn btn-warning btn-sm far fa-edit" title="Editar "></a> Editar recurso
                
                    <a href="#" class="btn btn-danger btn-sm far fa-trash-alt" title="apagar "></a> 
                   </td> --}}


                            
                       

                        </tr>
                      
                    @endforeach
                
                    </tbody>
                    </table>
                    <div class="row" align="center">
                            <div class="col-xs-12 col-sm-12 col-md-4" >
                    
                                </div>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div> 
@endsection




