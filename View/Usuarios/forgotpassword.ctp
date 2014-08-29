<h1>Reiniciar contraseña</h1>
<?php 
echo $this->Form->create('Usuario');

echo $this->Form->input('email', array('label' => 'Correo','type' => 'required'));  

echo $this->Form->end(__('Reiniciar'));
?> 