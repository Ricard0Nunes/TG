@extends('adminlte::page')

@section('empresas', 'Ver Empresa')

<style>
      .cardBorder{
        border-width:5px;
        border-style:solid;
        border-color:green;
        padding: 5px;
        resize: both;
        }

      .imageBorder{
        border-width:5px;
        border-style:solid;
        border-color:green;
        resize: both;
      }

      .projDepCard{
        border-style:solid;
        border-width:3px;
        border-color:green;
        padding: 20px;
      }
</style>

@section('content')
{{-- Row: Cartão de apresentação Empresa --}}
<div class="row">
      <div class="col-md-12">
            <div class="box box-widget widget-user">
                  <div class="widget-user-header bg-black" style="background: url('https://www.thestatesman.com/wp-content/uploads/2019/04/Physics-and-business.jpg') center center; height: 250px;">
                        <div class="row">
                              <div class="col-xs-4 col-sm-4 col-md-3">
                                    <div class="box" style="border: none;">
                                          <div class="box-body cardBorder">
                                                <h3 class="widget-user-username" style="color:black"><b>{{$empresa[0]->nomeCompleto}}</b></h3>
                                                <h5 class="widget-user-desc" style="color:black">{{$empresa[0]->nomeAbreviado}}</h5>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-xs-4 col-sm-4 col-md-3" style="float:right;"> 
                                    <img src="{{$empresa[0]->logo}}" alt="logo da Empresa" class="imageBorder zoomable" style="width: 190px; height:87px;">
                              </div>
                        </div>
                  </div>
                  <div class="box-footer">
                        <div class="row">
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-envelope-square fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Email: </b></span>    
                                                <div style="font-size:17px;">{{$empresa[0]->email}}</div> 
                                          </p>
                                    </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-map-marked-alt fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Morada: </b></span> 
                                                <div style="font-size:17px;">{{$empresa[0]->morada}}</div>
                                          </p>
                                    </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-phone-square-alt fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Contacto: </b></span>   
                                                <div style="font-size:17px;"></div>{{$empresa[0]->contacto}}    
                                          </p>
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="far fa-clock fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Horário Abertura: </b></span>    
                                                <div style="font-size:17px;">{{$empresa[0]->horarioAbertura}}</div>
                                          </p>
                                    </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-clock fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Horário Fecho: </b></span>    
                                                <div style="font-size:17px;">{{$empresa[0]->horarioFecho}}</div>
                                          </p>
                                    </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="far fa-id-card fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>NIF: </b></span>   
                                                <div style="font-size:17px;">{{$empresa[0]->NIF}}</div>   
                                          </p>
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-id-card fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>NISS: </b></span>    
                                                <div style="font-size:17px;">{{$empresa[0]->NISS}}</div>  
                                          </p>
                                    </div>
                              </div>
                              <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                          <i class="fas fa-info-circle fa-4x" style="color:green;"></i> 
                                          <br><br>
                                          <p>
                                                <span class="description-text"><b>Observações: </b></span>                            
                                                <div class="row" style=" padding: 5px 50px 50px 50px; font-size:17px;"> 
                                                      <div class="center-block text-center" style=" text-align: justify;">
                                                            {{$empresa[0]->observacoes}}  
                                                      </div>
                                              </div>

                                          </p>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
{{-- Fim Row: Cartão de apresentação Empresa --}}



