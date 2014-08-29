<!-- File: /app/View/Posts/index.ctp -->
<table id="myTable" class="tablesorter">
    <thead>
        <tr>
            <th>Nro           </th>
            <th>Cod. Malla</th>
            <th>Cod. Asignatura.</th>
            <th>Año </th>
            <th>Sem</th>
            <th>Nombre de Asignatura</th>
            <th>Grupo</th>
            <th>Nota</th>
            <th>Letras</th>
            <th>Cred</th>
            <th>Periodo</th>

        </tr>
    </thead>
    <tbody>
        <!-- Here is where we loop through our $posts array, printing out post info -->
        <?php 
        $nro = 1;
        $this->Html->script('jquery-latest', array('inline' => false));
        $this->Html->script('jquery.tablesorter', array('inline' => false));
        $this->Html->script('grades', array('inline' => false));
        foreach ($myEnrollments as $myEnrollment): ?>
        <tr>
            <td><?php echo $nro ?></td>
            <td><?php echo $myEnrollment['CursosProgramado']['Curso']['curricula_id']; ?></td>
            <td><?php echo $myEnrollment['CursosProgramado']['curso_id']; ?></td>        
            <td><?php echo round($myEnrollment['CursosProgramado']['Curso']['semestre']/2); ?></td>
            <td><?php echo $myEnrollment['CursosProgramado']['Curso']['semestre']; ?></td>
            <td><?php echo strtoupper($myEnrollment['CursosProgramado']['Curso']['nombre']); ?></td>
            <td><?php echo strtoupper($myEnrollment['CursosProgramado']['turno']); ?></td>
            <td><?php echo strtoupper($myEnrollment['Matricula']['notaFinal']); ?></td>
            <td><?php echo strtoupper($myEnrollment['Matricula']['letras']); ?></td>
            <td><?php echo $myEnrollment['CursosProgramado']['Curso']['creditos']; ?></td>
            <td><?php echo $myEnrollment['CursosProgramado']['anho_dictado']."-".
            				$myEnrollment['CursosProgramado']['ciclo_dictado'] ; ?></td>
         
        <?php $nro++; endforeach; ?>
    </tbody>
    <?php unset($myEnrollments); ?>
</table>