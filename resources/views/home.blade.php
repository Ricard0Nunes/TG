@if(count($empresa)==0)
<?php

header("Location: ".url('/setup'));

exit;
?>
@else

@extends('adminlte::page')

@section('title', 'TurtleGest')

@section('content_header')
<h1>Dashboard</h1>
@stop
@section('content')

       
          
                      



@stop
@endif