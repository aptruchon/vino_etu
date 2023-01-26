<div class="modifier form-page">
    <?php
    foreach ($dataModifie as $cle => $bouteille) {
    ?>
        <a href="?requete=ficheDetailsBouteille&bte=<?php echo $bouteille['vino__bouteille_id'] ?>" class="retour">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                <path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
            </svg>
        </a>
        <form method="POST" action="index.php?requete=modifierBouteilleCellier&bte=<?php echo $bouteille['vino__bouteille_id'] ?>">
            <div class="modifieBouteille" vertical layout>
                <div>
                    <input type="hidden" name="id_bouteille_cellier" id="id_bouteille_cellier" value="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" data-id="" id="nom" value="<?php echo $bouteille['nom'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="pays">Pays</label>
                    <input type="text" name="pays" data-id="" id="pays" value="<?php echo $bouteille['pays'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="format">Format</label>
                    <input type="text" name="format" data-id="" id="format" value="<?php echo $bouteille['format'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="millesime">Millesime</label>
                    <input type="text" name="millesime" id="millesime" value="<?php echo $bouteille['millesime'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="description">Description</label>
                    <textarea name="description" id="description"><?php echo $bouteille['description'] ?></textarea>
                    <span class="champ-obligatoire-message"></span>
                    <label for="quantite">Quantite</label>
                    <input type="number" name="quantite" id="quantite" value="<?php echo $bouteille['quantite'] ?>">
                    <span class="champ-obligatoire-message"></span>

                    <label>Type</label>

                    <!-- ANCIEN RADIO BUTTON TYPE VIN -->
                    <!--<div class="options-container">
                        <label for="rouge" class="radio-label">Rouge</label>
                        <input type="radio" id="rouge" name="type" value="rouge" class="radio-input" <?php echo ((strtolower($bouteille['type']) == 'rouge') ? 'checked' : '') ?>>
                        <label for="blanc" class="radio-label">Blanc</label>
                        <input type="radio" id="blanc" name="type" value="blanc" class="radio-input" <?php echo ((strtolower($bouteille['type']) == 'blanc') ? 'checked' : '') ?>>
                        <label for="rose" class="radio-label">Rosé</label>
                        <input type="radio" id="rose" name="type" value="rosé" class="radio-input" <?php echo ((strtolower($bouteille['type']) == 'rosé') ? 'checked' : '') ?>>
                    </div>-->

                    <!-- NOUVEAU SELECT OPTIONS TYPE VIN -->
                    <select name="type">
                        <?php for ($i = 0; $i < count($dataTypes); $i++) { ?>
                            <option value="<?= $dataTypes[$i]["id"]; ?>" <?php echo ((strtolower($bouteille['type']) == strtolower($dataTypes[$i]["type"])) ? 'selected' : '') ?>><?= $dataTypes[$i]["type"]; ?></option>
                        <?php } ?>
                    </select>

                    <span class="champ-obligatoire-message"></span>

                    <label for="date_achat">Date achat</label>
                    <input type="text" name="date_achat" id="date_achat" value="<?php echo $bouteille['date_ajout'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="prix">Prix payé</label>
                    <input type="number" name="prix" id="prix" value="<?php echo $bouteille['prix_paye'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="garde_jusqua">A garder jusqu'au</label>
                    <input type="text" name="garde_jusqua" id="garde_jusqua" value="<?php echo $bouteille['garde_jusqua'] ?>">
                    <span class="champ-obligatoire-message"></span>
                    <label for="notes">Notes</label>
                    <input type="text" name="notes" id="notes" value="<?php echo $bouteille['notes'] ?>">
                    <span class="champ-obligatoire-message"></span>
                </div>
                <div class="buttons-wrapper">
                    <button type="submit" class="bouton-large" name="modifierBouteilleCellier">Enregistrer</button>
                    <button type="button" class="bouton-large" name="btnSupprimer">Supprimer la bouteille</button>
                </div>
            </div>
        </form>
        <div class="modal-container" id="modal-container">
            <div class="pop-up">
                <div class="form-popup" id="popupForm">
                    <form method="POST" action="index.php?requete=effacerBouteilleCellier&bteCellier=<?php echo $bouteille['id_bouteille_cellier'] ?>" class="form-container">
                        <h2>Voulez-vous supprimer cette bouteille?</h2>
                        <button type="submit" class="btn-boite-modale btn-oui">Oui</button>
                        <button type="button" class="btn-boite-modale btn-non" id="closeForm">Non</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>