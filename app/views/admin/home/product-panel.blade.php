                    <!-- /.panel -->
                    <div class="panel panel-default panel-articles">
                        <div class="row show-grid panel">
                        <?php $i = 0; $ii=1;?>
                        @foreach ($products as $product)
                            
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 article-container">
                                <div class="row article-title">
                                    <div class="col-xs-12">
                                        <a href="" title="Clic para ver Información completa"
                                                    data-toggle="modal" 
                                                    data-target="#modalInfo" 
                                                    data-id="{{$product->id}}" >
                                            <h6 class="text-title">
                                                    {{$product->title}}<h6>
                                        </a>
                                    </div>        
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12 text-center image-article">
                                            <a data-target="myToggle-{{$product->id}}" class="hcaption" href="#" cap-effect="fade" >
                                                <img alt="{{$product->title}}" width="200" height="100" src="{{$product->filename}}">
                                            <div id="result-{{$product->id}}" class="result "></div>
                                            </a>
        
                                
                                        <div id="myToggle-{{$product->id}}" class="cap-overlay" > <!-- cap-overlay -->
                                                <a href="#" title="Usuario: {{$product->name}}" >
                                                    <h4><i class="fa fa-user"></i>&nbsp;{{$product->name}}</h4>
                                                </a>
                                            <hr width="75%">
                                                <div class="col-xs-6 article">
                                                    <h5><a href="#" title="{{$product->total_images}} imagenes disponibles.">
                                                        <i class="fa fa-file-image-o"></i>
                                                            {{$product->total_images}}
                                                        </a>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <a href="#" title="Estado: {{$product->active}}">
                                                            <i class="fa fa-check-circle"></i>
                                                            {{$product->active}}
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div class="col-xs-6 article">
                                                    <button class="btn btn-success btn-circle" type="button" 
                                                    data-toggle="modal" 
                                                    data-target="#modalApprove" 
                                                    data-id="{{$product->id}}" 
                                                    data-title="{{$product->title}}" 
                                                    data-user="{{$product->name}}" 
                                                    title="Aprobar">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-circle" type="button" 
                                                    data-toggle="modal" 
                                                    data-target="#modalDeny" 
                                                    data-id="{{$product->id}}" 
                                                    data-title="{{$product->title}}" 
                                                    data-user="{{$product->name}}" 
                                                    title="Denegar">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="" title="Clic para ver Información completa"
                                                    data-toggle="modal" 
                                                    data-target="#modalInfo" 
                                                    data-id="{{$product->id}}" >
                                                    <i class="fa fa-search"></i> Ver más
                                                </a>
                                             
                                             
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        <?php  $i++; ?>
                        @endforeach
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="row text-center">
                        <div class="col-xs-12 text-center"><h5>Total de productos <?php echo "<h4>".$i."</h4>"?><h5></div>        
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <?php echo $products->links(); ?>
                        </div>        
                    </div>