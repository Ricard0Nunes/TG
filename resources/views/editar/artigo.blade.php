@extends('adminlte::page')
@section('Artigo', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">CRIAR UM ARTIGO</h3>
      </div>
      {!! Form::open(array('route' => ['artigo.update','id'=>$artigo->pk_artigo],'method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                        {!! Form::text('sku',$artigo->sku,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('sku','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                {!! Form::label('descricao','Descrição (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::text('descricao',$artigo->descricao,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('descricao','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('caracteristica','Características ',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('caracteristica',$artigo->caracteristicas,['class'=>'form-control']) !!}
                  {!! $errors->first('caracteristica','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      
 

      <div class="form-group">
            {!! Form::label('peso','Peso',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('peso',$artigo->peso,['class'=>'form-control']) !!}
                  {!! $errors->first('peso','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>

      <div class="form-group">
            {!! Form::label('preco','Preço (€)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('preco',$artigo->precoCompra,['class'=>'form-control']) !!}
                  {!! $errors->first('preco','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="form-group">
      {!! Form::label('fk_familiaArtigo','Família de Artigo (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">

            {!! Form::select('fk_familiaArtigo',$familiaartigo,$artigo->fk_familiaartigos,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha a família','required'=>'required']) !!}

            {!! $errors->first('fk_familiaArtigo','<p class="alert alert-danger">:message</p>')!!}
      </div> 
      </div>
      <div class="form-group">
      {!! Form::label('fk_iva','IVA (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">

            {!! Form::select('fk_iva',$iva,$artigo->fk_iva,['class'=>'form-control' ,'rows' => 1 ,'placeholder'=>'Escolha o Iva','required'=>'required']) !!}

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
      <div class="form-group">
            {!! Form::label('descontinuado','Descontinuado (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::select('descontinuado',array('0' => 'Não', '1' => 'Sim'),$artigo->descontinuado,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('descontinuado','<p class="alert alert-danger">:message</p>')!!}
            </div>
            
      </div>
      
      <div class="form-group">

      {!! Form::label('tipoartigo','Tipo de Artigo (*)',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-5">
            <div id="radioButtons">
                  @if ($artigo->tipoartigo==1)
                  <input type="radio" name="tipoartigo" id="radio_Sim" value="0" required checked >Artigo Simples  
                  @else
                  <input type="radio" name="tipoartigo" id="radio_Sim" value="0" required  >Artigo Simples
                  @endif
                  <br>
                  @if ($artigo->tipoartigo==2)
                  <input type="radio" name="tipoartigo" id="radio_Nao" value="1" required checked >Produção Própria
                  @else
                  <input type="radio" name="tipoartigo" id="radio_Nao" value="1" required >Produção Própria
                  @endif
                  <br>
                  @if ($artigo->tipoartigo==3)
                  <input type="radio" name="tipoartigo" id="radio_Nao" value="2" required  checked>Serviço
                  @else
                  <input type="radio" name="tipoartigo" id="radio_Nao" value="2" required >Serviço
                  
                  @endif


            </div>
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
@stop
