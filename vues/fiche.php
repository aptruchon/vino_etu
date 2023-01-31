<div class="fiche">
    <?php
    foreach ($dataFiche as $cle => $bouteille) {
    ?>
        <div class="icons-container">
            <a href="<?= "?requete=cellier&cellierId=" .$_SESSION["cellierId"]; ?>" class="retour">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                    <path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
                </svg>
            </a>
            <a href="?requete=modifierBouteilleCellier&bte=<?php echo $bouteille['vino__bouteille_id'] ?>" class="retour">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                    <path fill="#931818" d="M224 76.7L179.3 32a15.9 15.9 0 0 0-22.6 0l-120 120a15.4 15.4 0 0 0-3.6 5.5l-.2.5a16 16 0 0 0-.9 5.3V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.3L224 99.3a16.1 16.1 0 0 0 0-22.6Zm-80-9.4L160.7 84L68 176.7L51.3 160ZM48 208v-28.7L76.7 208Zm48-3.3L79.3 188L172 95.3l16.7 16.7Z" />
                </svg>
            </a>
        </div>
        <section class="bouteille_container">
            <?php if ($bouteille['image']) : ?>
                <img src="https:<?php echo $bouteille['image'] ?>" onerror="this.onerror=null; this.src='./images/vin-fallback.png'">
            <?php else : ?>
                <img src="./images/vin-fallback.png">
            <?php endif; ?>
            <div class="description-container">
                <header class="page-content-header header-fiche">
                    <h2><?php echo utf8_decode($bouteille['nom']) ?></h2>
                </header>
                <!--  -->
                <?php if ($bouteille['type']) : ?>
                    <p class="type <?php echo strtolower($bouteille['type']) ?>"><?php echo $bouteille['type'] ?></p>
                <?php else : ?>
                    <p class="type"></p>
                <?php endif; ?>
                <!--  -->
                <div class="bloc-description">
                    <?php if ($bouteille['pays']) : ?>
                        <p><?php echo utf8_decode($bouteille['pays']) ?></p>
                    <?php else : ?>
                        <p></p>
                    <?php endif; ?>
                    <!--  -->
                    <?php if ($bouteille['format']) : ?>
                        <p><?php echo $bouteille['format'] ?></p>
                    <?php else : ?>
                        <p></p>
                    <?php endif; ?>
                    <!--  -->
                    <?php if ($bouteille['millesime']) : ?>
                        <p><?php echo $bouteille['millesime'] ?></p>
                    <?php endif; ?>
                </div>
                <!--  -->
                <?php if ($bouteille['description']) : ?>
                    <h4>Description</h4>
                    <p><?php echo utf8_decode($bouteille['description']) ?></p>
                <?php else : ?>
                    <p></p>
                <?php endif; ?>
                <!--  -->
                <?php if ($bouteille['date_ajout']) : ?>
                    <h4>Date d'achat</h4>
                    <p class="date_ajout"><?php echo $bouteille['date_ajout'] ?></p>
                <?php else : ?>
                    <p class="date_ajout"></p>
                <?php endif; ?>
                <!--  -->
                <?php if ($bouteille['garde_jusqua']) : ?>
                    <h4>A garder jusqu'au</h4>
                    <p class="garde_jusqua"><?php echo utf8_decode($bouteille['garde_jusqua']) ?></p>
                <?php else : ?>
                    <p class="garde_jusqua"></p>
                <?php endif; ?>
                <!--  -->
                <?php if ($bouteille['notes']) : ?>
                    <h4>Notes</h4>
                    <p class="notes"><?php echo utf8_decode($bouteille['notes']) ?></p>
                <?php else : ?>
                    <p class="notes"></p>
                <?php endif; ?>
                <!--  -->
                <div class="prix-container">
                    <div>
                        <?php if ($bouteille['prix_paye']) : ?>
                            <h4>Prix payé</h4>
                            <span class="prix"><?php echo '$ ' . $bouteille['prix_paye'] ?></span>
                        <?php else : ?>
                            <p class="prix_paye"></p>
                        <?php endif; ?>
                    </div>
                    <!--  -->
                    <div>
                        <?php if ($bouteille['prix_saq']) : ?>
                            <h4>Prix SAQ</h4>
                            <span class="prix"><?php echo '$ ' . $bouteille['prix_saq'] ?></span>
                        <?php else : ?>
                            <p class="prix_saq"></p>
                        <?php endif; ?>
                    </div>
                </div>
                <!--  -->
            </div>
        </section>
        <!-- <button class="bouton-large"><a href="?requete=modifierBouteilleCellier">Modifier</a></button> -->
    <?php
    }
    ?>
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