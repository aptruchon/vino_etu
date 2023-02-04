<div class="celliers">
    <div class="menu-actions-container">
        <!-- <a class="no-underline" href="?requete=ajouterCellier"> -->
            <span class="bouton-carre-label">Ajouter un cellier</span>
            <div class="btn-rond-rouge" name="btnAjoutCellier"><i class="fa-solid fa-plus"></i></div>
        <!-- </a> -->
    </div>
    <section class="celliers-container">
        <?php
            foreach ($mesCelliers as $key => $cellier) {
        ?>
        <div class="cellier" id="<?= $cellier["id"]; ?>">
            <div class="mesCelliers">
                <div class="icons-mesCelliers">
                  <a href="" class="btnModifierCellier" data-id="<?php echo $cellier['id'] ?>" data-nom="<?php echo $cellier['nom'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M224 76.7L179.3 32a15.9 15.9 0 0 0-22.6 0l-120 120a15.4 15.4 0 0 0-3.6 5.5l-.2.5a16 16 0 0 0-.9 5.3V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.3L224 99.3a16.1 16.1 0 0 0 0-22.6Zm-80-9.4L160.7 84L68 176.7L51.3 160ZM48 208v-28.7L76.7 208Zm48-3.3L79.3 188L172 95.3l16.7 16.7Z"/></svg></a>
                  <a href="" class="btnSupprimerCellier" data-id="<?php echo $cellier['id'] ?>" data-nom="<?php echo $cellier['nom'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M216 48h-36V36a28.1 28.1 0 0 0-28-28h-48a28.1 28.1 0 0 0-28 28v12H40a12 12 0 0 0 0 24h4v136a20.1 20.1 0 0 0 20 20h128a20.1 20.1 0 0 0 20-20V72h4a12 12 0 0 0 0-24ZM100 36a4 4 0 0 1 4-4h48a4 4 0 0 1 4 4v12h-56Zm88 168H68V72h120Zm-72-100v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Zm48 0v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Z"/></svg></a>  
                </div>
                <div class="mesCelliers-descriptions">
                    <a class='no-underline' href="<?= "?requete=cellier&cellierId=" .$cellier['id']; ?>">
                        <h2><?= $cellier["nom"]; ?></h2>
                        <p><?= $cellier["nbDeVins"]; ?> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="m245.7 42.3l-32-32a8.1 8.1 0 0 0-11.4 11.4l1.5 1.4l-55.1 41.4l-38.3 7.7a8.5 8.5 0 0 0-4.1 2.1L21.7 159a23.9 23.9 0 0 0 0 34L63 234.3a23.9 23.9 0 0 0 34 0l84.7-84.6a8.5 8.5 0 0 0 2.1-4.1l7.7-38.3l41.4-55.1l1.4 1.5a8.2 8.2 0 0 0 11.4 0a8.1 8.1 0 0 0 0-11.4ZM74.3 223L33 181.7a8 8 0 0 1 0-11.4l7-7L92.7 216l-7 7a8.1 8.1 0 0 1-11.4 0ZM177.6 99.2a8.3 8.3 0 0 0-1.4 3.2l-7.6 37.7l-8.6 8.6L107.3 96l8.6-8.6l37.7-7.6a8.3 8.3 0 0 0 3.2-1.4l58.4-43.8l6.2 6.2Z"/></svg></p>
                    </a>  
                </div>
                </div>
        </div>
        <?php } ?>  
    </section>
                
    <!-- MODAL AJOUTER -->
    <div class="modal-container" id="modal-container">
        <div class="pop-up">
            <div class="form-popup" id="popupFormAjouter">
                <form method="POST" action="index.php?requete=ajouterCellier" class="form-container">
                    <svg id="closeFormX" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="#931818" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/></svg><br><br>
                    <label for="nomCellier">Nom Cellier:</label>
                    <input type="text" name="nomCellier" id="nomCellier" class="nomCellier">
                    <button type="submit" class="btn-boite-modale btn-ajouter">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL MODIFIER -->
    <div class="modal-container-modifier" id="modal-container-modifier">
        <div class="pop-up">
            <div class="form-popup" id="popupFormModifier">
                <form method="POST" action="index.php?requete=modifierCellier" class="form-container">
                    <svg id="closeFormXmodifier" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="#931818" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/></svg><br><br>
                    <label for="nomCellier">Nom du cellier :</label>
                    <input type="text" name="nomCellier" id="nomCellier" class="nomCellier">
                    <input type="text" name="idCellier" id="idCellier" hidden>
                    <button type="submit" class="btn-boite-modale btn-ajouter">Modifier</button>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL SUPPRIMER -->
    <div class="modal-container-supprimer" id="modal-container-supprimer">
        <div class="pop-up">
            <div class="form-popup" id="popupFormSupprimer">
                <form method="POST" action="supprimerCellier" class="form-container">
                    <svg id="closeFormXsupprimer" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                    <path fill="#931818" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/></svg><br><br>
                    <h2 name="confirmation"></h2>
                    <input type="text" name="idCellier" id="idCellier" hidden>
                    <button type="submit" class="btn-boite-modale btn-oui">Oui</button>
                    <button type="button" class="btn-boite-modale btn-non" id="closeFormSupprimer">Non</button>
                </form>
            </div>
        </div>
    </div>
</div>
