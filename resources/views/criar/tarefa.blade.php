
@extends('adminlte::page')

@section('title', 'TurtleGest')



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

@section('content')

<div class="box box-success">
        <div class="box-header with-border">
                <h3 class="box-title">CRIAR UMA TAREFA</h3>
                <div class="box-tools pull-right">
                  <!-- Buttons, labels, and many other things can be placed here! -->
                  <!-- Here is a label for example -->
                  {{-- <span class="label label-primary">Criar um Cargo</span> --}}
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
    <div class="box-body">

{!! Form::open(array('route' => 'tarefa.store','method'=>'POST','files'=>'true', 'class'=>'form-horizontal')) !!}
<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
            @if(Session::has('success'))
      <div class="alert alert-success">
            {{ Session::get('success')}}
      </div>
            @elseif( Session::has('Warning'))
            <div class="alert alert-danger">
                        {{ Session::get('Warning')}}
                  </div>
           @endif 
      </div>
</div>
            

  
   
<div class="box-body">
    <div class="form-group">{{--Div de class form-group de forma a dar estrutura ao formulário--}}  
    {!! Form::label('','Cliente (*)' ,['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
       <select name="fk_cliente" class="form-control" id="cliente" required>    
          <option value="">Escolha a empresa Cliente</option>
              @foreach ($clientes as $clientes)
                <option value="{{$clientes->pk_cliente}}">{{$clientes->nomeCompleto}}</option>
                     @endforeach
                      </select>
                    </div>
                  </div>  


                   <div class="form-group">  {{--Div de class form-group de forma a dar estrutura ao formulário--}}   
                    {!! Form::label('','Projeto (*)' ,['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        <select name="fk_projeto" class="form-control" id="projeto" required>
                        <option value="{{ old('fk_projeto') }}"></option>
                        </select>
                     </div>
                       </div>
                 
                
                       <div class="form-group">  {{--Div de class form-group de forma a dar estrutura ao formulário--}}   
                        {!! Form::label('','Etapa (*)' ,['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                        <select name="parent" class="form-control" id="etapa" required>
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                  
                 
               <div class="form-group">  {{--Div de class form-group de forma a dar estrutura ao formulário--}}   
                        {!! Form::label('','Descrição (*)' ,['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                     <input type="text" value="{{ old('text') }}"name="text" class="form-control" required>  
                        </div>
               </div>
 
                        <div class="form-group"> 
                            {!! Form::label('','Data Início (*)' ,['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                    <input type="date"value={{carbon\carbon::parse($dia)->format('Y-m-d') }} name="diaInicio" class="form-control " required> 
                                   </div></div>
                                    
                        <div class="form-group"> 
                            {!! Form::label('','Hora Início (*)' ,['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                    <input type="time" value="{{ old('horaInicio') }}"name="horaInicio" class="form-control"required>
                                   </div> </div>
 
                        <div class="form-group"> 
                            {!! Form::label('','Data Fim (*)' ,['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                    <input type="date" value={{carbon\carbon::parse($dia)->format('Y-m-d') }} name="diaFim" class="form-control " required> 
                                  </div></div>

                        <div class="form-group"> 
                            {!! Form::label('','Hora Fim (*)' ,['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                     <input type="time" value="{{ old('horaFim') }}"name="horaFim" class="form-control"required> 
                                  </div>  </div>  
                     
                                                <div class="form-group">   
                                                    {!! Form::label('','Tipo Tarefa (*)' ,['class'=>'col-sm-2 control-label']) !!}
                                                    <div class="col-sm-5">
                                                        <select name="tipo" id="tipo" class="form-control">
                                                            <option value="2">Tarefa</option>
                                                            <option value="5">Reunião</option>
                                                            <option value="6">Call de Skype</option>
                                                        </select> 
                                                        </div>
                                                </div>
                                       
                                            
                                    <div class="form-group"> 
                                          {!! Form::label('maisUsers','Adicionar Colaboradores? (*)',['class'=>'col-sm-2 control-label']) !!} 
                                          <div class="col-sm-5">
                                            <div id="radioButtons"> {{-- radioButton - É reclamação de cliente ?: sim ou não --}} 
                                                      <div class="col-xs-2 col-sm-2 col-md-2">
                                                            <input type="radio" name="simNao2" id="simNao2" value="1" required="" >Sim 
                                                 
                                                     
                                                            <input type="radio" name="simNao2" id="simNao2" value="0" required checked>Não
                                                      </div>
                                              
                                            </div>
                                    </div> 
                            </div>

                                <script>
                                    var radio = document.getElementsByName('simNao2'); 
                    
                                    for (var i = 0; i < radio.length; i++) {
                                        radio[i].onclick = function() {
                                        var valorRadio = this.value; 
                    
                                            if(valorRadio == '1'){
                                            document.getElementById("maisUsers").className = "";  
                                            }
                                            else if(valorRadio == '0'){
                                            document.getElementById("maisUsers").className = "hidden"; 
                                            }
                                        }
                                    }
                              </script>  
 
                                  <div class="hidden" id="maisUsers">  
                                    <div class="form-group"> 
                                        {!! Form::label('','Colaboradores: (*)',['class'=>'col-sm-2 control-label']) !!} 
                                        <div class="col-sm-5">
                                        <select name="participantes[]" class="form-control" id="users" multiple>
                                            <option value=""></option>
                                        </select> 
                                </div>
                            </div>   </div>


                                  <div class="form-group"> 
                                    {!! Form::label('terminado','Tarefa foi executada? (*)',['class'=>'col-sm-2 control-label']) !!} 
                                    <div class="col-sm-5">  
                                          <div id="radioButtons"> {{-- radioButton - É reclamação de cliente ?: sim ou não --}} 
                                                      <div class="col-xs-2 col-sm-2 col-md-2">
                                                            <input type="radio" name="simNao" id="simNao" value="1" required="" >Sim  
                                                            <input type="radio" name="simNao" id="simNao" value="0" required checked>Não
                                                      </div> 
                                          </div>
                                    </div>
                            </div> 
                      
                     
                            <script>
                                    var radio = document.getElementsByName('simNao'); 
                    
                                    for (var i = 0; i < radio.length; i++) {
                                        radio[i].onclick = function() {
                                        var valorRadio = this.value; 
                    
                                            if(valorRadio == '1'){
                                            document.getElementById("relatorio1").className = "";  
                                            }
                                            else if(valorRadio == '0'){
                                            document.getElementById("relatorio1").className = "hidden"; 
                                            }
                                        }
                                    }
                              </script>                    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

 

                                 
                                        <div class="hidden" id="relatorio1"> 
                                            <div class="form-group">  
                                        {!! Form::label('relatorio','Relatório: (*)',['class'=>'col-sm-2 control-label']) !!} 
                                        <div class="col-sm-9">
                                          <textarea  name="relatorio" required >{{ old('relatorio') }}</textarea>
                                         <script>
                                                        CKEDITOR.replace( 'relatorio' );
                                        </script> 
                                        </div> 
                                        </div>
                                        </div>
                         
                                
 
 

                                        <div class="box-footer">
                                            <div class="col-xs-12 col-sm-12 col-md-18" >
                                                  <button type="submit" class="btn btn-success pull-right">Enviar</button>
                                   
                                               <div class="col-xs-12 col-sm-12 col-md-11" >
                                                  <a href="{{ URL::previous() }}" ><button type="button" class="btn btn-warning pull-right">
                                                     Voltar</button></a>
                                      
                                               </div>
                                            </div>
                                           
                                         </div>
    <br><br> 
  {!! Form::close()!!}
 
<script  type="text/javascript">
    $('#cliente').on('change', function(e){
        console.log(e);
        var pk_cliente = e.target.value;
        
        $.get('/ajax-projeto?pk_cliente='+ pk_cliente, function(data){
            $('#projeto').empty();
            $('#projeto').append('<option value="">' +'Escolha um Projeto'+ '</option>');
            $.each(data, function(index, projetoObj){
                $('#projeto').append('<option value="' + projetoObj.pk_projeto + '">' + projetoObj.codProj + '</option>');
            });
        });
       

    });


</script>
<script>
    $('#projeto').on('change', function(e1){
                console.log(e1);
                var pk_projeto = e1.target.value;
         $.get('/ajax-etapa?pk_projeto='+ pk_projeto, function(data2){                           
                    $('#etapa').empty();
                    $('#etapa').append('<option value="">' +'Escolha uma Etapa'+ '</option>');
                    $.each(data2, function(index,etapaObj){                        
                        $('#etapa').append('<option value="' + etapaObj.id + '">'+ etapaObj.text + '</option>');
                    });
                });
            });
        </script>

<script>
    $('#projeto').on('change', function(e2){
                console.log(e2);
                var pk_projeto1 = e2.target.value;
         $.get('/ajax-users?pk_projeto='+ pk_projeto1, function(data3){                           
                    $('#users').empty();
                    // $('#users').append('<option value="">' +'Escolha uma users'+ '</option>');
                    $.each(data3, function(index,usersObj){                        
                        $('#users').append('<option value="' + usersObj.id + '">'+ usersObj.name + '</option>');
                    });
                });
            });
        </script>
@stop

