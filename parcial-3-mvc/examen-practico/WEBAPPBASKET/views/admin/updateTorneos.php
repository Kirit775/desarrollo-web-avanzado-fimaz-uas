<?php
    //Maciel Alain González Cobián Lisi 3-1
    require_once("../../controllers/torneosController.php");
    require_once("../admin/template/header.php");

    $objTorneosController= new torneosController();

    $lstTorneo = $objTorneosController->readOneTorneo($_GET['id']);
?>

    <div class="mx-auto p-4">
        <div class="card">
            <div class="card-header">
                INFORMACIÓN DEL TORNEO
            </div>
            <div class="card-body">
                <form action="torneoUpdate.php" method="POST">
                <div class="mb-3">
                    <label for="id" class="form-label">ID DEL TORNEO</label>
                    <input type="text" class="form-control" id="id" name="txtId" value="<?= $lstTorneo['id'] ?> " >
                </div>
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO</label>
                    <input type="text" class="form-control" id="nombreTorneo" name="txtNombreTorneo" value="<?= $lstTorneo['nombreTorneo'] ?>" >
                </div>
                <div class="mb-3">
                    <label for="organizador" class="form-label">ORGANIZADOR (nombre completo)</label>
                    <input type="text" class="form-control" id="organizador" name="txtOrganizador" value="<?= $lstTorneo['organizador'] ?>" >
                </div>
                <div class="mb-3"> 
                    <label for="patrocinador" class="form-label">PATROCINADOR(ES)</label>
                    <textarea name="txtPatrocinador" id="patrocinador" cols="30" rows="2" class="form-control" ><?= $lstTorneo['patrocinadores'] ?></textarea>
                    <span id="patrocinador" class="form-text">
                        Atencion: se puede separar con "," si hay más de un patrocinador.
                    </span>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="sede" class="form-label">SEDE (cancha)</label>
                        <input type="text" class="form-control" id="sede" name="txtSede" value="<?= $lstTorneo['sede'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="categoria" class="form-label">CATEGORIA</label>
                        <input list="lstCategorias" class="form-control" id="categoria" name="txtCategoria" value="<?= $lstTorneo['categoria'] ?>"  >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                        <input type="text" class="form-control" id="premio1" name="txtPremio1" value="<?= $lstTorneo['premio1'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                        <input type="text" class="form-control" id="premio2" name="txtPremio2" value="<?= $lstTorneo['premio2'] ?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio3" class="form-label">PREMIO 3RO. LUGAR</label>
                        <input type="text" class="form-control" id="premio3" name="txtPremio3" value="<?= $lstTorneo['premio3'] ?>" >
                    </div>
                    <div class="col mb-3">
                        <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEÓN CANASTERO)</label>
                        <input type="text" class="form-control" id="otroPremio" name="txtOtroPremio" value="<?= $lstTorneo['otroPremio'] ?>" >
                    </div>
                </div>
                
                <div class="col mb-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="readAllTorneos.php" class="btn btn-danger">Cancelar</a>
                </div>
                </form>

            </div>
                <div class="card-footer text-body-secondary">
                    DETALLE DE TORNEOS
                </div>
        </div>

    </div>



<?php
    require_once("../admin/template/footer.php");
  
?>
