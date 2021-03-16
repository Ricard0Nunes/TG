@extends('adminlte::page') 

@section('Chat ', 'Chat')

@section('content')
<style>/*---------chat window---------------*/

    .inbox_people {
        background: #fff;
        float: left;
        overflow: auto;
        width: 30%;
        border-right: 1px solid #ddd;
    }
    
    .inbox_msg {
        border: 1px solid #ddd;
        clear: both;
        overflow: hidden;
    }
    
    .top_spac {
        margin: 20px 0 0;
    }
    
    .recent_heading {
        float: left;
        width: 40%;
    }
    
    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%;
        padding:
    }
    
    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }
    
    .recent_heading h4 {
        color: #0465ac;
        font-size: 16px;
        margin: auto;
        line-height: 29px;
    }
    
    .srch_bar input {
        outline: none;
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }
    
    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }
    
    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }
    
    .chat_ib h5 {
        font-size: 15px;
        color: #464646;
        margin: 0 0 8px 0;
    }
    
    .chat_ib h5 span {
        font-size: 13px;
        /* float: left !important; */
    }
    
    .chat_ib p {
        font-size: 12px;
        color: #989898;
        margin: auto;
        /* display: inline-block; */
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
   
    
    .chat_ib {
        float: left!important;
        padding: 0 0 0 10px;
  
    }
    
    .chat_people {
        overflow: hidden;
        clear: both;
    }
    
    .chat_list {
        border-bottom: 1px solid #ddd;
        margin: 0;
        padding: 18px 16px 10px;
    }
    
    .inbox_chat {
        height: 550px;
        overflow-y: scroll;
    }
    #projetos{
        height: 550px;
        overflow-y: scroll;
    }
    .active_chat {
        background: #e8f6ff;
        
    }
    
    .incoming_msg_img {
        display: inline-block;
        width: 6%;
    }
    
    .incoming_msg_img img {
        width: 100%;
    }
    
    .received_msg {
        display: inline-block;
        padding: 0 0 0 10px;
        vertical-align: top;
        width: 92%;
    }
    
    .received_withd_msg p {
        background: #ebebeb none repeat scroll 0 0;
        border-radius: 0 15px 15px 15px;
        color: #646464;
        font-size: 14px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }
    
    .time_date {
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;
    }
    
    .received_withd_msg {
        width: 57%;
    }
    
    .mesgs{
        float: left;
        padding: 30px 15px 0 25px;
        width:70%;
    }
    
    .sent_msg p {
        background:#40a431;
        border-radius: 12px 15px 15px 0;
        font-size: 14px;
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }
    
    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }
    
    .sent_msg {
        float: right;
        width: 46%;
    }
    
    .input_msg_write input {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        color: #4c4c4c;
        font-size: 15px;
        min-height: 48px;
        width: 100%;
        outline:none;
    }
    
    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }
    
    .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border:none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 15px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
    }
    
    .messaging {
        padding: 0 0 50px 0;
    }
    
    .msg_history {
        height: 516px;
        overflow-y:scroll;
        
    }
    
#tabs.active{
                    border-top:3px solid #00a65a !important;
                }
                .dataTables_filter {
   float: left !important;
}         
                
                </style>
            


<!------ Include the above in your HEAD tag ---------->


<body>

<div class="messaging">
  <div class="inbox_msg">
	<div class="inbox_people">
	  
	
                <div class="nav-tabs-custom" >
                        <ul class="nav nav-tabs">
                <li id="tabs" class="active"><a href="#mensagens" data-toggle="tab" aria-expanded="true">Mensagens</a></li>
                <li id="tabs" class=""><a href="#projetos" data-toggle="tab" aria-expanded="false">Mensagens de Grupo</a></li>
                <li id="tabs" class=""><a href="#online" data-toggle="tab" aria-expanded="false">Utilizadores ({{count($users)}})</a></li>

     
	<ul>
    </div>

