@extends('admin.layouts.main')
@section('content')
<div class="container">
<div class="row form">
    <div class="col-xs-6">
        <h2>Editar Registro</h2>
    </div>
    <div class="col-xs-5 text-right">
        {{ link_to_route ('admins.show', ' Volver', '', array('class'=> 'fa fa-arrow-left btn btn-warning', 'title'=>'click para volver')) }}
    </div>
</div>
    {{ Form::model($admin, array( 'class'=> 'form-horizontal', 'method' => 'PATCH', 'route' => array('admins.update', $admin->id ))) }}
        <?php $form_type = 'edit';?>
        @include('admin.admins.form')
    {{ Form::close() }}
</div>
@stop