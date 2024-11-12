<?php 

include('app/config.php');

include('layout/admin/datos_usuario_sesion.php');

?>

<!DOCTYPE html>

<html lang="es">
<head>
  <?php include('layout/admin/head.php') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Menu superior y lateral -->

  <?php include('layout/admin/menu.php') ?>

  <!-- Contenido -->

  <div class="content-wrapper">

    <div class="container">

      <br><h2>Bienvenido a SisParqueo La Ligua</h2>

      <div class="row">
        <div class="col-md-12">
              
            <div class="card card-outline card-primary">
              <div class="card-header">
                  <h3 class="card-title">Mapeo actual del parqueo</h3>

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
                    <?php
                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'");
    
                    $query_mapeos->execute();
    
                    $mapeos = $query_mapeos->fetchALL(PDO::FETCH_ASSOC);
                    foreach($mapeos as $mapeo) {
                      $id_map = $mapeo['id_map'];
                      $nro_espacio = $mapeo['nro_espacio'];
                      $estado_espacio = $mapeo['estado_espacio'];
                      
                      if($estado_espacio == "LIBRE") {
                        ?>
                        <div class="col">
                          <center>
                            <h2><?php echo $nro_espacio;?></h2>
                            <button class="btn btn-success" style="width: 100%; height: 142px" data-toggle="modal" data-target="#modal<?php echo $id_map;?>">
                              <p><?php echo $estado_espacio;?></p>
                            </button>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="modal<?php echo $id_map;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ingreso del vehiculo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Placa: <span style="color: red">*</span></label>
                                        <div class="col-sm-6">
                                          <input type="text" style="text-transform: uppercase;" class="form-control" id="placa_buscar<?php echo $id_map;?>">
                                        </div>
                                        <div class="col-sm-3">                                         
                                          <button type="button" class="btn btn-primary" id="btn_buscar_cliente<?php echo $id_map;?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                            </svg>
                                            Buscar
                                          </button>
                                          <script>
                                            $('#btn_buscar_cliente<?php echo $id_map;?>').click(function(){
                                              var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                              var id_map = "<?php echo $id_map; ?>";

                                              if(placa == "") {
                                                alert('Debe llenar el campo placa');
                                                $('#placa_buscar<?php echo $id_map;?>').focus();
                                              }else {
                                                var url = "clientes/controller_buscar_cliente.php";
                                                $.get(url, {placa:placa, id_map:id_map}, function(datos) {
                                                  $('#respuesta_buscar_cliente<?php echo $id_map;?>').html(datos);
                                                });
                                              }
                                            });
                                          </script>
                                          
                                        </div>
                                      </div>

                                      <div id="respuesta_buscar_cliente<?php echo $id_map;?>">

                                      </div>
                                      
                                      <div class="form-group row">
                                        <label for="" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                                        <div class="col-sm-8">
                                          <?php
                                          date_default_timezone_set("America/Argentina/Buenos_Aires");
                                          $dia = date("d");
                                          $mes = date("m");
                                          $ano = date("Y");
                                          ?>
                                          <input id="fecha_ingreso<?php echo $id_map;?>" type="date" class="form-control" value="<?php echo $ano."-".$mes."-".$dia;?>">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Hora de Ingreso:</label>
                                        <div class="col-sm-8">
                                          <?php
                                          date_default_timezone_set("America/Argentina/Buenos_Aires");
                                          $hora = date("H");
                                          $minutos = date("i");
                                          ?>
                                          <input id="hora_ingreso<?php echo $id_map;?>" type="time" class="form-control" value="<?php echo $hora.":".$minutos;?>">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">Cuviculo:</label>
                                        <div class="col-sm-8">
                                          <input id="cuviculo<?php echo $id_map;?>" type="text" class="form-control" value="<?php echo $nro_espacio;?>">
                                        </div>
                                      </div>

                                      

                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map;?>">Imprimir ticket</button>
                                    <script>
                                      $('#btn_registrar_ticket<?php echo $id_map;?>').click(function(){
                                          
                                          var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                          var nombre_cliente = $('#nombre_cliente<?php echo $id_map;?>').val(); 
                                          var rut_ci = $('#rut_ci<?php echo $id_map;?>').val();
                                          var cuviculo = $('#cuviculo<?php echo $id_map;?>').val();
                                          var fecha_ingreso = $('#fecha_ingreso<?php echo $id_map;?>').val();
                                          var hora_ingreso = $('#hora_ingreso<?php echo $id_map;?>').val();
                                          var user_sesion = '<?php echo $usuario_sesion; ?>';

                                          if(placa == "") {
                                              alert('Debe llenar el campo placa');
                                              $('#placa_buscar<?php echo $id_map;?>').focus();
                                          }else if(nombre_cliente == "") {
                                              alert('Debe llenar el campo nombre de cliente');
                                              $('#nombre_cliente<?php echo $id_map;?>').focus();
                                          }else if(rut_ci == "") {
                                              alert('Debe llenar el campo rut/ci de cliente');
                                              $('#rut_ci_cliente<?php echo $id_map;?>').focus();
                                          }else {

                                              var url_1 = "parqueo/controller_cambiar_estado_ocupado.php";
                                              $.get(url_1, {cuviculo:cuviculo}, function(datos) {
                                                  $('#respuesta').htnl(datos)
                                              });

                                              var url_2 = "clientes/controller_registrar_clientes.php";
                                              $.get(url_2, {nombre_cliente:nombre_cliente, rut_ci:rut_ci, placa:placa}, function(datos) {
                                                  $('#respuesta').htnl(datos)
                                              });

                                              var url_3 = "tickets/controller_registrar_tickets.php";
                                              $.get(url_3, 
                                              {
                                                placa:placa, 
                                                nombre_cliente:nombre_cliente, 
                                                rut_ci:rut_ci, 
                                                cuviculo:cuviculo, 
                                                fecha_ingreso:fecha_ingreso, 
                                                hora_ingreso:hora_ingreso, 
                                                user_sesion:user_sesion
                                              }, function(datos) {
                                                  $('#respuesta_ticket').html(datos);
                                              });

                                          }

                                      });
                                    </script>
                                  </div>
                                </div>
                                <div id="respuesta_ticket">

                                </div>
                              </div>
                            </div>
                          </center>
                        </div>
                        <?php
                      }
                      if($estado_espacio == "OCUPADO") {
                        ?>
                        <div class="col">
                          <center>
                            <h2><?php echo $nro_espacio;?></h2>
                            <button class="btn btn-danger" id="btn_ocupado<?php echo $id_map;?>" data-toggle="modal" data-target="#exampleModal<?php echo $id_map;?>">
                              <img src="<?php echo $URL;?>/public/imagenes/auto.jpg" width="60px" alt="">
                            </button>

                            <?php
                            
                            $query_datos_clientes = $pdo->prepare("SELECT * FROM tb_tickets WHERE cuviculo = '$nro_espacio' AND estado = '1'");
            
                            $query_datos_clientes->execute();
            
                            $datos_clientes = $query_datos_clientes->fetchALL(PDO::FETCH_ASSOC);
                            foreach($datos_clientes as $datos_cliente) {
                              $id_ticket = $datos_cliente['id_ticket'];
                              $placa_auto = $datos_cliente['placa_auto'];
                              $nombre_cliente = $datos_cliente['nombre_cliente'];
                              $rut_ci = $datos_cliente['rut_ci'];
                              $cuviculo = $datos_cliente['cuviculo'];
                              $fecha_ingreso = $datos_cliente['fecha_ingreso'];
                              $hora_ingreso = $datos_cliente['hora_ingreso'];
                              $user_sesion = $datos_cliente['user_sesion'];
                            } ?>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $id_map;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    
                                    <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-4 col-form-label">Placa:</label>
                                          <div class="col-sm-8">
                                            <input type="text" style="text-transform: uppercase;" class="form-control" value="<?php echo $placa_auto?>" id="placa_buscar<?php echo $id_map;?>" readonly>
                                          </div>
                                          
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-4 col-form-label">Nombre:</label>
                                            <div class="col-sm-8">
                                                <input id="nombre_cliente<?php echo $id_map;?>" value="<?php echo $nombre_cliente?>" type="text" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-4 col-form-label">RUT/CI: </label>
                                            <div class="col-sm-8">
                                                <input id="rut_ci<?php echo $id_map;?>" value="<?php echo $rut_ci?>" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                          <label for="" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                                          <div class="col-sm-8">
                                            <input id="fecha_ingreso<?php echo $id_map;?>" value="<?php echo $fecha_ingreso?>" type="text" class="form-control" readonly>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="inputPassword" class="col-sm-4 col-form-label">Hora de Ingreso:</label>
                                          <div class="col-sm-8">
                                            <input id="hora_ingreso<?php echo $id_map;?>" value="<?php echo $hora_ingreso?>" type="text" class="form-control" readonly>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="inputPassword" class="col-sm-4 col-form-label">Cuviculo:</label>
                                          <div class="col-sm-8">
                                            <input id="cuviculo<?php echo $id_map;?>" value="<?php echo $cuviculo?>" type="text" class="form-control" readonly>
                                          </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                      <a href="tickets/controller_cancelar_ticket.php?id=<?php echo $id_ticket;?>&&cuviculo=<?php echo $cuviculo;?>" class="btn btn-danger">Cancelar Ticket</a>
                                      <a href="tickets/reimprimir_ticket.php?id=<?php echo $id_ticket;?>" class="btn btn-primary">Volver a Imprimir</a>
                                      <button type="button" class="btn btn-success">Facturar</button>
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>

                            <p><?php echo $estado_espacio;?></p>
                          </center>
                        </div>
                        <?php
                      }  
                    }
                      ?>
                    
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
                  
          
        </div>
                
      </div>
    </div>

  </div>
  
  

  <!-- Pie de página -->

  <?php include('layout/admin/footer.php') ?>
  
</div>

<?php include('layout/admin/footer_link.php') ?>

</body>
</html>

