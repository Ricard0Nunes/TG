@extends('adminlte::page')
@section('Compra de Artigos', 'AdminLTE')
@section('content')
<div class="box box-success">
      <div class="box-header with-border">
            <h3 class="box-title">EDITAR UMA COMPRA DE ARTIGOS</h3>
      </div>
      {!! Form::open(array('route' => 'artigocompra.update','method'=>'POST','files'=>'true','class'=>'form-horizontal')) !!}
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
                  {!! Form::label('fk_compra','Compra (*)',['class'=>'col-sm-2 control-label']) !!}
                  <div class="col-sm-5">
                        {!! Form::select('fk_compra',$compra,$artigoscompra->fk_compra,['class'=>'form-control','required'=>'required']) !!}
                        {!! $errors->first('fk_compra','<p class="alert alert-danger">:message</p>')!!}
                  </div>
            </div>
            <div class="form-group">
                {!! Form::label('fk_artigo','Artigo (*)',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                      {!! Form::select('fk_artigo',$artigo,$artigoscompra->fk_artigo,['class'=>'form-control','required'=>'required']) !!}
                      {!! $errors->first('fk_artigo','<p class="alert alert-danger">:message</p>')!!}
                </div>
          </div>
          <div class="form-group">
            {!! Form::label('quantidade','Quantidade (*)',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                  {!! Form::text('quantidade',$artigoscompra->quantidade,['class'=>'form-control','required'=>'required']) !!}
                  {!! $errors->first('quantidade','<p class="alert alert-danger">:message</p>')!!}
            </div>
      </div>
      <div class="form-group">
        {!! Form::label('precouni','Preço Unitário (*)',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
              {!! Form::text('precouni',$artigoscompra->precouni,['class'=>'form-control','required'=>'required']) !!}
              {!! $errors->first('precouni','<p class="alert alert-danger">:message</p>')!!}
        </div>
  </div>
  <div class="form-group">
    {!! Form::label('precototal','Preço Total (*)',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
          {!! Form::text('precototal',$artigoscompra->precototal,['class'=>'form-control','required'=>'required']) !!}
          {!! $errors->first('precototal','<p class="alert alert-danger">:message</p>')!!}
    </div>
</div>
      </div>
      <div class="box-footer ">
            <button type="submit" class="btn btn-success pull-right">Enviar</button>
      </div>
      {!! Form::close()!!}
</div>
@stop
