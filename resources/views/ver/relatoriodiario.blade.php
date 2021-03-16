@extends('adminlte::page')
@section('Dashboard', 'AdminLTE')
@section('content')
<style>    
#tabs.active{
    border-top:3px solid #00a65a !important;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  max-width: 1200px;
  margin: auto;
  padding: 0 0 0 0;
  text-align: center;
  background-color: white;
  font-family: Arial, Helvetica, sans-serif;
  display: flex;
  /* flex:1 1 auto; */
}
.title{
  color:grey;
  font-size:18px;
  /* padding-bottom: 10px; */

}
.tab-pane{
    background-color: transparent!important;
}
</style>
<div class="row">
<div class="col-md-3 col-xs-12">
  <div class="pull-left">
      @for ($pa = 0; $pa < count($paginarusers); $pa++)
       @if ($users->sigla==$paginarusers[$pa]->sigla)
       @if ($pa-1>=0)
       <img src={{asset($paginarusers[$pa-1]->foto)}} class="img-circle img-sm" alt="User Image"> {{$paginarusers[$pa-1]->name}}
       <br>
       {!! Form::open(array('route' => 'relatorio.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
       <input id="invisible_id"  name="fk_tecnico" type="hidden" value="{{$paginarusers[$pa-1]->id}}">
       <input id="invisible_id"  name="dia" type="hidden" value="{{$dia}}">
       <button type="submit" class="btn btn-success btn-sm ">Anterior
      </button>
              <div class="pull-right">
                 <span style=" display: inline;">
             

             
                 {!! Form::close()!!}
                 </span>
                 </div>

       @endif
       
       @endif
   @endfor
  </div>
</div>
<div class="col-md-6 col-xs-12" style="text-align:center!important">
  <h2>Relatório Diário</h2>
</div>
<div class="col-md-3 col-xs-12">
  <div class="pull-right">
    @for ($ps = 0; $ps < count($paginarusers); $ps++)
    @if ($users->sigla==$paginarusers[$ps]->sigla)
    @if ($ps+1<count($paginarusers))
    <img src={{asset($paginarusers[$ps+1]->foto)}} class="img-circle img-sm" alt="User Image"> {{$paginarusers[$ps+1]->name}}
    <br>
    {!! Form::open(array('route' => 'relatorio.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                <input id="invisible_id"  name="fk_tecnico" type="hidden" value="{{$paginarusers[$ps+1]->id}}">
                <input id="invisible_id"  name="dia" type="hidden" value="{{$dia}}">
                        <button type="submit" class="btn btn-success btn-sm ">Seguinte
                       </button>
                       <div class="pull-right">
                          <span style=" display: inline;">
                      
         
                      
                          {!! Form::close()!!}
                        </div>
    @endif

    @endif
@endfor
 
</div>
</div>
</div>

<div class="box box-widget " style="background-color:transparent">
<!-- Add the bg color to the header using any of the bg-* classes -->
<div class="box-body" >
<div class="row" style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color:white;padding:25px;border-top:4px solid #40a431">
   
 
  
  <div class="col-xs-9 col-md-1" >    
        <div class="card ">
          <img class="img-responsive"  src={{asset($users->foto)}}  alt="User Avatar" width="200px">
        </div>
      </div>

        <div class="col-xs-12 col-md-3" >
            <h1 class="" style="">{{$users->name}}</h1>
              <p class="title">{{$cargo->descricao}}-{{$departamento->descricao}}</p>
            </div>

 <div  class="col-md-4 col-xs-12">
    
 </div >
 <div class="col-md-4 col-xs-12">

</div>
<!-- Left and right controls -->
</div>
</div>
<div class="nav-tabs-custom" >
    <ul class="nav nav-tabs" >
      <li id="tabs"><a href="#tab_3" data-toggle="tab">{{carbon\carbon::parse($ontem)->formatLocalized('%A %d-%m-%Y')}}</a></li>
      <li id="tabs"class="active"><a href="#tab_1" data-toggle="tab">{{carbon\carbon::parse($dia)->formatLocalized('%A %d-%m-%Y')}}</a></li>
      <li id="tabs"><a href="#tab_2" data-toggle="tab">{{carbon\carbon::parse($amanha)->formatLocalized('%A %d-%m-%Y')}}</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1" >
        
<section class="content">

    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <!-- The time line -->
        <ul class="timeline">
          <!-- timeline time label -->
          <li class="time-label">
                <span class="bg-red">
                  {{$dia}} </span>

                @if (count($ponto)>0)
                          
                    
                        <div class="row pull-right">
                          <div class="col-md-3 col-xs-12">
                      
                      @if ($ponto[0]->entradaTarde!=null)
                      <strong  style="text-align:center!important"> ET: {{$ponto[0]->entradaTarde}}</strong>
                      @else
                      <strong  style="text-align:center!important"> ET: --:--:-- </strong>
                      @endif 
                          </div>
                          <div class="col-md-3 col-xs-12">
                      @if ($ponto[0]->saidaTarde!=null)
                      <strong  style="text-align:center!important"> ST: {{$ponto[0]->saidaTarde}} </strong>
                      @else
                      <strong  style="text-align:center!important"> ST: --:--:-- </strong>
                      @endif
                          </div>
                          <div class="col-md-3 col-xs-12">
                      
                      @if ($ponto[0]->totalDia!=null)
                      <strong  style="text-align:center!important"> <i class="far fa-clock "></i> {{' '.$ponto[0]->totalDia.' '}} </strong>
                      @else
                      <strong   style="text-align:center!important"><i class="far fa-clock "></i> --:--:-- <strong>
                      @endif
                      </div>
                        </div>
                        <div class="row pull-right" >
                          <div class="col-md-3 col-xs-12">
                            @if ($ponto[0]->entradaManha!=null)
                            <strong  style="text-align:center!important"> EM: {{$ponto[0]->entradaManha}} </strong>
                        @else
                            <strong  style="text-align:center!important"> EM:--:--:-- </strong>
                        @endif
                          </div>
                          <div class="col-md-3 col-xs-12">
                        @if ($ponto[0]->saidaManha!=null)
                            <strong  style="text-align:center!important"> SM: {{$ponto[0]->saidaManha}} </strong>
                        @else
                            <strong  style="text-align:center!important"> SM: --:--:-- </strong>
                        @endif 
                          </div>
                          <div class="col-md-3 col-xs-12">
                        @if ($ponto[0]->tempoAlmoco!=null)
                        <strong  style="text-align:center!important"><i class="fas fa-utensils"></i>  {{'    '.$ponto[0]->tempoAlmoco.' '}}</strong>
                        @else
                        <strong  style="text-align:center!important"><i class="fas fa-utensils"></i> --:--:--</strong>
                        
                        @endif 
                        
                          </div>
                          </div>

                 @else
                 <div class="row pull-right" >
                 Sem ponto registado
                 </div>
                 @endif
                  
          </li>
          <!-- /.timeline-label -->
          <!-- timeline item -->
          @if (count($tasksdia)==0)
          <li>
            <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> - </span>

              <h3 class="timeline-header"><a > - </a> Sem tarefas registadas  </h3>

              <div class="timeline-body">
           
              </div>
              <div class="timeline-footer">
          
              </div>
            </div>
          </li>
          @else
              
      

          @foreach ($tasksdia as $tasksdia)
          <li>
            <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{$tasksdia->descricao}}</span>

              <h3 class="timeline-header"><a >{{carbon\carbon::parse($tasksdia->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasksdia->end_date)->format('H:i') }}</a> {{$tasksdia->text}} </h3>

              <div class="timeline-body">
             {!!$tasksdia->relatorio!!}
              </div>
              <div class="timeline-footer">
                {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                          
                  
                {{ Form::hidden('invisible', 'secret') }}
              
                  <input id="invisible_id" name="id" type="hidden" value={{$tasksdia->id}}>
                    <button type="submit" class="btn btn-success btn-xs "> <i class="fas fa-eye"></i>Tarefa
                   </button>
                    {!! Form::close()!!}
              
                  
              

                <a href="verprojeto/{{$tasksdia->fk_projeto}}" class="btn btn-info btn-xs "> <i class="fas fa-hard-hat"></i>{{$tasksdia->nomeProjeto}}</a>
              </div>
            </div>
          </li>
          @endforeach
          @endif
         
        </ul>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


  </section>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2">

        <section class="content">

            <!-- row -->
            <div class="row">
              <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          {{$amanha}}
                        </span>

                                @if (count($pontoamanha)>0)
                                          
                                    
                                        <div class="row pull-right">
                                          <div class="col-md-3 col-xs-12">
                                      
                                      @if ($pontoamanha[0]->entradaTarde!=null)
                                      <strong  style="text-align:center!important"> ET: {{$pontoamanha[0]->entradaTarde}}</strong>
                                      @else
                                      <strong  style="text-align:center!important"> ET: --:--:-- </strong>
                                      @endif 
                                          </div>
                                          <div class="col-md-3 col-xs-12">
                                      @if ($pontoamanha[0]->saidaTarde!=null)
                                      <strong  style="text-align:center!important"> ST: {{$pontoamanha[0]->saidaTarde}} </strong>
                                      @else
                                      <strong  style="text-align:center!important"> ST: --:--:-- </strong>
                                      @endif
                                          </div>
                                          <div class="col-md-3 col-xs-12">
                                      
                                      @if ($pontoamanha[0]->totalDia!=null)
                                      <strong  style="text-align:center!important"> <i class="far fa-clock "></i> {{' '.$pontoamanha[0]->totalDia.' '}} </strong>
                                      @else
                                      <strong   style="text-align:center!important"><i class="far fa-clock "></i> --:--:-- <strong>
                                      @endif
                                      </div>
                                        </div>
                                        <div class="row pull-right" >
                                          <div class="col-md-3 col-xs-12">
                                            @if ($pontoamanha[0]->entradaManha!=null)
                                            <strong  style="text-align:center!important"> EM: {{$pontoamanha[0]->entradaManha}} </strong>
                                        @else
                                            <strong  style="text-align:center!important"> EM:--:--:-- </strong>
                                        @endif
                                          </div>
                                          <div class="col-md-3 col-xs-12">
                                        @if ($pontoamanha[0]->saidaManha!=null)
                                            <strong  style="text-align:center!important"> SM: {{$pontoamanha[0]->saidaManha}} </strong>
                                        @else
                                            <strong  style="text-align:center!important"> SM: --:--:-- </strong>
                                        @endif 
                                          </div>
                                          <div class="col-md-3 col-xs-12">
                                        @if ($pontoamanha[0]->tempoAlmoco!=null)
                                        <strong  style="text-align:center!important"><i class="fas fa-utensils"></i>  {{'    '.$pontoamanha[0]->tempoAlmoco.' '}}</strong>
                                        @else
                                        <strong  style="text-align:center!important"><i class="fas fa-utensils"></i> --:--:--</strong>
                                        
                                        @endif 
                                        
                                          </div>
                                          </div>

                                @else
                                <div class="row pull-right" >
                                Sem ponto registado
                                </div>
                                @endif
                      



                  </li>
                              <!-- /.timeline-label -->
                              <!-- timeline item -->
                              @if (count($tasksamanha)==0)
                              <li>
                                <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
                    
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> - </span>
                    
                                  <h3 class="timeline-header"><a > - </a> Sem tarefas registadas  </h3>
                    
                                  <div class="timeline-body">
                              
                                  </div>
                                  <div class="timeline-footer">
                              
                                  </div>
                                </div>
                              </li>
                              @else
                              @foreach ($tasksamanha as $tasksamanha)
                              <li>
                                <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
                    
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> {{$tasksamanha->descricao}}</span>
                    
                                  <h3 class="timeline-header"><a >{{carbon\carbon::parse($tasksamanha->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasksamanha->end_date)->format('H:i') }}</a> {{$tasksamanha->text}} </h3>
                    
                                  <div class="timeline-body">
                                {!!$tasksamanha->relatorio!!}
                                  </div>
                                  <div class="timeline-footer">
                                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                                              
                                      
                                    {{ Form::hidden('invisible', 'secret') }}
                                  
                                      <input id="invisible_id" name="id" type="hidden" value={{$tasksamanha->id}}>
                                        <button type="submit" class="btn btn-success btn-xs fas fa-eye"> tarefa
                                      </button>
                                        {!! Form::close()!!}
                                  
                                      
                                  
                    
                                    <a href="verprojeto/{{$tasksamanha->fk_projeto}}" class="btn btn-info btn-xs fas fa-hard-hat"> {{$tasksamanha->nomeProjeto}}</a>
                                  </div>
                                </div>
                              </li>
                              @endforeach
                              @endif
                            </ul>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    
                    
                      </section>
                  </div>

      <!-- /.tab-pane -->
    <!-- /.tab-content -->
    <div class="tab-pane" id="tab_3" >
      <section class="content">

        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  {{$ontem}}
                </span>

                        @if (count($pontoontem)>0)
                                  
                            
                                <div class="row pull-right">
                                  <div class="col-md-3 col-xs-12">
                              
                              @if ($pontoontem[0]->entradaTarde!=null)
                              <strong  style="text-align:center!important"> ET: {{$pontoontem[0]->entradaTarde}}</strong>
                              @else
                              <strong  style="text-align:center!important"> ET: --:--:-- </strong>
                              @endif 
                                  </div>
                                  <div class="col-md-3 col-xs-12">
                              @if ($pontoontem[0]->saidaTarde!=null)
                              <strong  style="text-align:center!important"> ST: {{$pontoontem[0]->saidaTarde}} </strong>
                              @else
                              <strong  style="text-align:center!important"> ST: --:--:-- </strong>
                              @endif
                                  </div>
                                  <div class="col-md-3 col-xs-12">
                              
                              @if ($pontoontem[0]->totalDia!=null)
                              <strong  style="text-align:center!important"> <i class="far fa-clock "></i> {{' '.$pontoontem[0]->totalDia.' '}} </strong>
                              @else
                              <strong   style="text-align:center!important"><i class="far fa-clock "></i> --:--:-- <strong>
                              @endif
                              </div>
                                </div>
                                <div class="row pull-right" >
                                  <div class="col-md-3 col-xs-12">
                                    @if ($pontoontem[0]->entradaManha!=null)
                                    <strong  style="text-align:center!important"> EM: {{$pontoontem[0]->entradaManha}} </strong>
                                @else
                                    <strong  style="text-align:center!important"> EM:--:--:-- </strong>
                                @endif
                                  </div>
                                  <div class="col-md-3 col-xs-12">
                                @if ($pontoontem[0]->saidaManha!=null)
                                    <strong  style="text-align:center!important"> SM: {{$pontoontem[0]->saidaManha}} </strong>
                                @else
                                    <strong  style="text-align:center!important"> SM: --:--:-- </strong>
                                @endif 
                                  </div>
                                  <div class="col-md-3 col-xs-12">
                                @if ($pontoontem[0]->tempoAlmoco!=null)
                                <strong  style="text-align:center!important"><i class="fas fa-utensils"></i>  {{'    '.$pontoontem[0]->tempoAlmoco.' '}}</strong>
                                @else
                                <strong  style="text-align:center!important"><i class="fas fa-utensils"></i> --:--:--</strong>
                                
                                @endif 
                                
                                  </div>
                                  </div>

                        @else
                        <div class="row pull-right" >
                        Sem ponto registado
                        </div>
                        @endif
              



          </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              @if (count($tasksontem)==0)
              <li>
                <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
    
                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> - </span>
    
                  <h3 class="timeline-header"><a > - </a> Sem tarefas registadas  </h3>
    
                  <div class="timeline-body">
               
                  </div>
                  <div class="timeline-footer">
              
                  </div>
                </div>
              </li>
              @else
              @foreach ($tasksontem as $tasksontem)
              <li>
                <i class="fa" style=""><img src={{asset($users->foto)}} class="img-circle img-sm" style="border:1px solid grey"alt="User Image"></i>
    
                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> {{$tasksontem->descricao}}</span>
    
                  <h3 class="timeline-header"><a >{{carbon\carbon::parse($tasksontem->start_date)->format('H:i')}}-{{carbon\carbon::parse($tasksontem->end_date)->format('H:i') }}</a> {{$tasksontem->text}} </h3>
    
                  <div class="timeline-body">
                 {!!$tasksontem->relatorio!!}
                  </div>
                  <div class="timeline-footer">
                    {!! Form::open(array('route' => 'tarefa.ver','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
                              
                      
                    {{ Form::hidden('invisible', 'secret') }}
                  
                      <input id="invisible_id" name="id" type="hidden" value={{$tasksontem->id}}>
                        <button type="submit" class="btn btn-success btn-xs fas fa-eye"> tarefa
                       </button>
                        {!! Form::close()!!}
                  
                      
                  
    
                    <a href="verprojeto/{{$tasksontem->fk_projeto}}" class="btn btn-info btn-xs fas fa-hard-hat"> {{$tasksontem->nomeProjeto}}</a>
                  </div>
                </div>
              
              </li>
              @endforeach
              @endif

              
            </ul>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    
    
      </section>
    </div>
  </div>
</div>
<div class="row" align="center">
  <div class="col-xs-12 col-sm-12 col-md-5" >

      </div>
              <div class="col-xs-12 col-sm-12 col-md-2" >
                
                  <a href="dashboard" ><button type="button" class="btn btn-block btn-warning btn-flat">
                          Voltar</button></a>
              
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5" >

      </div>
</div><br><br>
@stop