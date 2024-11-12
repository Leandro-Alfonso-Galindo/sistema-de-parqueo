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

        <br><h2>Creación de una nueva información</h2>

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registre los datos con mucho cuidado</h3>

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
                        <div class="col-md-4">
                            <label for="">Nombre del Parqueo <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nombre_parqueo">
                        </div>
                        <div class="col-md-4">
                            <label for="">Actividad de la Empresa <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="actividad_empresa">
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="sucursal">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Dirección <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="direccion">
                        </div>
                        <div class="col-md-6">
                            <label for="">Zona <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="zona">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Teléfono <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="telefono">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Departamento o Ciudad <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="departamento_ciudad">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Pais <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="pais">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="informaciones.php" class="btn btn-default btn-block">Cancelar</a>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_registrar_informacion" class="btn btn-primary btn-block">
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
$('#btn_registrar_informacion').click(function(){     
    var nombre_parqueo = $('#nombre_parqueo').val();
    var actividad_empresa = $('#actividad_empresa').val();
    var sucursal = $('#sucursal').val();
    var direccion = $('#direccion').val();
    var zona = $('#zona').val();
    var telefono = $('#telefono').val();
    var departamento_ciudad = $('#departamento_ciudad').val();
    var pais = $('#pais').val();

    if(nombre_parqueo == "") {
        alert('Debe llenar el campo nombre de parqueo');
        $('#nombre_parqueo').focus();
    }else if(actividad_empresa == "") {
        alert('Debe llenar el campo actividad de la empresa');
        $('#actividad_empresa').focus();
    }else if(sucursal == "") {
        alert('Debe llenar el campo sucursal');
        $('#sucursal').focus();
    }else if(direccion == "") {
        alert('Debe llenar el campo direccion');
        $('#direccion').focus();
    }else if(zona == "") {
        alert('Debe llenar el campo zona');
        $('#zona').focus();
    }else if(telefono == "") {
        alert('Debe llenar el campo telefono');
        $('#telefono').focus();
    }else if(departamento_ciudad == "") {
        alert('Debe llenar el campo departamento o ciudad');
        $('#departamento_ciudad').focus();
    }else if(pais == "") {
        alert('Debe llenar el campo pais');
        $('#pais').focus();
    }else {
        var url = "controller_create_informaciones.php";
        $.get(url, 
        {
            nombre_parqueo:nombre_parqueo, actividad_empresa:actividad_empresa, 
            sucursal:sucursal, direccion:direccion, zona:zona,
            telefono:telefono, departamento_ciudad:departamento_ciudad, pais:pais
        }, 
        function(datos) {
            $('#respuesta').html(datos);
        });
    }

});
</script>