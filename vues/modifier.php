<div class="modifier">
    <div class="modifieBouteille" vertical layout>
        <div>
            <label for="nom">Nom</label>
            <input type="text" class="nom" name="nom" data-id="" id="nom">
            <span class="champ-obligatoire-message"></span>
            <label for="pays">Pays</label>
            <input type="text" class="pays" name="pays" data-id="" id="pays">
            <span class="champ-obligatoire-message"></span>
            <label for="format">Format</label>
            <input type="text" class="format" name="format" data-id="" id="format">
            <span class="champ-obligatoire-message"></span>
            <label for="millesime">Millesime</label>
            <input type="text" name="millesime" id="millesime">
            <span class="champ-obligatoire-message"></span>
            <label for="quantite">Quantite</label>
            <input type="number" name="quantite" id="quantite" value="1">
            <span class="champ-obligatoire-message"></span>
            <div class="form-select">
            <label for="type">Type:</label>
            <select id="type" name="type">
                <option value="rouge">Rouge</option>
                <option value="blanc">Blanc</option>
            </select>
            </div>
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

