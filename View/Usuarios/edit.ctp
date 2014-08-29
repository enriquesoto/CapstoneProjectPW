<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Usuario</h1>
<?php
	echo $this->Form->create('Usuario');

	echo $this->Form->input('username',array('label'=>'Username: si es alumno debe ser su CUI'));
	echo $this->Form->input('password');
	echo $this->Form->input('nombres');
	echo $this->Form->input('apellidos');
	echo $this->Form->input('correo',array('type' => 'email'));
	echo $this->Form->input('bloqueado',array('options' => array('0' => 'No','1' => 'Si')));
	echo $this->Form->input('fecha_nacimiento',array(
	'label' => 'Fecha de Nacimiento',
	'dateFormat' => 'YMD',
	'minYear' => date('Y') - 70,
	'maxYear' => date('Y') - 18,
	));
	echo $this->Form->input('Rol', array('options' => $roles ));
	echo $this->Form->end('Guardar Usuario');
?>