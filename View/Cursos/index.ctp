<!-- File: /app/View/Posts/index.ctp -->

<h1>Cursos</h1>
<p><?php echo $this->Html->link("Add Curso", array('action' => 'add')); ?></p>

    <!-- Here is where we loop through our $posts array, printing out post info -->

	<?php 

	$tableCurricula = -1;
	$semestre = -1;
	$anhoCurricula = -1;

    foreach ($cursos as $curso): 

    if($tableCurricula != $curso['Curso']['curricula_id']) { //si es nueva curricula creo una nueva tabla
    	$tableCurricula = $curso['Curso']['curricula_id'];
    ?>
	<table>
	<tr> <th> <h1> Currícula <?php echo $curso['Curso']['curricula_id']; ?> </h1> </th> </tr>
    <tr>
        <th>Código </th>
		<th>Comp. Formación</th> 
        <th>Nombre</th>
        <th>Créditos</th>
        <th>Horas Teoría</th>
        <th>Horas Semipresencial</th>
        <th>Horas Teórico Práctico</th>
        <th>Horas Práctica</th>
        <th>Semestre</th>
        <th>Pre - requisitos</th>
        

    </tr>

    <?php 
    }
    if($semestre != $curso['Curso']['semestre']){
    	$semestre = $curso['Curso']['semestre'];
    ?>

    <tr> <td> -- </td> </tr>

    <?php

    }
    ?>

     <tr>
        <td><?php echo $curso['Curso']['id']; ?></td>
        <td><?php echo $curso['Curso']['componentes_formacion_id']; ?></td>
        <td><?php echo $curso['Curso']['nombre']; ?></td>
        <td><?php echo $curso['Curso']['creditos']; ?></td>
        <td><?php echo $curso['Curso']['horas_teoria']; ?></td>
        <td><?php echo $curso['Curso']['horas_semiPresecial']; ?></td>
        <td><?php echo $curso['Curso']['horas_teoricoPractico']; ?></td>
        <td><?php echo $curso['Curso']['horas_practica']; ?></td>
        <td><?php echo $curso['Curso']['semestre']; ?></td>
        <td><?php echo $curso['Curso']['prerequisitos']; ?></td>

    </tr>
    	
    <?php endforeach; ?>
    <?php unset($curso); ?>
</table>