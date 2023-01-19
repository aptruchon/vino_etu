<div class="modifier">
    <header class="page-content-header"> 
        <h2>Modifier une bouteille</h2>
    </header> 
    <a href="?requete=accueil" class="retour">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z"/></svg>
    </a>
    <div class="modifieBouteille" vertical layout>
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" data-id="" id="nom">
            <span class="champ-obligatoire-message"></span>
            <label for="pays">Pays</label>
            <input type="text" name="pays" data-id="" id="pays">
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
            <input type="number" name="quantite" id="quantite" value="1">
            <span class="champ-obligatoire-message"></span>
            <label>Type</label>
            <div class="options-container">
                <input type="radio" id="rouge" name="type" value="rouge" class="radio-input">
                <label for="rouge" class="radio-label">Rouge</label><br>
                <input type="radio" id="blanc" name="type" value="blanc" class="radio-input">
                <label for="blanc" class="radio-label">Blanc</label><br>
                <input type="radio" id="rose" name="type" value="rose" class="radio-input">
                <label for="rose" class="radio-label">Rosé</label><br>
            </div>
            <span class="champ-obligatoire-message"></span>
            <label for="date_achat">Date achat</label>
            <input type="text" name="date_achat" id="date_achat">
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
        <button class="bouton-large" name="modifierBouteilleCellier">Enregistrer</button>
        <button class="bouton-large" name="btnSupprimer">Supprimer la bouteille</button>
    </div>
    <div class="modal-container" id="modal-container">
        <div class="pop-up">
        <div class="form-popup" id="popupForm">
            <form action="/action_page.php" class="form-container">
            <h2>Voulez-vous supprimer cette bouteille?</h2>
            <button type="submit" class="bouton-large btn-oui">Oui</button>
            <button type="button" class="bouton-large btn-non" id="closeForm">Non</button>
            </form>
        </div>
        </div>
    </div>
</div>

