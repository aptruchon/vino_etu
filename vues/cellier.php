<div class="cellier">
    <div class="menu-actions-container">
        <a class="no-underline" href="?requete=ajouterNouvelleBouteilleCellier">
            <span class="bouton-carre-label">Ajouter une bouteille</span>
            <div class="btn-rond-rouge"><i class="fa-solid fa-plus"></i></div>
        </a>
    </div>
    <section class="bouteilles-container">
        <?php
        foreach ($data as $cle => $bouteille) {
        ?>
            <div class="bouteille" data-quantite="<?php echo $bouteille['quantite'] ?>">
                <a href="?requete=ficheDetailsBouteille&bte=<?php echo $bouteille['vino__bouteille_id'] ?>">
                <div class="bouteille-img-container">
                    <img src="./images/vin-fallback.png">
                </div>
                 </a>
                <div class="description">
                    <a href="?requete=ficheDetailsBouteille&bte=<?php echo $bouteille['vino__bouteille_id'] ?>">
                        <p class="type <?php echo strtolower($bouteille['type']) ?>"><?php echo $bouteille['type'] ?></p>
                        <p class="nom"><?php echo mb_convert_encoding($bouteille['nom'], "UTF-8") ?></p>
                        <p class="pays"><?php echo mb_convert_encoding($bouteille['pays'], "UTF-8") ?></p>
                        <?php if ($bouteille['millesime'] != 0) : ?>
                            <p class="millesime">Millesime <?php echo $bouteille['millesime'] ?></p>
                        <?php endif; ?>
                    </a>
                    <div class="quantity-wrapper">
                        <div class="bouton-carre btnBoire" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                            <i class="fa-solid fa-minus btnBoire" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>"></i>
                        </div>
                        <p class="quantite"><?php echo $bouteille['quantite'] ?></p>
                        <div class="bouton-carre btnAjouter" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
                            <i class="fa-solid fa-plus btnAjouter" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</div>

<!-- FENETRE POP-UP CONFIRMATION-->

<script type="text/javascript">
    var estVisible = <?php echo $_SESSION['estVisible']; ?>;
</script>
<script src="./js/fenetreConfirmer.js"></script>

<div class="window-background <?= $_SESSION['estVisible'] ? 'show-window' : '' ; ?>" data-js-fenetre-message>
    <div class="window ">
        <?php echo $_SESSION['message']; ?></p>
        <?php $_SESSION['estVisible'] = '0'; // false en php ?>
    </div>
</div>