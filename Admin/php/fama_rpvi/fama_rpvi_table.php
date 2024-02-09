<?php
$data = $_POST['r'];

?>
<div class="row">
  <div class="col-lg-7">
      <table class="table table-striped text-center" style="font-size: 10px;">
          <thead>
            <tr>
              <th class="bg-success" colspan="8" style="color: #ffffff;">FAMA</th>
            </tr>
            <tr>
              <!-- fama -->
              <th scope="col">Documento</th>
              <th scope="col">Nro de Orden</th>
              <th scope="col">Periodo</th>
              <th scope="col">Identificación</th>
              <th scope="col">Estudiante</th>
              <th scope="col">Modalidad</th>
              <th scope="col">Programa</th>
              <th scope="col">Ciclo</th>
              
             
            </tr>
          </thead>
          <tbody>
            <?php 
              if(count($data[0]) == 0){
                echo '<tr>'.'<td colspan="8">No se encontraron documentos FAMA</td>'
                    .'</tr>';

              }else{
                  foreach($data[0] as $fama){
                    echo '<tr>'.
                              '<td>'.$fama['documento'].'</td>'.
                              '<td>'.$fama['orden'].'</td>'.
                              '<td>'.$fama['periodo'].'</td>'.
                              '<td>'.$fama['identificacion'].'</td>'.
                              '<td>'.$fama['usuario'].'</td>'.
                              '<td>'.$fama['modalidad'].'</td>'.
                              '<td>'.$fama['programa'].'</td>'.
                              '<td>'.$fama['ciclo'].'</td>'.
                          '</tr>';
                  }  
              }
              
              
            ?>
          </tbody>
      </table>
  </div>

  <div class="col-lg-5">
      <table class="table table-striped text-center" style="font-size: 10px;">
            <thead>
              <tr>
                <th class="bg-warning" colspan="5" style="color: #ffffff;">RPVI</th>
              </tr>
              <tr>
                <!-- rpvi -->
                <th scope="col">Documento</th>
                <th scope="col">Nro de Orden</th>
                <th scope="col">Periodo</th>
                <th scope="col">Identificación</th>
                <th scope="col">Descripción</th>
                
               
              </tr>
            </thead>
            <tbody>
              <?php
                 if(count($data[1]) == 0){
                  echo '<tr>'.'<td colspan="5">No se encontraron documentos RPVI</td>'
                      .'</tr>';

                }else{
                  foreach ($data[1] as $rpvi) {

                      echo  '<tr>'.
                                  '<td>'.$rpvi['documento'].'</td>'.
                                  '<td>'.$rpvi['orden'].'</td>'.
                                  '<td>'.$rpvi['periodo'].'</td>'.
                                  '<td>'.$rpvi['identificacion'].'</td>'.
                                  '<td>'.$rpvi['descripcion'].'</td>'.
                            '</tr>';

                  }  
                }
                
              ?>
            </tbody>
        </table>
  </div>
</div>
                    