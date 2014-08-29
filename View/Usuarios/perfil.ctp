<!-- File: /app/View/Posts/index.ctp -->

<table class="pure-table pure-table-bordered">
    
    <tr>
        <td>Id</td>
        <td><?php echo $miPerfil['Usuario']['id']?></td>
        
    </tr>
    <tr>
        <td>Nombre de Usuario o CUI</td>
        <td><?php echo $miPerfil['Usuario']['username']?></td>

    </tr>
    <tr>
        <td>Apellidos </td>
        <td><?php echo $miPerfil['Usuario']['apellidos']?></td>
    </tr>   
    <tr>
        <td>Nombres</td>
        <td><?php echo $miPerfil['Usuario']['nombres']?></td>
    </tr>   
    <tr>
        <td>Correo</td>
        <td><?php echo $miPerfil['Usuario']['correo']?> </td>
    </tr>
    <tr>
        <td>Rol</td>
        <td><?php foreach ($miPerfil['Rol'] as $rol) {
            # code...
            echo $rol['nombre_rol'];
        }?> 
        </td>
    </tr>
    
</table>