<!-- <?php echo $this->Form->create('Matricula'); ?>
    <?php
        echo $this->Form->input(
            'Usuario.id',
            array(
                'type' => 'numeric',
                'label' => 'Student ID',
                'default' => 27
            )
        );
    ?>
    <?php
        echo $this->Form->input(
            'CursosProgramado.id',
            array(
                'type' => 'text',
                'label' => 'Course ID',
                'default' => 1
            )
        );
    ?>
    <?php echo $this->Form->input('Matricula.notaFinal'); ?>
    <button type="submit">Save</button>
<?php echo $this->Form->end(); ?>

-->

<!-- app/View/Users/add.ctp -->
<div class="matriculas form">
<?php echo $this->Form->create(false); ?>
    <fieldset>
        <legend><?php echo __('Generar Matrículas y Cursos Programados'); ?></legend>
        <?php 

        echo $this->Form->input('spreadsheetkey',array(
                                                    'type' => 'required',
                                                    'label' => 'Spreadsheetkey, por ejemplo: 0AvfPOhmLXt8tdHVZTTVEMUJZV2k5dmJFbzJwTFlGQ3c'
                                                    )); //sólo números

        echo $this->Form->input('worksheetId',array(
                                                    'type' => 'required',
                                                    'default' => '0',
                                                    'label' => 'Worksheet  id (comienzan en 0) dentro de los spreadsheet '
                                                    )); //sólo números
       
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

