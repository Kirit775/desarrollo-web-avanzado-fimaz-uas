<?php
    //Maciel Alain GOnzález CObián Lisi 3-1
    require_once("../admin/template/header.php");
?>
<div class="mx-auto p-5">
    <div class="card">
        <div class="card-header">
            <span class="fw-bold"><i class="fa-solid fa-trophy"></i>CAPTURAR LA INFORMACIÓN DEL TORNEO</span>
        </div>
        <div class="card-body">
            <form action="torneosInsert.php" method="POST">
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO</label>
                    <input type="text" class="form-control" id="nombreTorneo" name="txtNombreTorneo">
                </div>
                <div class="mb-3">
                    <label for="organizador" class="form-label">ORGANIZADOR (nombre completo)</label>
                    <input type="text" class="form-control" id="organizador" name="txtOrganizador">
                </div>
                <div class="mb-3">
                    <label for="patrocinador" class="form-label">PATROCINADOR(ES)</label>
                    <textarea name="txtPatrocinador" id="patrocinador" cols="30" rows="2" class="form-control"></textarea>
                    <span id="patrocinador" class="form-text">
                        Atencion: se puede separar con "," si hay más de un patrocinador.
                    </span>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="sede" class="form-label">SEDE (cancha)</label>
                        <input type="text" class="form-control" id="sede" name="txtSede">
                    </div>
                    <div class="col mb-3">
                        <label for="categoria" class="form-label">CATEGORIA</label>
                        <input list="lstCategorias" class="form-control" id="categoria" name="txtCategoria">
                        <datalist id="lstCategorias">
                            <option value="1ra. fuerza">
                            <option value="2da. fuerza">
                            <option value="Veteranos">
                            <option value="Libre">
                            <option value="Juvenil">
                            <option value="Femenil">
                            <option value="Empresarial">
                            <option value="Infantil">
                            <option value="Minibasket">
                        </datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                        <input type="text" class="form-control" id="premio1" name="txtPremio1">
                    </div>
                    <div class="col mb-3">
                        <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                        <input type="text" class="form-control" id="premio2" name="txtPremio2">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="premio3" class="form-label">PREMIO 3RO. LUGAR</label>
                        <input type="text" class="form-control" id="premio3" name="txtPremio3">
                    </div>
                    <div class="col mb-3">
                        <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEÓN CANASTERO)</label>
                        <input type="text" class="form-control" id="otroPremio" name="txtOtroPremio">
                    </div>
                </div>
                <!-- Usuario y COntraseña para el organizador del torneo -->    
                
                <div class="row">
                    <div class="col mb-3">
                        <label for="usuario" class="form-label">USUARIO</label>
                        <input type="text" class="form-control" id="usuario" name="txtUsuario">
                    </div>
                    <div class="col mb-3">
                        <label for="password" class="form-label">CONTRASEÑA</label>
                        <input type="password" class="form-control" id="contrasena" name="txtContrasena">
                    </div>
                </div>
                <div class="col mb-3">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="admin.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>

        </div>
        <div class="card-footer text-body-secondary">
            FORMULARIO PARA REGSITRAR TORNEOS.
        </div>
    </div>
</div>

<?php
    require_once("../admin/template/footer.php");
?>
