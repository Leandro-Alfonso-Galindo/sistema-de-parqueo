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

        <br><h2>Creación de un nuevo espacio</h2>

        <div class="row">
            <div class="col-md-6">
                
                <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene todos los campos</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nro Espacio</label>
                                <input type="number" id="nro_espacio" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="" id="estado_espacio" class="form-control">
                                    <option value="LIBRE">LIBRE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="" id="observacion" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="" class="btn btn-default btn-block">Cancelar</a>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_registrar" class="btn btn-primary btn-block">
                                Registrar
                            </button>
                        </div>
                    </div>
                    <div id="respuesta">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
                    
            
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

<script>
$('#btn_registrar').click(function(){     
var nro_espacio = $('#nro_espacio').val();
var estado_espacio = $('#estado_espacio').val();
var observacion = $('#observacion').val();

if(nro_espacio == "") {
    alert('Debe llenar el campo nro de espacio');
    $('#nro_espacio').focus();
}else {
    var url = "controller_create.php";
    $.get(url, {nro_espacio:nro_espacio, estado_espacio:estado_espacio, observacion:observacion}, function(datos) {
        $('#respuesta').html(datos);
    });
}

});
</script>