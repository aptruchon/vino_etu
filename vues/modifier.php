<div class="modifier form-page">
    <?php
    foreach ($dataModifie as $cle => $bouteille) {
    ?>
        <a href="?requete=ficheDetailsBouteille&bte=<?php echo $bouteille['vino__bouteille_id'] ?>" class="retour">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                <path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
            </svg>
        </a>
        <form>
            <div class="modifieBouteille" vertical layout>
                <div class="input-container">
                    <input type="hidden" name="id_cle" value="<?php echo $bouteille['vino__bouteille_id'] ?>">
                    <input type="hidden" name="id_bouteille_cellier" id="id_bouteille_cellier" value="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" data-id="" id="nom" value="<?php echo mb_convert_encoding($bouteille['nom'], "UTF-8") ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="pays">Pays</label>
                    <input type="text" name="pays" data-id="" id="pays" value="<?php echo mb_convert_encoding($bouteille['pays'], "UTF-8") ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="format">Format</label>
                    <input type="text" name="format" data-id="" id="format" value="<?php echo $bouteille['format'] ?>">
                    
                    <label for="millesime">Millesime</label>
                    <input type="text" name="millesime" id="millesime" value="<?php echo $bouteille['millesime'] ?>">
                    
                    <label for="description">Description</label>

                    <textarea name="description" id="description"><?php echo utf8_decode($bouteille['description']) ?></textarea>

                    <label for="quantite">Quantite</label>
                    <input type="number" name="quantite" id="quantite" min="0" value="<?php echo $bouteille['quantite'] ?>">
                    <span class="champ-obligatoire-message"></span>

                    <label>Type</label>
                    <select name="types">
                        <?php for ($i = 0; $i < count($dataTypesModifier); $i++) { ?>
                            <option value="<?= $dataTypesModifier[$i]["id"]; ?>" <?php echo ((strtolower($bouteille['type']) == strtolower($dataTypesModifier[$i]["type"])) ? 'selected' : '') ?>><?= $dataTypesModifier[$i]["type"]; ?></option>
                        <?php } ?>
                    </select>
                    <span class="champ-obligatoire-message"></span>
                    <label for="prix">Prix payé</label>
                    <input type="text" name="prix" id="prix" value="<?php echo $bouteille['prix_paye'] ?>">
                    
                    <label for="garde_jusqua">A garder jusqu'au</label>

                    <input type="text" name="garde_jusqua" id="garde_jusqua" value="<?php echo utf8_decode($bouteille['garde_jusqua']) ?>">
                    
                    <label for="notes">Notes</label>
                    <input type="text" name="notes" id="notes" value="<?php echo utf8_decode($bouteille['notes']) ?>">     

                </div>
                <div class="buttons-wrapper">
                    <button type="submit" class="bouton-large vert" name="modifierBouteilleCellier">Enregistrer</button>
                    <button type="button" class="bouton-large" name="btnSupprimer">Supprimer la bouteille</button>
                </div>
            </div>
        </form>
        <div class="modal-container" id="modal-container">
            <div class="pop-up">
                <div class="form-popup" id="popupForm">
                    <form method="POST" action="index.php?requete=effacerBouteilleCellier&bteCellier=<?php echo $bouteille['id_bouteille_cellier'] ?>" class="form-container">
                    <svg id="closeFormX" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="#931818" d="M208.5 191.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0L128 145l-63.5 63.5a12.1 12.1 0 0 1-17 0a12 12 0 0 1 0-17L111 128L47.5 64.5a12 12 0 0 1 17-17L128 111l63.5-63.5a12 12 0 0 1 17 17L145 128Z"/></svg><br><br>
                        <h2>Voulez-vous supprimer cette bouteille?</h2>
                        <button type="submit" name="modifierBouteilleCellier" class="btn-boite-modale btn-oui">Oui</button>
                        <button type="button" class="btn-boite-modale btn-non" id="closeForm">Non</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>