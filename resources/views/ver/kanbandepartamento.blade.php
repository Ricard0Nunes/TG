@extends('adminlte::page')

@section('Kanban', 'Kanban De Departamento')
<div class="box box-widget " style="background-color:transparent">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="box-header with-border">
        <h3 class="box-title col-sm-2 control-label" >Kanban do Departamento - DEPARTAMENTO</h3>
  </div>
    <div class="box-body" >
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center">Pendentes ()</h4>  
              <hr style="  border: 5px solid  #009abf;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row"  style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                  
                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #009abf !important;">
                        <div class="row">
                          <div class="pull-left">
                            <span></span>
                          </div>
                          <div class="pull-right">
                            <span style="color:red"> </span>
                        
                          </div>
                        </div>  
                        <br>
                        <div class="row">                         
                          <div class="pull-left">
                            Técnico:<span class="badge bg-green"></span>
                          </div>
                          <div class="pull-right">
                            <span class="badge bg-red" style="background-color:#eb4e4e !important"></span>
                          </div>
                        </div> 
                      </div>  
                    </div> 
                </div>  
              </div>   
            </div>     
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center">Em Curso ()</h4>  
              <hr style="  border: 5px solid #40a431;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row" style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #40a431 !important;">
                        <div class="row">
                          <div class="pull-left">
                            <span></span>
                          </div>
                          <div class="pull-right">
                            <span style=""></span>
                          </div>   
                        </div>
                        <br>
                        <div class="row">                         
                          <div class="pull-left">
                            Técnico:<span class="badge bg-green"></span>
                          </div>
                          <div class="pull-right">
                            <span class="badge bg-red" style="background-color:#eb4e4e !important"></span>
                          </div>
                        </div> 
                      </div>  
                    </div> 
                  @endforeach  
                </div>   
              </div> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4" >   
              <h4 style="text-align:center"> Concluido ()</h4>  
              <hr style="  border: 5px solid #eb4e4e;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;">
              <div class="row" style="	max-height:450px;overflow-y:auto;">
                <div class="col-xs-12 col-sm-12 col-md-12" >
                    <div class="box-body">
                      <div class="callout callout-success" style="background-color:white !important;color:black !important; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)!important;border-left: 5px solid #eb4e4e !important;">
                        <div class="row">
                          <div class="pull-left">
                            <span>}</span>
                          </div>
                          <div class="pull-right">
                            <span style="color:green"></span>
                          </div>  
                        </div>             
                        <br>            
                        <div class="row">                         
                          <div class="pull-left">
                            Técnico:<span class="badge bg-green"></span>
                          </div>
                          <div class="pull-right">
                            <span class="badge bg-red" style="background-color:#eb4e4e !important"></span>
                          </div>
                        </div> 
                      </div>  
                    </div>  
                </div>
              </div>
            </div>     
          </div>   
  
      
    </div>
</div>
<br>


@stop