<!-- File: /app/View/Posts/index.ctp -->

<h1>Curriculas</h1>
<p><?php echo $this->Html->link("Add Curricula", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Código </th>
        <th>Año Inicio</th>
        <th>Año Fin</th>
        <th>Descripción</th>
        <th>Spreadsheet key</th>
        <th>Acciones</th>

    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($curriculas as $curricula): ?>
    <tr>
        <td><?php echo $curricula['Curricula']['id']; ?></td>
        <td><?php echo $curricula['Curricula']['anho_inicio']; ?></td>
        <td><?php echo $curricula['Curricula']['anho_fin']; ?></td>
        <td><?php echo $curricula['Curricula']['descripcion']; ?></td>
        <td><?php echo $curricula['Curricula']['spreadsheetkey']; ?></td>
        <td>
            <?php echo $this->Html->link("ver",
array('controller' => 'curriculas', 'action' => 'view', $curricula['Curricula']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Html->link("editar",
array('controller' => 'curriculas', 'action' => 'edit', $curricula['Curricula']['id'])); ?>
        </td>
        <td>
        <?php
                echo $this->Form->postLink('Delete',
                    array('action' => 'delete', $curricula['Curricula']['id']),
                    array('confirm' => 'Estás seguro?')
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($curricula); ?>
</table>