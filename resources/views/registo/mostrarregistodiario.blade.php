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
                <h1 class="box-title" >VER REGISTO DIÁRIO: ESCOLHA O COLABORADOR E O DIA </h1>
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

                                    {{-- pk_cliente	NIF	NISS	nomeCompleto	nomeAbreviado	visivel	email	morada	contacto	logo	contactoAlternativo	observacoes --}}
                                <th class="text-center">Colaborador</th>
                                
                                <th class="text-center">Dia</th>
                               
                             
                               
                            </tr>
                        </thead>
                        <tbody>
                                
                        @foreach ($users as $users)
                    
                      <tr>
                   
                            <td>{{$users->name}}</td>
                          <td> <div class="pull-left">
                                {!! Form::open(array('route' => 'registo.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                          <a href="" > <input id="invisible_id"  name="id" type="hidden" value="{{$users->id}}">
                                  <button type="submit" class="btn btn-success fas fa-search pull-right" title="Pesquisar">
                                 </button></a> 
                                 <div class="pull-left">
                                    <span style=" display: inline;">
                                
                          
                  
                                {!! Form::date('dia',date('Y-m-d'),['class'=>'form-control']) !!}
                                
                                    {!! Form::close()!!}
                                    </span>
                                  </div>
                                </div></td>

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




