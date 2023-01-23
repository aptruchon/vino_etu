<div class="fiche">
    <a href="?requete=cellier" class="retour">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
            <path fill="#931818" d="M228 128a12 12 0 0 1-12 12H69l51.5 51.5a12 12 0 0 1 0 17a12.1 12.1 0 0 1-17 0l-72-72a12 12 0 0 1 0-17l72-72a12 12 0 0 1 17 17L69 116h147a12 12 0 0 1 12 12Z" />
        </svg>
    </a>
    <?php
    foreach ($data as $cle => $bouteille) {
    ?>
        <section class="bouteille_container">
            <?php if ($bouteille['image']) : ?>
                <img src="https:<?php echo $bouteille['image'] ?>">
            <?php else : ?>
                <img src="./images/vin-fallback.png">
            <?php endif; ?>
            <div class="description">
                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                <p class="nom"><?php echo $bouteille['nom'] ?></p>
                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                <p class="format">Format : <?php echo $bouteille['format'] ?></p>
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                <p class="description">Description : <?php echo $bouteille['description'] ?></p>
                <p class="date_ajout">Date ajout : <?php echo $bouteille['date_ajout'] ?></p>
                <p class="garde_jusqua">garde jusqu'a : <?php echo $bouteille['garde_jusqua'] ?></p>
                <p class="notes">Notes : <?php echo $bouteille['notes'] ?></p>
                <p class="prix">Prix payé : <?php echo '$ ' . $bouteille['prix_paye'] ?></p>
                <p class="prix_saq">Prix SAQ : <?php echo '$ ' . $bouteille['prix_saq'] ?></p>
            </div>
        </section>
        <a href="?requete=modifierBouteilleCellier&bte=<?php echo $bouteille['vino__bouteille_id'] ?>">Modifier</a>
    <?php
    }
    ?>

</div>