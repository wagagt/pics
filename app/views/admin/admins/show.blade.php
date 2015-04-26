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
    <div id="show-form">
        <?php $form_type = 'show';?>
        @include('admin.admins.form')
    </div>
</div>

@section('footer')
@parent
<script>
    $("#show-form :input").attr("disabled", true);
</script>
@show
@stop