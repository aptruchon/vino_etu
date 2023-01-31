<div class="celliers">
    <div class="menu-actions-container">
        <!-- <a class="no-underline" href="?requete=ajouterCellier"> -->
            <span class="bouton-carre-label">Ajouter un cellier</span>
            <div class="bouton-carre" name="btnAjoutCellier"><i class="fa-solid fa-plus"></i></div>
        <!-- </a> -->
    </div>
    <section class="celliers-container">
        <?php
            foreach ($mesCelliers as $key => $cellier) {
        ?>
        <div class="cellier">
            <a class='no-underline' href="<?= "?requete=cellier&cellierId=" .$cellier['id']; ?>">
                <div class="mesCelliers">
                    <h2><?= $cellier["nom"]; ?></h2>
                    <p><?= $cellier["nbDeVins"]; ?> bouteilles dans le cellier </p>
                </div>
            </a>  
        </div>
        <?php
        }
        ?>  
    </section>

    <div class="modal-container" id="modal-container">
            <div class="pop-up">
                <div class="form-popup" id="popupForm">
                    <form method="POST" action="index.php?requete=ajouterCellier" class="form-container">
                        <svg id="closeFormX" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="#931818" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/></svg><br><br>
                        <label for="nomCellier">Nom Cellier:</label>
                        <input type="text" name="nomCellier" id="nomCellier" class="nomCellier">
                        <button type="submit" class="btn-boite-modale btn-oui">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
</div>
