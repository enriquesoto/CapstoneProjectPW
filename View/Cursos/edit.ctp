<h1>Edit Currícula</h1>
<?php
echo $this->Form->create('Curricula');
//echo $this->Form->input('id',array('type'=>'numeric')); //sólo números
echo $this->Form->input('anho_inicio',array('type' => 'numeric'));
echo $this->Form->input('anho_fin',array('type' => 'numeric'));
echo $this->Form->input('spreadsheetkey');
echo $this->Form->input('descripcion', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Guardar Currícula');
?>