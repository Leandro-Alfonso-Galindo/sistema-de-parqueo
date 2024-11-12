<?php 

include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

?>

<!DOCTYPE html>

<html lang="es">
<head>
  <?php include('../layout/admin/head.php') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Menu superior y lateral -->

  <?php include('../layout/admin/menu.php') ?>

  <!-- Contenido -->

  <div class="content-wrapper">

  <div class="container">

    <br><h2>Listado de Roles</h2>

    <div class="row">
        <div class="col-md-6">
            <table border="1" class="table table-bordered table-sm table-striped">

                <th><center>Nro</center></th>
                <th>Nro_Espacio</th>
                <th><center>Acción</center></th>    

                <?php 
                $contador = 0;
                $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'");

                $query_mapeos->execute();

                $mapeos = $query_mapeos->fetchALL(PDO::FETCH_ASSOC);
                foreach($mapeos as $mapeo) {
                    $id_map = $mapeo['id_map'];
                    $nro_espacio = $mapeo['nro_espacio'];
                    $contador = $contador + 1;

                ?>
                <tr>

                <td><center><?php echo $contador ?></center></td>
                <td><?php echo $nro_espacio ?></td>
                <td>
                <center>
                    <a href="delete.php?id=<?php echo $id_map;?>" class="btn btn-danger">Borrar</a>
                </center>
                </td>

                </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>

  </div>
  
  </div>

  <!-- Pie de página -->

  <?php include('../layout/admin/footer.php') ?>
  
</div>

<?php include('../layout/admin/footer_link.php') ?>

</body>
</html>