<div class="box   box-success">
      <div class="box-header">
            <h3 class="box-title"><b>Mais informações da Empresa</b></h3>
      </div>

      <div class="box-body">
            {{-- Row: Gráficos --}}
            <div class="row">
                  <div class="col-md-12">
                        <h2>Dados Económicos</h2>
                        <i>*colocar gráficos*</i>
                  </div>
            {{-- Fim Row: Gráficos --}}  
            </div>
      
            {{-- Row: Projetos(Pendentes, Em andamento, Concluidos)--}}
            <div class="row">
                  <div class="col-md-12">
                        <div class="row">
                              <div class="col-md-12">
                                    <h2>Projetos da Empresa - {{$empresa[0]->nomeCompleto}}</h2>
                                    <div class="col-md-4">
                                          <h2>Pendentes</h2>
                                          <div class="callout callout-danger">
                                                <h4>Projeto A</h4>
                                                <p>Decrição</p>
                                          </div>
                                          <div class="callout callout-danger">
                                                <h4>Projeto B</h4>
                                                <p>Decrição</p>
                                          </div>
                                          <div class="callout callout-danger">
                                                <h4>Projeto C</h4>
                                                <p>Decrição</p>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                          <h2>Em Andamento</h2>
                                          <div class="callout callout-warning">
                                                <h4>Projeto A</h4>
                                                <p>Decrição</p>
                                          </div>
                                          <div class="callout callout-warning">
                                                <h4>Projeto B</h4>
                                                <p>Decrição</p>
                                          </div>
                                          <div class="callout callout-warning">
                                                <h4>Projeto C</h4>
                                                <p>Decrição</p>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                          <h2>Concluidos</h2>
                                          <div class="callout callout-success">
                                                <h4>Projeto A</h4>
                                                <p>Decrição</p>
                                          </div>
                                          <div class="callout callout-success">
                                                <h4>Projeto B</h4>
                                                <p>Descrição</p>
                                          </div>
                                          <div class="callout callout-success">
                                                <h4>Projeto C</h4>
                                                <p>Descrição</p>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            {{-- Fim Row: Projetos(Pendentes, Em andamento, Concluidos)--}}
            
            {{-- Row: Projetos por Departamento --}}
            <div class="row">
                  <div class="col-md-12">
                        <div class="row">
                              <div class="col-md-12">
                                    <h2>Projetos por Departamento</h2>
                                    <div class="col-md-4">
                                          <div class="projDepCard">
                                                <div class="card">
                                                      <div class="card-body">
                                                            <h4 style="text-align: center;"><b> Departamento - TI</b></h4>
                                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <a href="#" class="btn btn-primary">Button</a>
                                                            </div>
                                                      </div>
                                                </div>
                                                <br>
                                          </div>
                                          <div class="col-md-4">
                                                <div class="projDepCard">
                                                      <div class="card">
                                                            <div class="card-body">
                                                                  <h4 style="text-align: center;"><b> Departamento - MKT</b></h4>
                                                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                  <a href="#" class="btn btn-primary">Button</a>
                                                            </div>
                                                      </div>
                                                </div>
                                                <br>
                                          </div>
                                          <div class="col-md-4">
                                                <div class="projDepCard">
                                                      <div class="card">
                                                            <div class="card-body">
                                                                  <h4 style="text-align: center;"><b> Departamento - GEP</b></h4>
                                                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                  <a href="#" class="btn btn-primary">Button</a>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            {{-- Fim Row: Projetos por Departamento --}}
      </div>
</div>

{{-- script necessário para popup da imagem --}}
<script src="http://static.tumblr.com/xz44nnc/o5lkyivqw/jquery-1.3.2.min.js"></script>

<script>
      //script para popup da imagem da empresa
      $('img.zoomable').css({cursor: 'pointer'}).live('click', function () {
            var img = $(this);
            var bigImg = $('<img />').css({
                  'max-width': '100%',
                  'max-height': '100%',
                  'display': 'inline'
            });
            bigImg.attr({
                  src: img.attr('src'),
                  alt: img.attr('alt'),
                  title: img.attr('title')
            });

            var over = $('<div />').text(' ').css({
                  'height': '100%',
                  'width': '100%',
                  'background': 'rgba(0,0,0,.82)',
                  'position': 'fixed',
                  'top': 0,
                  'left': 0,
                  'opacity': 0.0,
                  'cursor': 'pointer',
                  'z-index': 9999,
                  'text-align': 'center'
            }).append(bigImg).bind('click', function () {
            $(this).fadeOut(300, function () {
                  $(this).remove();
            });
            }).insertAfter(this).animate({
                  'opacity': 1
            },300);
            });
</script>
@stop
