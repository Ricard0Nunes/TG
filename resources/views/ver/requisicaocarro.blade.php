@extends('adminlte::page')
@section('Requisição', 'AdminLTE')
<script src="{{ asset('https://code.jquery.com/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') }}"></script>
<script></script>
<style>.progress-tracker{display:-webkit-box;display:-ms-flexbox;padding:0;list-style:none}.progress-step{-webkit-box-flex:1;-ms-flex:1 1 0%;flex:1 1 0%;margin:0;padding:0;min-width:24px}.progress-step:last-child{-webkit-box-flex:0;-ms-flex-positive:0;flex-grow:0}.progress-step:last-child .progress-marker::after{display:none}.progress-link{display:block;position:relative}.progress-marker{display:block;position:relative}.progress-marker::before{content:attr(data-text);display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;position:relative;z-index:20;width:24px;height:24px;border-radius:50%;-webkit-transition:background-color,border-color;transition:background-color,border-color;-webkit-transition-duration:0.3s;transition-duration:0.3s}.progress-marker::after{content:'';display:block;position:absolute;z-index:-10;top:10px;right:-12px;width:100%;height:4px;-webkit-transition:background-color 0.3s,background-position 0.3s;transition:background-color 0.3s,background-position 0.3s}.progress-text{display:block;overflow:hidden;text-overflow:ellipsis}.progress-title{margin-top:0}.progress-step .progress-marker{color:#fff}.progress-step .progress-marker::before{background-color:#b6b6b6}.progress-step .progress-marker::after{background-color:#b6b6b6}.progress-step .progress-text{color:#333}.progress-step.is-active .progress-marker::before{background-color:#2196F3}.progress-step.is-complete .progress-marker::before,.progress-step.is-progress .progress-marker::before{background-color:#40a431}.progress-step.is-complete .progress-marker::after,.progress-step.is-progress .progress-marker::after{background-color:#40a431}.progress-step.is-progress-10 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(10%,#868686),color-stop(10%,#b6b6b6));background-image:linear-gradient(to right,#868686 10%,#b6b6b6 10%)}.progress-step.is-progress-20 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(20%,#868686),color-stop(20%,#b6b6b6));background-image:linear-gradient(to right,#868686 20%,#b6b6b6 20%)}.progress-step.is-progress-30 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(30%,#868686),color-stop(30%,#b6b6b6));background-image:linear-gradient(to right,#868686 30%,#b6b6b6 30%)}.progress-step.is-progress-40 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(40%,#868686),color-stop(40%,#b6b6b6));background-image:linear-gradient(to right,#868686 40%,#b6b6b6 40%)}.progress-step.is-progress-50 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(50%,#868686),color-stop(50%,#b6b6b6));background-image:linear-gradient(to right,#868686 50%,#b6b6b6 50%)}.progress-step.is-progress-60 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(60%,#868686),color-stop(60%,#b6b6b6));background-image:linear-gradient(to right,#868686 60%,#b6b6b6 60%)}.progress-step.is-progress-70 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(70%,#868686),color-stop(70%,#b6b6b6));background-image:linear-gradient(to right,#868686 70%,#b6b6b6 70%)}.progress-step.is-progress-80 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(80%,#868686),color-stop(80%,#b6b6b6));background-image:linear-gradient(to right,#868686 80%,#b6b6b6 80%)}.progress-step.is-progress-90 .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(90%,#868686),color-stop(90%,#b6b6b6));background-image:linear-gradient(to right,#868686 90%,#b6b6b6 90%)}.progress-step:hover .progress-marker::before{background-color:#40a431}.progress-tracker--text .progress-step:last-child,.progress-tracker--center .progress-step:last-child,.progress-tracker--right .progress-step:last-child{-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1}.progress-tracker--center{text-align:center}.progress-tracker--center .progress-marker::before,.progress-tracker--center .progress-text--dotted::before{margin-left:auto;margin-right:auto}.progress-tracker--center .progress-marker::after{right:-50%}.progress-tracker--right{text-align:right}.progress-tracker--right .progress-marker::before,.progress-tracker--right .progress-text--dotted::before{margin-left:auto}.progress-tracker--right .progress-marker::after{right:calc(-100% + 12px)}.progress-tracker--spaced .progress-marker::after{width:calc(100% - 40px);margin-left:20px;margin-right:20px}.progress-tracker--border{padding:4px;border:2px solid #333;border-radius:32px}.progress-tracker--theme-red .progress-step .progress-marker{color:#fff}.progress-tracker--theme-red .progress-step .progress-marker::before{background-color:#666}.progress-tracker--theme-red .progress-step .progress-marker::after{background-color:#666}.progress-tracker--theme-red .progress-step .progress-text{color:#333}.progress-tracker--theme-red .progress-step.is-active .progress-marker::before{background-color:#A62D24}.progress-tracker--theme-red .progress-step.is-complete .progress-marker::before{background-color:#40a431}.progress-tracker--theme-red .progress-step.is-complete .progress-marker::after{background-color:#333}.progress-tracker--theme-red .progress-step:hover .progress-marker::before{background-color:#DF7B74}.progress-text--dotted::before{content:'';display:block;width:12px;background-image:repeating-radial-gradient(circle at center 6px,#b6b6b6,#b6b6b6 5px,rgba(182,182,182,.5) 5.5px,rgba(182,182,182,.01) 6px,transparent 100%)}.progress-text--dotted-1::before{height:12px}.progress-text--dotted-2::before{height:30px}.progress-text--dotted-3::before{height:48px}.progress-text--dotted-4::before{height:66px}.progress-text--dotted-5::before{height:84px}.progress-text--dotted-6::before{height:102px}.progress-text--dotted-7::before{height:120px}.progress-text--dotted-8::before{height:138px}.progress-text--dotted-9::before{height:156px}.progress-text--dotted-10::before{height:174px}.progress-text--dotted-11::before{height:192px}.progress-text--dotted-12::before{height:210px}.progress-tracker--text-top .progress-text{}.progress-tracker--text-top .progress-marker{top:-24px}.progress-tracker--text-inline{overflow:hidden}.progress-tracker--text-inline .progress-step,.progress-tracker--text-inline .progress-marker{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.progress-tracker--text-inline .progress-marker{-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1}.progress-tracker--text-inline .progress-marker::after{top:auto}.progress-tracker--text-inline .progress-text{position:relative;z-index:30;max-width:70%;white-space:nowrap;padding-top:0;padding-bottom:0;background-color:#fff}.progress-tracker--text-inline .progress-marker .progress-text{display:inline-block}.progress-tracker--text-inline .progress-title{margin:0}.progress-tracker--square .progress-marker::before{border-radius:0}.progress-tracker--square .progress-marker::after{top:auto;bottom:0}@media (max-width:575px){.progress-tracker-wrapper{overflow-x:auto;-ms-scroll-snap-type:x proximity;scroll-snap-type:x proximity}.progress-tracker-wrapper .progress-step{min-width:50%;scroll-snap-align:start}}.progress-tracker--vertical{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.progress-tracker--vertical .progress-step{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto}.progress-tracker--vertical.progress-tracker--right .progress-step{-webkit-box-orient:horizontal;-webkit-box-direction:reverse;-ms-flex-direction:row-reverse;flex-direction:row-reverse}.progress-tracker--vertical .progress-marker::after{right:auto;top:12px;left:10px;width:4px;height:100%}.progress-tracker--vertical .progress-text{padding:0 12px 24px 12px}@-webkit-keyframes scale-up{from{opacity:1;-webkit-transform:translate(-50%,-50%) scale(0);transform:translate(-50%,-50%) scale(0)}to{opacity:0;-webkit-transform:translate(-50%,-50%) scale(1);transform:translate(-50%,-50%) scale(1)}}@keyframes scale-up{from{opacity:1;-webkit-transform:translate(-50%,-50%) scale(0);transform:translate(-50%,-50%) scale(0)}to{opacity:0;-webkit-transform:translate(-50%,-50%) scale(1);transform:translate(-50%,-50%) scale(1)}}.anim-ripple .progress-link::before,.anim-ripple-large .progress-link::before,.anim-ripple-splash .progress-link::before{content:"";display:block;width:24px;height:24px;position:absolute;top:12px;left:12px;z-index:30;background:rgba(0,0,0,.3);border-radius:50%;-webkit-transform:translate(-50%,-50%) scale(0);transform:translate(-50%,-50%) scale(0);visibility:hidden}.anim-ripple .progress-link:not(:active)::before,.anim-ripple-large .progress-link:not(:active)::before,.anim-ripple-splash .progress-link:not(:active)::before{-webkit-animation:scale-up 0.3s ease-out;animation:scale-up 0.3s ease-out}.anim-ripple .progress-link:focus::before,.anim-ripple-large .progress-link:focus::before,.anim-ripple-splash .progress-link:focus::before{visibility:visible}.anim-ripple.progress-tracker--center .progress-link::before,.anim-ripple.progress-tracker--center .progress-link::after,.progress-tracker--center .anim-ripple .progress-link::before,.progress-tracker--center .anim-ripple .progress-link::after,.anim-ripple-large.progress-tracker--center .progress-link::before,.anim-ripple-large.progress-tracker--center .progress-link::after,.progress-tracker--center .anim-ripple-large .progress-link::before,.progress-tracker--center .anim-ripple-large .progress-link::after,.anim-ripple-splash.progress-tracker--center .progress-link::before,.anim-ripple-splash.progress-tracker--center .progress-link::after,.progress-tracker--center .anim-ripple-splash .progress-link::before,.progress-tracker--center .anim-ripple-splash .progress-link::after,.anim-ripple-double.progress-tracker--center .progress-link::before,.anim-ripple-double.progress-tracker--center .progress-link::after,.progress-tracker--center .anim-ripple-double .progress-link::before,.progress-tracker--center .anim-ripple-double .progress-link::after{left:50%}.anim-ripple.progress-tracker--right .progress-link::before,.anim-ripple.progress-tracker--right .progress-link::after,.progress-tracker--right .anim-ripple .progress-link::before,.progress-tracker--right .anim-ripple .progress-link::after,.anim-ripple-large.progress-tracker--right .progress-link::before,.anim-ripple-large.progress-tracker--right .progress-link::after,.progress-tracker--right .anim-ripple-large .progress-link::before,.progress-tracker--right .anim-ripple-large .progress-link::after,.anim-ripple-splash.progress-tracker--right .progress-link::before,.anim-ripple-splash.progress-tracker--right .progress-link::after,.progress-tracker--right .anim-ripple-splash .progress-link::before,.progress-tracker--right .anim-ripple-splash .progress-link::after,.anim-ripple-double.progress-tracker--right .progress-link::before,.anim-ripple-double.progress-tracker--right .progress-link::after,.progress-tracker--right .anim-ripple-double .progress-link::before,.progress-tracker--right .anim-ripple-double .progress-link::after{left:calc(100% - 12px)}.anim-ripple-splash .progress-link::before{width:48px;height:48px;-webkit-box-shadow:0 0 6px 6px rgba(0,0,0,.35);box-shadow:0 0 6px 6px rgba(0,0,0,.35)}.anim-ripple-double .progress-link::before,.anim-ripple-double .progress-link::after{content:"";display:block;width:24px;height:24px;position:absolute;top:12px;left:12px;z-index:30;background:rgba(0,0,0,.3);border-radius:50%;-webkit-transform:translate(-50%,-50%) scale(0);transform:translate(-50%,-50%) scale(0);visibility:hidden;background:none;border:3px solid rgba(0,0,0,.3)}.anim-ripple-double .progress-link:not(:active)::before,.anim-ripple-double .progress-link:not(:active)::after{-webkit-animation:scale-up 0.3s ease-out 0s;animation:scale-up 0.3s ease-out 0s}.anim-ripple-double .progress-link:not(:active)::after{-webkit-animation-delay:0.15s;animation-delay:0.15s}.anim-ripple-double .progress-link:focus::before,.anim-ripple-double .progress-link:focus::after{visibility:visible}.anim--large .progress-link::before,.anim--large .progress-link::after{width:48px;height:48px}.anim--path .progress-marker::after{background-image:-webkit-gradient(linear,left top,right top,color-stop(50%,#b6b6b6),color-stop(50%,#868686));background-image:linear-gradient(to right,#b6b6b6 50%,#868686 50%);background-size:200% 100%;background-position:0% 100%;-webkit-transition:background-position 0.3s ease-out;transition:background-position 0.3s ease-out}.progress-step.is-complete .anim--path .progress-marker::after{background-position:-100% 100%}.anim--path .progress-step.is-complete .progress-marker::after{background-position:-100% 100%}[dir="rtl"] .progress-marker::after{right:auto;left:-12px}[dir="rtl"] .progress-tracker--center .progress-marker::after{left:-50%}</style>
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <div class="row">
                  <div class="col-md-2 col-sm-12">
                        <h3 class="box-title">REQUISIÇÃO CARRO:</h3> 
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                  @if(Session::has('success'))
                        <div class="alert alert-success">
                              {{ Session::get('success')}}
                        </div>
                  @elseif( Session::has('warning'))
                        <div class="alert alert-danger">
                              {{ Session::get('warning')}}
                        </div>
                  @endif 
            </div>
      </div>
      <div class="box-body">
            <div class="row">
                  <div class="col-md-2 col-sm-12">
                        <h3 class="box-title">
                              <i class="far fa-calendar-alt"></i> <small>{{$requisicao->dataPartida}} </small>
                        </h3>
                  </div>
                  <div class="col-md-4 col-sm-12">
                        <h3 class="box-title">
                              <i class="fas fa-car"></i> <small>{{$veiculo->descricao}}</small> 
                        </h3>
                  </div>
                  <div class="col-md-3 col-sm-12">
                        <h3 class="box-title">
                              <i class="far fa-clock"></i>
                              @if ($requisicao->horaPartida==null)
                              <small> {{$requisicao->partidaPrevista}}h -  {{$requisicao->chegadaPrevista}}h (prevista)</small>
                              @else
                              <small>  {{$requisicao->horaPartida}}  h -  {{$requisicao->horaChegada}}h</small>
                              @endif 
                        </h3>
                  </div>
                  <div class="col-md-3 col-sm-12">  
                        <h3 class="box-title">            
                              <i class="fas fa-route pull_right"></i> <small>{{$requisicao->rota}}</small>
                        </h3>
                  </div>
            </div>
      </div>
</div>
<div class="row">
      <div class="col-md-4 col-sm-12">
            <div class="box box-success">
                  <div class="box-body">
                        <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                          <h4> 
                                                <i class="fas fa-id-card-alt"></i> Requisitado por:
                                                <br>
                                                <br>
                                                <small>{{$user[0]->nome}}</small>
                                          </h4>
                                    </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-md-12 col-sm-12">
                                    <h4>
                                          <i class="fas fa-users"></i> Ocupantes: 
                                          <br>
                                          <br>
                                          @foreach (explode( ',',$requisicao->ocupantes) as $string)
                                           <small>-  {{DB::connection('geraltg')->table('userscomuns')->where('BI',$string)->value('nome')}}</small> <br>
                                          @endforeach
                                    </h4>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-md-12 col-sm-12">
                                    <h4>
                                          <i class="fas fa-id-card-alt"></i>  Projetos envolvidos:
                                          <br>
                                          <br>
                                         <small>Empresa | Projeto (Cliente) | Sprint</small>  <br><br>
                                          @foreach ($custosextra as $motivo)
                                               <small> -  {{$motivo->nomeAbreviado}} | {{$motivo->nomeProjeto}}| {{$motivo->nomeSprint}}  </small>
                                                <br>
                                          @endforeach                                            
                                    </h4>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                          {!! Form::label('notas','Notas :') !!}
                                          <div class="">
                                                {!! Form::textarea('notas',$requisicao->notas,['class'=>'form-control','rows'=>4]) !!}
                                                {!! $errors->first('notas','<p class="alert alert-danger">:message</p>')!!}
                                
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>   
      </div>   
    
      <div class="hidden">
            @if ($requisicao->requisitadoPor==auth()->user()->bi)
                {{$readonly = null}}
            @else
            {{$readonly = 'readonly'}}

            @endif
            @if ($requisicao->validado==0)
            {{$readonly = 'readonly'}}
            @endif

            @if ($requisicao->localPartida==null or $requisicao->horaPartida==null or $requisicao->kmIniciais==null  )
            {{$partidaV = "progress-step"}}
            {{$collapsedP = "box box-success "}}
      
            @else
            {{$partidaV = "progress-step is-complete"}}
            {{$collapsedP = "box box-success collapsed-box"}}


            @endif

            @if ($requisicao->localChegada==null or $requisicao->horaChegada==null or $requisicao->kmFinais==null  )
            {{$chegadaV = "progress-step"}}
            {{$collapsedC = "box box-success "}}
            @else
            {{$chegadaV = "progress-step is-complete"}}
            {{$collapsedC = "box box-success collapsed-box"}}

            @endif

            @if ($requisicao->gastosCombustivel==null or $requisicao->gastosPortagens==null or $requisicao->gastosEstacionamento==null  or $requisicao->gastosOutros==null )
            {{$gastosV = "progress-step"}}
            {{$collapsedG = "box box-success "}}
            @else
            {{$gastosV = "progress-step is-complete"}}
            {{$collapsedG = "box box-success collapsed-box"}}

            @endif



      </div>
    
     <div class="col-md-8 col-sm-12">
             <div class="{{$collapsedP}}">
                  <div class="box-header with-border " >
                        <h3 class="box-title">
                              <ul class="progress-tracker progress-tracker--vertical" style="margin-bottom:0px!important;padding-bottom:5px!important;height:20px!important;">
                                    <li class="{{$partidaV}}">
                                          <div class="progress-marker "></div>
                                          <div class="progress-text">
                                                <h4 class="progress-title">Partida</h4>   
                                          </div>
                                    </li>
                              </ul>
                        </h3>
                        <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                        </div>
                  </div>
                  <div class="box-body" >
                        <div class="box" style="border-top:0px solid black!important;">
                              <div class="box-body">
                                    {!! Form::open(array('route' => 'requisicaocarro.partida','method'=>'POST','files'=>'true')) !!}
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                      @if(Session::has('success'))
                                                            <div class="alert alert-success">
                                                                  {{ Session::get('success')}}
                                                            </div>
                                                      @elseif( Session::has('warning'))
                                                            <div class="alert alert-danger">
                                                                  {{ Session::get('warning')}}
                                                            </div>
                                                      @endif 
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('localPartida','Local Partida* :') !!}
                                                            {!! Form::text('localPartida',$requisicao->localPartida,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('localPartida','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>         
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('partidaPrevista','Hora de Partida') !!}
                                                            {!! Form::time('partidaPrevista',$requisicao->horaPartida,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('partidaPrevista','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('kmsIniciais','Kms Iniciais') !!}
                                                            {!! Form::text('kmsIniciais',$requisicao->kmIniciais,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            <input id="aaa" name="id" type="hidden" value={{$requisicao->pk_requisicao}}>

                                                            {!! $errors->first('kmsIniciais','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                          </div> 
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4" ></div>
                                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                                      <a href="" >
                                                            @if ($readonly==null )                                                      
                                                                  <button type="submit" class="btn btn-block btn-success btn-flat">
                                                                        Enviar
                                                                  </button>                                                                                                                       
                                                            @endif
                                                           
                                                      </a>
                                                </div>
                                          </div>
                                    {!! Form::close()!!}
                              </div>
                        </div>
                  </div>
            </div>
            <div class="{{$collapsedC}}">
                  <div class="box-header with-border " >
                        <h3 class="box-title">
                              <ul class="progress-tracker progress-tracker--vertical" style="margin-bottom:0px!important;padding-bottom:5px!important;height:20px!important;">
                                    <li class="{{$chegadaV}}">
                                          <div class="progress-marker "></div>
                                          <div class="progress-text">
                                                <h4 class="progress-title">Chegada</h4>
                                          </div>
                                    </li>
                              </ul>
                        </h3>
                        <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                        </div>
                  </div>



                  <div class="box-body">
                        <div class="box" style="border-top:0px solid black!important;">
                           
                              <div class="box-body">
                                    {!! Form::open(array('route' => 'requisicaocarro.chegada','method'=>'POST','files'=>'true')) !!}
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                      @if(Session::has('success'))
                                                            <div class="alert alert-success">
                                                                  {{ Session::get('success')}}
                                                            </div>
                                                      @elseif( Session::has('warning'))
                                                            <div class="alert alert-danger">
                                                                  {{ Session::get('warning')}}
                                                            </div>
                                                      @endif 
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('localChegada','Local Chegada* :') !!}
                                                            {!! Form::text('localChegada',$requisicao->localChegada,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('localChegada','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>         
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('chegadaPrevista','Hora de Chegada') !!}
                                                            {!! Form::time('chegadaPrevista',$requisicao->horaChegada,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('chegadaPrevista','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                      <div class="form-group">
                                                            {!! Form::label('kmsFinais','Kms Finais') !!}
                                                            {!! Form::text('kmsFinais',$requisicao->kmFinais,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            <input id="aaa" name="id" type="hidden" value={{$requisicao->pk_requisicao}}>
                                                            {!! $errors->first('kmsFinais','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                          </div> 
                                          <div class="row" align="center">
                                                <div class="col-xs-12 col-sm-12 col-md-4" ></div>
                                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                                      <a href="" >
                                                            @if ($readonly==null)
                                                            <button type="submit" class="btn btn-block btn-success btn-flat" >
                                                                  Enviar
                                                            </button>

                                                            
                                                            @endif
                                                      </a>
                                                </div>
                                          </div>
                                    {!! Form::close()!!}
                              </div>
                        </div>
                  </div>
            </div>
            <div class="{{$collapsedG}}">
                  <div class="box-header with-border">
                        <h3 class="box-title">
                              <ul class="progress-tracker progress-tracker--vertical" style="margin-bottom:0px!important;padding-bottom:5px!important;height:20px!important;">
                                   <li class="{{$gastosV}}">
                                          <div class="progress-marker "></div>
                                          <div class="progress-text">
                                                <h4 class="progress-title">Registos</h4>
                                          </div>
                                    </li>
                              </ul>
                        </h3>
                        <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                        </div>
                  </div>
                  <div class="box-body">
                       
                        <div class="box" style="border-top:0px solid black!important;">
                             
                              <div class="box-body">
                                    {!! Form::open(array('route' => 'requisicaocarro.registos','method'=>'POST','files'=>'true')) !!}
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('kmtotais','Kms Totais (*)') !!}
                                                            {!! Form::text('kmtotais',$requisicao->kmtotal,['class'=>'form-control', 'readonly']) !!}
                                                            {!! $errors->first('kmtotais','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>         
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('autonomia','Autonomia (*)') !!}
                                                            {!! Form::text('autonomia',$requisicao->autonomiaFinal,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('autonomia','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('portagens','Portagens (*)') !!}
                                                            {!! Form::text('portagens',$requisicao->gastosPortagens,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('portagens','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>         
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('gasolina','Combustível (*)') !!}
                                                            {!! Form::text('gasolina',$requisicao->gastosCombustivel,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('gasolina','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('estacionamento','Estacionamento (*)') !!}
                                                            {!! Form::text('estacionamento',$requisicao->gastosEstacionamento,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            {!! $errors->first('estacionamento','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                      <div class="form-group">
                                                            {!! Form::label('outros','Outros (*)') !!}
                                                            {!! Form::text('outros',$requisicao->gastosOutros,['class'=>'form-control','required'=>'required', $readonly]) !!}
                                                            <input id="aaa" name="id" type="hidden" value={{$requisicao->pk_requisicao}}>
                                                            {!! $errors->first('outros','<p class="alert alert-danger">:message</p>')!!}
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row" align="center">
                                                <div class="col-xs-12 col-sm-12 col-md-4" ></div>
                                                <div class="col-xs-12 col-sm-12 col-md-2" >
                                                      <a href="" >
                                                            @if ($readonly==null)
                                                            <button type="submit" class="btn btn-block btn-success btn-flat">
                                                                  Enviar
                                                            </button>
                                                            @endif
                                                      </a>
                                                </div>
                                          </div>
                                    {!! Form::close()!!}      
                              </div>
                        </div>
                  </div>
            </div>
      </div>   
</div>   
@stop
