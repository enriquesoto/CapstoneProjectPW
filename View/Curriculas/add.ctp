<h1>Add Curricula</h1>
<?php
echo $this->Form->create('Curricula');
echo $this->Form->input('id',array('type'=>'numeric')); //sólo números
echo $this->Form->input('anho_inicio',array('default' => date('Y'),'type' => 'numeric' ));
echo $this->Form->input('anho_fin',array('type' => 'numeric'));
echo $this->Form->input('spreadsheetkey');
echo $this->Form->input('descripcion', array('rows' => '3'));
echo $this->Form->end('Guardar Curricula');
?>