{{-- caixas de mensagem --}}
  <div class="tab-content">
      <div id="mensagens" class="tab-pane active ">
       
      <div class="inbox_chat scroll">
          @for ($i = 0; $i < count($caixaentrada); $i++)
          {!! Form::open(array('route' => 'chat.mensagem','method'=>'POST','files'=>'true')) !!}                      
          <button type="submit"  style="background-color: transparent; border:0px solid black; width:100% !important;" name='id' value={{$caixaentrada[$i]->pk_caixaEntrada}}> 
            <input id="invisible_id" name="grupo" type="hidden"  value="0"}>
          <div class="hidden">
            {{$countsms=count(DB::table('mensagens')->where('caixa',$caixaentrada[$i]->pk_caixaEntrada)->where('remetente','<>',auth::id())->where('lido',0)->orderBy('created_at')->get())}}
            {{$lastmensage= count(DB::table('mensagens')->where('caixa',$caixaentrada[$i]->pk_caixaEntrada)->where('remetente','<>',auth::id())->get())}}
          </div>

          @if ($caixaentradaselecionada==$caixaentrada[$i]->pk_caixaEntrada)
                  <div class="chat_list active_chat">
                    @else
                    <div class="chat_list ">
                        
                @endif
              <div class="chat_people">
                @if ($caixaentrada[$i]->destinatario!=auth::id())
                <div > <img class="img-circle img-sm" src={{DB::table('users')->where('id',$caixaentrada[$i]->destinatario)->value('foto')}} alt="sunil"> </div>
                <div class="chat_ib pull-left ">
                    <h5 style="position:relative!important; left:0px!important"> {{DB::table('users')->where('id',$caixaentrada[$i]->destinatario)->value('name')}}
                        ({{DB::table('users')->where('id',$caixaentrada[$i]->destinatario)->value('sigla')}})
                    
                        <div class="pull-right">
                                            
                                                
                            @if ($countsms>0)
                                
                            <span data-toggle="tooltip" title=" " class="badge bg-green ">{{$countsms}}
                                </span>
                            @endif
            
                        </div>
                                                                     
                    </h5>
                    <div class="hidden">
                        {{$ultimamensagem1=  DB::table('mensagens')->where('caixa',$caixaentrada[$i]->pk_caixaEntrada)->orderBy('created_at','DESC')->value('mensagem')}}       

                    </div>


                    @if(strlen($ultimamensagem1)>40)
                         <p style="text-align: !important"> {{substr($ultimamensagem1, 0, 10).' '.'...'}}</p> 
                      @else
                        <p style="text-align: !important">{{$ultimamensagem1}}</p> 
                     @endif  

                </div>
      
                @else
                <div class="  "> <img  class="img-circle img-sm" src={{DB::table('users')->where('id',$caixaentrada[$i]->proprietario)->value('foto')}} alt="sunil"> </div>
                <div class="chat_ib">
                    <h5 style="position:relative!important; left:0px!important">  {{DB::table('users')->where('id',$caixaentrada[$i]->proprietario)->value('name')}}
                        ({{DB::table('users')->where('id',$caixaentrada[$i]->proprietario)->value('sigla')}})

                        <div class="pull-right">
                                        
                                              
                            @if ($countsms>0)
                                
                            <span data-toggle="tooltip" title=" " class="badge bg-green ">{{$countsms}}
                                </span>
                            @endif
                
                            </div>
                                                
                        </h5>
                        <div class="hidden">
                             <p>{{$ultimamensagem=  DB::table('mensagens')->where('caixa',$caixaentrada[$i]->pk_caixaEntrada)->orderBy('created_at','DESC')->value('mensagem')}}        </p>
                      </div>
                    @if(strlen($ultimamensagem)>40)
                        <p style="text-align: !important"> {{substr($ultimamensagem, 0, 10).' '.'...'}}</p> 
                    @else
                        <p style="text-align: !important">{{$ultimamensagem}}</p> 
                    @endif

                </div>
            
                @endif
              
                </div>
              </div>
              {!! Form::close()!!}
      @endfor
      
      
    
    
    
      </div>
    </div>
    {{-- users online --}}
  <div id="online" class="tab-pane  " style="        overflow-y: scroll;height: 550px; ">


      @foreach ($users as $users)
           
                
      {!! Form::open(array('route' => 'chat.nova','method'=>'POST','files'=>'true','style'=>'display:inline-block')) !!}
          
          
              
              <button type="submit"  style="background-color: transparent; border:0px solid black; padding-bottom:10px;" name='id' value={{$users->id}}> 
                  <img class="img-circle img-sm" src={{$users->foto}} alt="User Image">
                  &nbsp;
                  <div class="comment-text pull-right">
                          <span class="username">
                              {{$users->name}}
                  (  {{$users->sigla}})


                  @if ($users->status==1)
                 <small> <i class="fa fa-circle text-success"></i></small>
                  @endif
                          </span>
              



                  </div> 
              </button>
      
              {!! Form::close()!!}
              <br>


