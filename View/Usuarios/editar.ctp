<!-- File: /app/View/Posts/edit.ctp -->
<?php
	echo $this->Form->create('Usuario', array(
											'action' => 'editar',
									        'class' => 'pure-form pure-form-aligned'
    										));
?>
<div class="pure-control-group">
	<?php echo $this->Form->input('password',array('label' => 'Contraseña','placeholder' => 'contraseña')); ?> 
</div>
<div class="pure-control-group">
	<?php echo $this->Form->input('repass',array('type' => 'password','label' => 'Confirmar contraseña','placeholder' => 'confirmar contraseña')); ?>
</div>
<div class="pure-control-group">
	<?php echo $this->Form->input('correo',array('type' => 'email', 'label' => 'Correo','placeholder' => 'Correo')); ?>
</div>
<div class="pure-control-group">
<?php
	echo $this->Form->input('fecha_nacimiento',array(
		'label' => 'Fecha de Nacimiento',
		'dateFormat' => 'YMD',
		'minYear' => date('Y') - 70,
		'maxYear' => date('Y') - 18,
	)); ?>
</div>
<?php
	echo $this->Form->submit('Guardar Datos',array('class' => 'pure-button pure-button-primary'));
?>