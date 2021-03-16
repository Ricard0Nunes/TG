@extends('adminlte::page')
@section('Artigo', 'AdminLTE')
@section('content')
<style>
        #hidden_div_famArtigos {
            display: none;
      }
</style>
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UM ARTIGO</h3>
      </div>
      {!! Form::open(array('route' => 'artigo.store','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
            <div class="form-group">
                  {!! Form::label('sku','SKU (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('sku',null,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('sku','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                {!! Form::label('descricao','Descrição (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::text('descricao',null,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('caracteristica','Características ',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('caracteristica',null,['class'=>'form-control']) !!}
                  {!! $errors->first('caracteristica','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
    
 

            <div class="form-group">
                  {!! Form::label('peso','Peso (Kg)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::text('peso',null,['class'=>'form-control']) !!}
                        {!! $errors->first('peso','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                  {!! Form::label('preco','Preço (€)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::number('preco',null,['class'=>'form-control', 'step'=>0.01]) !!}
                        {!! $errors->first('preco','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
<div class="form-group">
  {!! Form::label('fk_familiaArtigo','Família de Artigo (*)',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
      <select id=""required name="fk_familiaArtigo" class="form-control" onchange="showDivFamArtigos('hidden_div_famArtigos', this)">
            <option value="">Escolha a Família de Artigos</option>
            <option name="" value="novaFam">Nova Família</option>
            @foreach ($familiaartigo as $h)
                        <option value="{{$h->pk_familiaartigos}}">{{$h->descricao}}</option>
            @endforeach
      </select>        
      {{-- {!! Form::select('fk_familiaArtigo',$familiaartigo,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha a família','required'=>'required']) !!} --}}

           {!! $errors->first('fk_familiaArtigo','<p class="alert alert-danger">:message</p>')!!}
    </div> 
</div>




<div id="hidden_div_famArtigos">
      <div class="form-group">
            {!! Form::label('novaDescricao','Descrição (Nova Família)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('novaDescricao',null,['class'=>'form-control' ,'rows' => 1, 'placeholder'=>'Descrição da Família de Artigos' ]) !!}
            </div>
      </div> 
</div>

<div class="form-group">
      {!! Form::label('fk_iva','IVA (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">

            {!! Form::select('fk_iva',$iva,null,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Iva','required'=>'required']) !!}

            {!! $errors->first('fk_iva','<p class="alert alert-danger">:message</p>')!!}
      </div> 
      </div>













<div class="form-group">
      {!! Form::label('foto','Foto',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            {!! Form::file('foto',null,['class'=>'form-control']) !!}
            {!! $errors->first('foto','<p class="alert alert-danger">:message</p>')!!}
      </div>
</div>
{!! Form::label('tipoartigo','Tipo de Artigo (*)',['class'=>'col-sm-2 control-label']) !!}
<div class="col-sm-5">
      <div id="radioButtons">
            <input type="radio" name="tipoartigo" id="radio_Sim" value="0" required="" >Artigo Simples
            <br>
            <input type="radio" name="tipoartigo" id="radio_Nao" value="1" required >Produção Própria
            <br>
            <input type="radio" name="tipoartigo" id="radio_Nao" value="2" required >Serviço
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
      {!! Form::close()!!}
</div>
<script>
      function showDivFamArtigos(divId, element){
            document.getElementById(divId).style.display = element.value == 'novaFam' ? 'block' : 'none';
      }
</script>
@stop
