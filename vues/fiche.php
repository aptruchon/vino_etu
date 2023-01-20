<div class="fiche">
    <section class="bouteille_container">  
        <img src="" alt="">
        <div class="description">
            <p class="type <?php echo strtolower($bouteille['type']) ?>"><?php echo $bouteille['type'] ?></p>          
            <p class="nom"><?php echo $bouteille['nom'] ?></p>
            <p class="pays"><?php echo $bouteille['pays'] ?></p>
            <p class="format"><?php echo $bouteille['format'] ?></p>
            <p class="millesime"><?php echo $bouteille['millesime'] ?></p>
            <p class="description"><?php echo $bouteille['description'] ?></p>
            <p class="date_ajout"><?php echo $bouteille['date_ajout'] ?></p>
            <p class="garde_jusqua"><?php echo $bouteille['garde_jusqua'] ?></p>
            <p class="notes"><?php echo $bouteille['notes'] ?></p>
            <p class="prix"><?php echo $bouteille['prix'] ?></p>
            <p class="prix_saq"><?php echo $bouteille['prix_saq'] ?></p>
        </div>
    </section> 
</div>
