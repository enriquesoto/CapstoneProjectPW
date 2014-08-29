<!-- File: /app/View/Posts/index.ctp -->

<h1>Usuarios</h1>
<p><?php echo $this->Html->link("Add Usuario", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>id </th>
        <th>Username</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Ultimo Ingreso</th>
        <th>Fecha Registro</th>
        <th>F. Nacimiento</th>
        <th>Correo comprobado</th>
        <th>Roles</th>

    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php debug($usuarios); foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?php echo $usuario['Usuario']['id']; ?></td>
        <td><?php echo $usuario['Usuario']['username']; ?></td>
        <td><?php echo $usuario['Usuario']['nombres']; ?></td>
        <td><?php echo $usuario['Usuario']['apellidos']; ?></td>
        <td><?php echo $usuario['Usuario']['correo']; ?></td>
        <td><?php echo $usuario['Usuario']['ultimo_ingreso']; ?></td>
        <td><?php echo $usuario['Usuario']['fecha_registro']; ?></td>
        <td><?php echo $usuario['Usuario']['fecha_nacimiento']; ?></td>
        <td><?php echo $usuario['Usuario']['comprobado']; ?></td>
        <td>
            <?php 
                foreach ($usuario['Rol'] as $rol) {
                    echo $rol['nombre_rol']."</br>";
                }
            ?>
        </td>
        <td>
            <?php echo $this->Html->link("editar",
array('controller' => 'usuarios', 'action' => 'edit', $usuario['Usuario']['id'])); ?>
        </td>
        <td>
        <?php
                echo $this->Form->postLink('Delete',
                    array('action' => 'delete', $usuario['Usuario']['id']),
                    array('confirm' => '¿Estás seguro?')
                );
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($usuario); ?>
</table>