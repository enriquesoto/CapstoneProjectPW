<div class="usuarios form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Usuario',array(
											'action' => 'login',
									        'class' => 'pure-form pure-form-stacked'
    										)
    						); ?>
    <fieldset>
        <legend><?php echo __('Por favor ingrese su usuario y password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php

echo $this->Form->submit('Login',array('class' => 'pure-button pure-button-primary')); ?>
</div>