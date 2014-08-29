<!-- app/View/Users/add.ctp -->
<div class="programmedcourses form">
<?php echo $this->Form->create('CursosProgramado'); ?>
    <fieldset>
        <legend><?php echo __('Add Curso Programado'); ?></legend>
        <?php 

        echo $this->Form->input('id'); //sólo números
        
        
        echo $this->Form->input('anho_dictado',array('default' => date('Y'),'type' => 'numeric' ));

        echo $this->Form->input('curso_id');

        echo $this->Form->input('ciclo_dictado',array('options'=>array(
                                                                    'A' => 'Periodo I',
                                                                    'B' => 'Periodo II',
                                                                    'V' => 'Verano'
                                                                    )
                                                    ));

        echo $this->Form->input('turno',array('options'=>array(
                                                                    'A' => 'Turno A',
                                                                    'B' => 'Turno B',
                                                                    'C' => 'Turno C',
                                                                    'D' => 'Turno D',
                                                                    'E' => 'Turno E'
                                                                    )
                                                    ));
        
        
        echo $this->Form->input('tipo_catedra',array('options'=>array(
                                                                    'T' => 'Teoría',
                                                                    'L' => 'Laboratorio',
                                                                    'P' => 'Práctica',
                                                                    )
                                                    ));

        echo $this->Form->input('spreadsheetkey');

        echo $this->Form->input('curricula_id',array('type' => 'hidden'));

       
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>