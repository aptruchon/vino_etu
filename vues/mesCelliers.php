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
                    <div class="icons-mesCelliers">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M224 76.7L179.3 32a15.9 15.9 0 0 0-22.6 0l-120 120a15.4 15.4 0 0 0-3.6 5.5l-.2.5a16 16 0 0 0-.9 5.3V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.3L224 99.3a16.1 16.1 0 0 0 0-22.6Zm-80-9.4L160.7 84L68 176.7L51.3 160ZM48 208v-28.7L76.7 208Zm48-3.3L79.3 188L172 95.3l16.7 16.7Z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M216 48h-36V36a28.1 28.1 0 0 0-28-28h-48a28.1 28.1 0 0 0-28 28v12H40a12 12 0 0 0 0 24h4v136a20.1 20.1 0 0 0 20 20h128a20.1 20.1 0 0 0 20-20V72h4a12 12 0 0 0 0-24ZM100 36a4 4 0 0 1 4-4h48a4 4 0 0 1 4 4v12h-56Zm88 168H68V72h120Zm-72-100v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Zm48 0v64a12 12 0 0 1-24 0v-64a12 12 0 0 1 24 0Z"/></svg>    
                    </div>
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
