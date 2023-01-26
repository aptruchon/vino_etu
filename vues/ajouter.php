<div class="form-page">
    <a href="?requete=cellier" class="retour">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z"/></svg>
    </a>
    <div class="nouvelleBouteille" vertical layout>
        <input type="text" name="nom_bouteille" placeholder="Recherche...">
        <ul class="listeAutoComplete">

        </ul>
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" data-id="" id="nom" required>
            <span class="champ-obligatoire-message"></span>

            <label for="pays">Pays</label>
            <input type="text" name="pays" data-id="" id="pays" required>
            <span class="champ-obligatoire-message"></span>

            <label for="format">Format</label>
            <input type="text" name="format" data-id="" id="format">
            <span class="champ-obligatoire-message"></span>

            <label for="millesime">Millesime</label>
            <input type="text" name="millesime" id="millesime">
            <span class="champ-obligatoire-message"></span>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            <span class="champ-obligatoire-message"></span>

            <label for="quantite">Quantite</label>
            <input type="number" name="quantite" id="quantite" value="1" required>
            <span class="champ-obligatoire-message"></span>

            <label>Type</label>
            <select required>
                <?php for($i = 0; $i < count($dataTypes); $i++){ ?>
                    <option name="type" value="<?= $dataTypes[$i]["type"]; ?>" id="<?= $dataTypes[$i]["id"]; ?>"><?= $dataTypes[$i]["type"]; ?></option>
                <?php } ?>
            </select>
            <span class="champ-obligatoire-message"></span>

            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix">
            <span class="champ-obligatoire-message"></span>

            <label for="garde_jusqua">A garder jusqu'au</label>
            <input type="text" name="garde_jusqua" id="garde_jusqua">
            <span class="champ-obligatoire-message"></span>

            <label for="notes">Notes</label>
            <input type="text" name="notes" id="notes">
            <span class="champ-obligatoire-message"></span>
        </div>
        <button class="bouton-large" name="ajouterBouteilleCellier">Ajouter la bouteille</button>
    </div>
</div>


