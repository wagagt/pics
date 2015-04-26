APPROVE Modal ( change status, add comment ) -->
        <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel">  <i class="fa fa-thumbs-o-up fa-3"></i> Aprobar Producto</h4>
                    </div>
                    <div class="modal-body">
                        
                    {{Form::open(array('id'=>'approve-form'))}}  
                        <div class="form-group">
                            <label>Usuario:</label>
                            <span id='modalApprove-article-user'> </span>
                        </div>
                        <div class="form-group">
                            <label>Título:</label>
                            <span id='modalApprove-article-title'> </span>
                        </div>

                        <div class="form-group">
                            <label>Comentario</label>
                            <textarea rows="3" class="form-control" id="comment" name="comment">Opcional.</textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" name="btn-approve" id="btn-approve" ><i class="fa fa-thumbs-o-up fa-3"></i>&nbsp;Aprobar</button>
                    </div>

                    <input type="hidden" id="product_id" name="product_id" value="">
                    {{Form::close()}}

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Modal -->

        <!-- DENY Modal ( change status, add comment ) -->
        <div class="modal fade" id="modalDeny" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-thumbs-o-down fa-3"></i> Denegar Producto</h4>
                    </div>
                    <div class="modal-body">
                        {{Form::open(array('id'=>'deny-form'))}}  
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Usuario:</label>
                                    <span id='modalDeny-article-user'> </span>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Razón:</label>
                                    <select id="reason" name="reason">
                                        <option value="0" data-text="Seleccione una razón. (requerido)">Seleccione opción</option>
                                    <?php 
                                        foreach ($reasons as $reason) { 
                                            //echo '<br>razon' . $reason->id;//var_dump($reason);
                                            ?>
                                            <option value="{{$reason->id}}" data-text="{{$reason->text}}">{{$reason->name}}</option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Título:</label>
                            <span id='modalDeny-article-title'> </span>
                        </div>

                        <div class="form-group">
                            <label>Comentario</label>
                            <textarea rows="3" class="form-control" id="comment" name="comment"> </textarea>
                        </div>

                        <div id="validate-message-error" name="validate-message-error" class="alert alert-danger hide">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <strong>Error!</strong> Debe seleccionar una razón y un comentario mayor a 15 caracteres.
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger" name="btn-deny" id="btn-deny" ><i class="fa fa-thumbs-o-down fa-3"></i>&nbsp; Denegar </button>
                    </div>

                    <input type="hidden" id="product_id" name="product_id" value="">
                    {{Form::close()}}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Modal -->

       <!-- FULL INFORMATION Modal ( show pictures ) -->
        <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog info">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel">  <i class="fa fa-info-circle"></i> Información del Producto</h4>
                    </div>
                    <div class="modal-body">
                        <!-- SWIPER CONTAINER -->
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <!-- SWIPER CONTAINER -->
                            <!-- PANEL GROUP -->
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseUser" aria-expanded="false" class="collapsed"><i class="fa fa-user"></i> Usuario</a>
                                        </h4>
                                    </div>
                                    <div id="collapseUser" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <!-- USER INFORMATION -->
                                           <div class="row" >
                                                <div class="col-xs-12 col-sm-6 col-md-3  form-group">
                                                    <label>Nombre:</label>
                                                    <span id='modalInfo-article-first_name'>  </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Apellido:</label>
                                                    <span id='modalInfo-article-last_name'>  </span>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Usuario:</label>
                                                    <span id='modalInfo-article-name'> </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Email:</label>
                                                    <span id='modalInfo-article-email'> </span>
                                                </div>
                                            </div>
                                           <div class="row" >
                                                <div class="col-xs-12 col-sm-6 col-md-3  form-group">
                                                    <label>Género:</label>
                                                    <span id='modalInfo-article-gender'>  </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Foto:</label>
                                                    <span id='modalInfo-article-picture'>  </span>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Creado en:</label>
                                                    <span id='modalInfo-article-created_at'> </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Estado:</label>
                                                    <span id='modalInfo-article-user_active'> </span>
                                                </div>
                                            </div>                                            
                                            <!-- USER INFORMATION -->
                                        </div>
                                    </div>
                                </div>
                                <!-- PANEL GROUP -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseProduct" class="collapsed" aria-expanded="false"> <i class="fa fa-dropbox"></i> Producto</a>
                                        </h4>
                                    </div>
                                    <div id="collapseProduct" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <!-- PRODUCT INFORMATION -->
                                           <div class="row" >
                                                <div class="col-xs-12 col-sm-6 col-md-3  form-group">
                                                    <label>Título:</label>
                                                    <span id='modalInfo-article-title'>  </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Descripción:</label>
                                                    <span id='modalInfo-article-description'>  </span>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Categoria:</label>
                                                    <span id='modalInfo-article-category_title'> </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Pais:</label>
                                                    <span id='modalInfo-article-country'> </span>
                                                </div>
                                            </div>
                                           <div class="row" >
                                                <div class="col-xs-12 col-sm-6 col-md-3  form-group">
                                                    <label>Moneda:</label>
                                                    <span id='modalInfo-article-symbol'>  </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Precio :</label>
                                                    <span id='modalInfo-article-price'>  </span>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Comentario:</label>
                                                    <span id='modalInfo-article-comment'> </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Ip:</label>
                                                    <span id='modalInfo-article-ip'> </span>
                                                </div>
                                            </div> 
                                           <div class="row" >
                                                <div class="col-xs-12 col-sm-6 col-md-3  form-group">
                                                    <label>Latitud:</label>
                                                    <span id='modalInfo-article-latitude'>  </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Longitude:</label>
                                                    <span id='modalInfo-article-longitude'>  </span>
                                                </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Creado en:</label>
                                                    <span id='modalInfo-article-product_created_at'> </span>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-3 form-group">
                                                    <label>Estado:</label>
                                                    <span id='modalInfo-article-product_active'> </span>
                                                </div>
                                            </div>                                             
                                            <!-- PRODUCT INFORMATION -->
                                        </div>
                                    </div>
                                </div>
                                <!-- PANEL GROUP -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseHistory" class="collapsed" aria-expanded="false"> <i class="fa fa-history"></i> Historial</a>
                                        </h4>
                                    </div>
                                    <div id="collapseHistory" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table" id="logTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Accion</th>
                                                                    <th>Razón</th>
                                                                    <th>Comentario</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.table-responsive -->
                                                </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- PANEL GROUP -->


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>

                    <input type="hidden" id="product_id" name="product_id" value="">


                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.Modal