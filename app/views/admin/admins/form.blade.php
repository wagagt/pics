<?php
// Verify data to display in Update form
$id = (empty($admin->name))?'':$admin->name;
$name = (empty($admin->name))?'':$admin->name;
$email = (empty($admin->email))?'':$admin->email;
$password = (empty($admin->password))?'':$admin->password;
$rol = (empty($admin->rol))?'':$admin->rol;
//$rols = (empty($admin->rols))?'':$admin->rol_name;
$status = (isset($admin)) ? (empty($admin->status)) ? '' : 'checked'   : 'checked';
//myDump(array($rol),1);
?>

<div class="container-fluid">
<fieldset>
    <legend>Ingrese información:</legend>
    
    <div class="row form">
        <div class="col-xs-3">
            <div class="input-group">{{ Form::label('name', 'Nombre', array('class'=>'control-label')) }}</div>    
        </div>
        <div class="col-xs-3">
            <div class="input-group">{{ Form::textWithErrors('name',$name,array('class'=>'form-control','placeholder'=>'Nombre'), $errors) }}</div>    
        </div>
        
        <div class="col-xs-3">
            <div class="input-group">{{ Form::label('rol', 'Rol', array('class'=>'control-label')) }}</div>    
        </div>
        <div class="col-xs-3">
            <div class="input-group">{{ Form::select('rol', array('admin'=>'Admin', 'superadmin'=>'SuperAdmin'), array($rol), array('class'=>'form-control') ) }}</div>    
        </div>
    </div>

    <div class="row form">
        <?php if ($form_type == "create") {   // CONFIRMATION PASSWORD ON CREATE AND EDIT. ?>
            <div class="col-xs-3">
                <div class="input-group">{{ Form::label('password', 'Clave', array('class'=>'control-label')) }}</div> 
            </div>
            <div class="col-xs-3">
                <div class="input-group">{{ Form::passwordWithErrors('password', $password, array('class'=>'form-control','placeholder'=>'Clave', 'type'=>'password'), $errors) }}</div>    
            </div>
            <div class="col-xs-3">
                <div class="input-group">{{ Form::label('password_confirmation', 'Confirmar Clave', array('class'=>'control-label')) }}</div>    
            </div>
            <div class="col-xs-3">
                <div class="input-group">{{ Form::passwordWithErrors('password_confirmation', '', array('class'=>'form-control','placeholder'=>'Confirmar Clave', 'type'=>'password'), $errors) }}</div>    
            </div>
        <?php } else { ?>

            <input type="hidden" id="password" name="password" value="<?php echo $password;?>">
            <input type="hidden" id="password_confirmation" name="password_confirmation" value="<?php echo $password;?>">
        <!-- <div class="col-xs-3">
                <div class="input-group">[ link cambiar clave ] </div>    
        </div> -->

        <?php } ?>
    </div>
    
    <div class="row form">
        <div class="col-xs-3">
                <div class="input-group">{{ Form::label('email', 'Email', array('class'=>'control-label')) }}</div>    
            </div>
        <div class="col-xs-3">
                <div class="input-group">{{ Form::textWithErrors('email', $email, array('class'=>'form-control','placeholder'=>'Email'), $errors) }}</div>    
        </div>

        <div class="col-xs-3">
                <div class="input-group">{{ Form::label('status', 'Estado', array('class'=>'control-label')) }}</div>    
        </div>
        <div class="col-xs-3 text-left">
                        <div class="checkbox"> <input id='status' name='status' type="checkbox" {{$status}} value="1"> </div>
        </div>        
    </div>
    
    @if($form_type != 'show')    
        <div class="row form">
            <div class="col-xs-12 vcenter">
            {{ Form::button ('<i class="fa fa-plus-circle"></i>  Enviar Formulario', array(
                        'type' => 'submit',
                        'class' => 'btn btn-info',
                        'title' => 'click para agregar nuevo registro'
                        )) 
                        }}
            </div>
        </div>  
    @endif
</fieldset>
</div>