@endforeach


      </div>
  <div id="projetos" class="tab-pane  ">

                        <table id="msg" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
            
                                    <th class="text-center">Mensagens Projeto</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                        @for ($g = 0; $g < count($caixaentradagrupo); $g++)
                    
                        <tr id="tr">
                            
                            <td class="text-justify">
                                {!! Form::open(array('route' => 'chat.mensagem','method'=>'POST','files'=>'true')) !!}                      
                            <button type="submit"  style="background-color: transparent; border:0px solid black; width:100% !important;" name='id' value={{$caixaentradagrupo[$g]->pk_caixaEntradaGrupo}}>
                                 <input id="invisible_id" name="grupo" type="hidden"  value="1"}>


                            <div class="  "> <img  class="img-circle img-sm" src={{DB::table('users')->where('id',12)->value('foto')}} alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5 style="position:relative!important; left:0px!important">  {{$caixaentradagrupo[$g]->titulo}}
            
                                    <div class="pull-right">
                                                    
                                                          
                                        @if (1>0)
                                            
                                        <span data-toggle="tooltip" title=" " class="badge bg-green ">1
                                            </span>
                                        @endif
                            
                                        </div>
                                                            
                                    </h5>
                                    <div class="hidden">
                                         <p>{{$ultimamensagem=  DB::table('mensagens')->where('caixa',$caixaentrada[1]->pk_caixaEntrada)->orderBy('created_at','DESC')->value('mensagem')}}        </p>
                                  </div>
                                @if(strlen($ultimamensagem)>40)
                                    <p style="text-align: !important"> {{substr($ultimamensagem, 0, 10).' '.'...'}}</p> 
                                @else
                                    <p style="text-align: !important">{{$ultimamensagem}}</p> 
                                @endif
            
                            </div>






                            {!! Form::close()!!}
                         </td>
                       
                        </tr>
                     

                        @endfor
            
                        </tbody>
                        </table>



  </div>

  </div>
</div>


{{-- area de mensagens  --}}
	<div class="mesgs" style="background-color:#fffff !important;">
     
	  <div class="msg_history" id="message">
        @if ( $caixaentradaselecionada>0)

        @for ($i = 0; $i < count($mensagens); $i++)
        @if ($mensagens[$i]->remetente!=auth::id())
		<div class="incoming_msg">
		  <div class="incoming_msg_img"> <img class="img-circle img-sm" src="{{DB::table('users')->where('id',$mensagens[$i]->remetente)->value('foto')}}" alt="sunil"> </div>
		  <div class="received_msg">
			<div class="received_withd_msg">
			  <p> {{$mensagens[$i]->mensagem}} </p>
        <span class="time_date" > {{$mensagens[$i]->created_at}}  </span>
      </div>
		  </div>
    </div>
    @else 
		<div class="outgoing_msg">
		  <div class="sent_msg">
			<p> {{$mensagens[$i]->mensagem}} </p>
			<span class="time_date"> @if ($mensagens[$i]->lido==0)
          <small class="direct-chat-timestamp pull-left text-aqua"> Entregue : {{$mensagens[$i]->updated_at}}</small>
          @else
          <small class="direct-chat-timestamp pull-left text-green"> Lido : {{$mensagens[$i]->updated_at}}</small>
          @endif
        
      </span> </div>
    </div>
    @endif
    @endfor
    @endif
    </div>
  <script>
  var chatHistory = document.getElementById("message");
    chatHistory.scrollTop = chatHistory.scrollHeight;
    </script>
	  <div class="type_msg">
		<div class="input_msg_write">

        <div class="row">
            <div class=" col-md-11 col-xs-12">
                    @if ( $caixaentradaselecionada>0)
        {!! Form::open(array('route' => 'chat.enviar','method'=>'POST','files'=>'true','style'=>'display:inline-block; width:100%!important;')) !!}
        {!! Form::text('mensagem',null,['class'=>'form-control','placeholder'=>'Escreva a sua mensagem...','style'=>'display:inline-block;']) !!}
       </div>
                         <div class="col-md-1 col-xs-12">
                            <span style=" display: inline;">
                        
                                    <a href="" > <input id="invisible_id"  name="de" type="hidden" value={{auth::id()}}>

                                        <input id="invisible_id"  name="caixa" type="hidden" value={{$caixaentradaselecionada}}>
                                        <input id="invisible_id" name="grupo" type="hidden"  value={{$grupo}}>

                                       
                                                      <button class="pull-right"style="padding-top:20px !important;background-color:transparent !important; border:0px solid transparent !important; color:#939393"type="submit" > <strong>Enviar</strong></button></a>  
      
              
                        
                            {!! Form::close()!!}
                            </span>
                            @endif
                          </div>
                        </div>

		  
		 
		</div>
	  </div>
	</div>
  </div>
</div>

</body>






 

@stop