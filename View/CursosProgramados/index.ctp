<!-- File: /app/View/Posts/index.ctp -->

<h1>Cursos Programados</h1>
<p><?php echo $this->Html->link("Add Curso Programado", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Código </th>
        <th>Nombre del Curso</th>
        <th>Año Dictado</th>
        <th>Turno </th>
        <th>Ciclo Dictado </th>
        <th>Spreadsheet key</th>
        <th>Tipo Catedra</th>
        <th>Acciones</th>

    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
    
    <?php debug($cursosProgramados); foreach ($cursosProgramados as $cursoProgramado): ?>
    
    <?php endforeach; ?>
    <?php unset($cursosProgramados); ?>
</table>