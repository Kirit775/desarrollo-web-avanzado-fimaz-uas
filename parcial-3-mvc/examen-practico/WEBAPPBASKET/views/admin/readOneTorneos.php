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
                <form action="torneosInsert.php" method="POST">
            <div class="mb-3">
                <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO(ID:<?= $lstTorneo['id'] ?>)</label>
                <input type="text" class="form-control" id="nombreTorneo" name="txtNombreTorneo" value="<?= $lstTorneo['nombreTorneo'] ?> " readonly>
            </div>
            <div class="mb-3">
                <label for="organizador" class="form-label">ORGANIZADOR (nombre completo)</label>
                <input type="text" class="form-control" id="organizador" name="txtOrganizador" value="<?= $lstTorneo['organizador'] ?>" readonly>
            </div>
            <div class="mb-3"> 
                <label for="patrocinador" class="form-label">PATROCINADOR(ES)</label>
                <textarea name="txtPatrocinador" id="patrocinador" cols="30" rows="2" class="form-control" readonly><?= $lstTorneo['patrocinadores'] ?></textarea>
                <span id="patrocinador" class="form-text">
                    Atencion: se puede separar con "," si hay más de un patrocinador.
                </span>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="sede" class="form-label">SEDE (cancha)</label>
                    <input type="text" class="form-control" id="sede" name="txtSede" value="<?= $lstTorneo['sede'] ?>" readonly>
                </div>
                <div class="col mb-3">
                    <label for="categoria" class="form-label">CATEGORIA</label>
                    <input list="lstCategorias" class="form-control" id="categoria" name="txtCategoria" value="<?= $lstTorneo['categoria'] ?>" readonly >
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                    <input type="text" class="form-control" id="premio1" name="txtPremio1" value="<?= $lstTorneo['premio1'] ?>" readonly>
                </div>
                <div class="col mb-3">
                    <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                    <input type="text" class="form-control" id="premio2" name="txtPremio2" value="<?= $lstTorneo['premio2'] ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="premio3" class="form-label">PREMIO 3RO. LUGAR</label>
                    <input type="text" class="form-control" id="premio3" name="txtPremio3" value="<?= $lstTorneo['premio3'] ?>" readonly>
                </div>
                <div class="col mb-3">
                    <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEÓN CANASTERO)</label>
                    <input type="text" class="form-control" id="otroPremio" name="txtOtroPremio" value="<?= $lstTorneo['otroPremio'] ?>" readonly>
                </div>
            </div>
            <!-- Usuario y COntraseña para el organizador del torneo -->    
             
            <div class="row">
                <div class="col mb-3">
                    <label for="usuario" class="form-label">USUARIO</label>
                    <input type="text" class="form-control" id="usuario" name="txtUsuario" value="<?= $lstTorneo['usuario'] ?>" readonly>
                </div>
                <div class="col mb-3">
                    <label for="password" class="form-label">CONTRASEÑA</label>
                    <input type="text" class="form-control" id="contrasena" name="txtContrasena" value="<?= $lstTorneo['contrasena'] ?>" readonly>
                </div>
            </div>
            <div class="col-2">
                <a href="readAlltorneos.php" class="btn btn-success">REGRESAR</a>
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
