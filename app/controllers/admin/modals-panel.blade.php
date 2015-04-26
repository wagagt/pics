            <!-- APPROVE Modal ( change status, add comment ) -->
        <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                        <h4 class="modal-title" id="myModalLabel">  <i class="fa fa-thumbs-o-up fa-3"></i> Aprobar Artículo</h4>
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
                        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-thumbs-o-down fa-3"></i> Denegar Artículo</h4>
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