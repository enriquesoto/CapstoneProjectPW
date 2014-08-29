<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('Usuario'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
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
		//echo $this->Form->input('Rol',array('options' => $roles,'multiple' => 'checkbox' ));
		//echo $this->Form->input('rol',array('options' => array()))
        // echo $this->Form->input('role', array(
        //     'options' => array('admin' => 'Admin', 'author' => 'Author')
        // ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>