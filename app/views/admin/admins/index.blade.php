@extends('admin.layouts.main')
@section('content')

<?php
$admins = $data['admins'];
$roles = $data['rols'];
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="row panel panel-default " style="background-color:#f5f5f5">
                    <div class="panel-heading span4" style="float:left;height:70px;">
                        <h3>Listado de Administradores</h3>
                    </div>
                    <div class="panel-heading span4" style="float:right;height:70px;">
                        {{ link_to_route('admins.create', ' Agregar nuevo', array(),array('class' => 'fa fa-plus-circle btn btn-info','title'=>'click para agregar nuevo')) }}
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            @if ($admins->count())
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="table_data" aria-describedby="dataTables-example_info">
                                <thead>
                                    <tr>
                                        <th>Id.</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Status</th>
                                        <th>Ver</th>
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $reg)
                                    <?php  $faicon = ($reg->status) ? "fa fa-check-circle fa-3" : "fa fa-times-circle fa-3"; ?>
                                    <tr>
                                        <td> {{ $reg->id}} </td>
                                        <td> {{ $reg->name}} </td>
                                        <td> {{ $reg->email}} </td>
                                        <td> {{ $reg->rol}} </td>
                                        <td> <i class="{{$faicon}}"></i></td>
                                        <td> {{ link_to_route('admins.show', ' ', array($reg->id), array('class' => 'fa fa-eye btn btn-primary','title'=>'click para ver info')) }} </td>
                                        <td> {{ link_to_route('admins.edit', ' ', array($reg->id), array('class' => 'fa fa-pencil-square-o btn btn-info ', 'title'=>'click para editar')) }} </td>
                                        <td>
                                            {{ Form::open ( array('method' => 'DELETE', 'route' => array('admins.destroy', $reg->id))) }}
                                            {{ Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit',
                                                'class' => 'btn btn-danger', 
                                                'title' => 'click para eliminar',
                                                'onclick'=>'return confirm("Está seguro de eliminar el registro?" )'
                                                ))
                                                }}
                                            {{ Form::close() }}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <i class="fa fa-exclamation-circle"></i> No existen registros.
                            @endif
                        </div>        
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#table_data').DataTable({
        "autoWidth": false,
        "jQueryUI": true,
        /*"bPaginate": true,
        searching: false,
        ordering:  false*/
    });
} );
</script>

@stop