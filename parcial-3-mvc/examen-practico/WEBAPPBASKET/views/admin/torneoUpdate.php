<?php
    //Maciel Alain González Cobián Lisi3-1
    require_once("../../controllers/torneosController.php");

    $objController = new torneosController();

    $id = $_POST['txtId'];
    $nombreTorneo = $_POST['txtNombreTorneo'];
    $organizador = $_POST['txtOrganizador'];
    $patrocinador = $_POST['txtPatrocinador'];
    $sede = $_POST['txtSede'];
    $categoria = $_POST['txtCategoria'];
    $premio1 = $_POST['txtPremio1'];
    $premio2 = $_POST['txtPremio2'];
    $premio3 = $_POST['txtPremio3'];
    $otroPremio = $_POST['txtOtroPremio'];
    

    $objController->updateTorneo($id, $nombreTorneo,$organizador,$patrocinador,$sede,$categoria,$premio1, $premio2, $premio3,$otroPremio);

  

    ?>
