@section('content')
<!-- Swiper -->
<!-- Slider main container -->

<input type="hidden" id="panel_type" name="panel_type" value="<?php echo $params['type'];?>">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Panel de Control </h3>
                </div>
                <!-- /.col-lg-12 -->
        </div>
<?php
//var_dump($params);die();

?>
   <div class="panel panel-default">
        <div class="panel-heading" style="height:45px;">
            <div class="col-xs-4">
                <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $params['title'];?> 
                <div class="pull-right"></div>
            </div>
            <div class="col-xs-4">
                <p>
                    <a href="news"><button type="button" class="btn btn-outline btn-primary">Nuevos</button></a>
                    <a href="approved"><button type="button" class="btn btn-outline btn-success">Aprobados</button></a>
                    <a href="denied"><button type="button" class="btn btn-outline btn-danger">Denied</button></a>
                </p>
            </div>
            <div class="col-xs-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        Países
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="#">México</a>
                        </li>
                        <li><a href="#">Guatemala</a>
                        </li>
                        <li><a href="#">El Salvador</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">Todos los países</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            @include('admin.home.product-panel')
    </div>
</div>

@include('admin.home.modals')

@stop

@section('footer')
@parent
    {{ HTML::script('/ui/js/dashboard.js') }}
@show



