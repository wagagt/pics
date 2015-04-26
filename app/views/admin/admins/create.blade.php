@extends('admin.layouts.main')
@section('content')
<div class="container">
<div class="row form">
    <div class="col-xs-6">
        <h2>Agregar Registro</h2>
    </div>
    <div class="col-xs-5 text-right">
        {{ link_to_route ('admins.show', ' Volver', '', array('class'=> 'fa fa-arrow-left btn btn-warning', 'title'=>'click para volver')) }}
    </div>
</div>
<?php
	//myDump($data,1,1);
?>
{{ Form::open(array('route' => 'admins.store', 'class'=> 'form-horizontal', 'role'=>'form')) }}
    <?php 
    $form_type = 'create';
      ?>
     @include('admin.admins.form')
{{ Form::close() }}
</div>
        
@stop
