<?php
// Maciel Alain González Cobián Lisi 3-1
    require_once("../../controllers/torneosController.php");

    $objTorneosController = new torneosController();
    $objTorneosController->delete($_GET['id']);

?>
