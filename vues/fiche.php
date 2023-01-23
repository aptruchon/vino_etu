<div class="fiche">
    <div class="icons-container">
        <a href="?requete=cellier" class="retour">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z"/></svg>
        </a>
        <a href="?requete=modifierBouteilleCellier" class="retour">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill="#931818" d="M224 76.7L179.3 32a15.9 15.9 0 0 0-22.6 0l-120 120a15.4 15.4 0 0 0-3.6 5.5l-.2.5a16 16 0 0 0-.9 5.3V208a16 16 0 0 0 16 16h168a8 8 0 0 0 0-16H115.3L224 99.3a16.1 16.1 0 0 0 0-22.6Zm-80-9.4L160.7 84L68 176.7L51.3 160ZM48 208v-28.7L76.7 208Zm48-3.3L79.3 188L172 95.3l16.7 16.7Z"/></svg>
        </a>
    </div>
    <?php
    foreach ($data as $cle => $bouteille) {
    ?>
    <section class="bouteille_container">  
        <?php if ($bouteille['image']) : ?>
            <img src="https:<?php echo $bouteille['image'] ?>">
            <?php else : ?>
                <img src="./images/vin-fallback.png">
                <?php endif; ?>
        <div class="description-container">
            <header class="page-content-header"> 
                <h2><?php echo $bouteille['nom'] ?></h2>
            </header> 
            <!--  -->
            <?php if ($bouteille['type']) : ?>
                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
            <?php else : ?>
                <p class="type"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['pays']) : ?>
                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
            <?php else : ?>
                <p class="pays"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['format']) : ?>
                <p class="format">Format : <?php echo $bouteille['format'] ?></p>
            <?php else : ?>
                <p class="format"></p>
            <?php endif; ?>
            <!--  -->
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>

            <?php if ($bouteille['description']) : ?>
                <p class="description">Description : <?php echo $bouteille['description'] ?></p>
            <?php else : ?>
                <p class="description"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['date_ajout']) : ?>
                <p class="date_ajout">Date d'achat : <?php echo $bouteille['date_ajout'] ?></p>
            <?php else : ?>
                <p class="date_ajout"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['garde_jusqua']) : ?>
                <p class="garde_jusqua">Gardé jusqu'a : <?php echo $bouteille['garde_jusqua'] ?></p>
            <?php else : ?>
                <p class="garde_jusqua"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['notes']) : ?>
                <p class="notes">Notes : <?php echo $bouteille['notes'] ?></p>
            <?php else : ?>
                <p class="notes"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['prix_paye']) : ?>
            <p class="prix">Prix payé : <?php echo '$ ' . $bouteille['prix_paye'] ?></p>
            <?php else : ?>
                <p class="prix_paye"></p>
            <?php endif; ?>
            <!--  -->
            <?php if ($bouteille['prix_saq']) : ?>
            <p class="prix_saq">Prix SAQ : <?php echo '$ ' . $bouteille['prix_saq'] ?></p>
            <?php else : ?>
                <p class="prix_saq"></p>
            <?php endif; ?>
            <!--  -->
        </div>
    </section> 
    <!-- <button class="bouton-large"><a href="?requete=modifierBouteilleCellier">Modifier</a></button> -->
    <?php
    }
    ?>
</div>