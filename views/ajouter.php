<div class="form-page">
    <input type="text" hidden name="cellierId" id="<?= $_SESSION["cellierId"]; ?>">
    <div class="actions-container-ajout">
        <a href="?requete=cellier&cellierId=<?php echo $_SESSION["cellierId"]; ?>" class="retour">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z"/></svg>
        </a>
    <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256" data-js-efface><path fill="currentColor" d="M216 203.8h-76l27.9-27.9l56.6-56.6a27.9 27.9 0 0 0 0-39.5l-45.3-45.3a28.1 28.1 0 0 0-39.6 0L83.1 91.1l-56.6 56.5a28.1 28.1 0 0 0 0 39.6l37.1 37.1a11.7 11.7 0 0 0 8.5 3.5H216a12 12 0 0 0 0-24ZM156.6 51.5a4 4 0 0 1 5.7 0l45.2 45.2a4 4 0 0 1 0 5.7l-48.1 48.1l-50.9-51Zm-50.5 152.3H77l-33.5-33.5a4 4 0 0 1 0-5.7l48.1-48.1l50.9 50.9Z"/></svg>
    </span>
    </div>
    <div class="nouvelleBouteille" vertical layout>
        <input type="text" name="nom_bouteille" placeholder="Recherche...">
        <ul class="listeAutoComplete">

        </ul>
        <div class="input-container">
            <label for="nom">Nom</label>
            <input type="text" name="nom" data-id="" id="nom" required>
            <span class="champ-obligatoire-message"></span>

            <label for="pays">Pays</label>
            <input type="text" name="pays" data-id="" id="pays" required>
            <span class="champ-obligatoire-message"></span>

            <label for="format">Format</label>
            <input type="text" name="format" data-id="" id="format">
            <span class="champ-obligatoire-message"></span>

            <label for="millesime">Millésime</label>
            <input type="number" name="millesime" id="millesime">
            <span class="champ-obligatoire-message"></span>
            
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            <span class="champ-obligatoire-message"></span>

            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" value="1" min="0" required>
            <span class="champ-obligatoire-message"></span>

            <label>Type</label>
            <select name="types" required>
                <option name="" value="" id="">Choisir</option>
                <?php for($i = 0; $i < count($dataTypes); $i++){ ?>
                    <option name="" value="<?= $dataTypes[$i]["type"]; ?>" id="<?= $dataTypes[$i]["id"]; ?>"><?= $dataTypes[$i]["type"]; ?></option>
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


