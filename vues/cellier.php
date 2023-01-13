<div class="cellier">
    <header class="page-content-header"> 
        <h2>Mon cellier</h2>
    </header> 
    <div class="menu-actions-container">
        <a class="no-underline" href="?requete=ajouterNouvelleBouteilleCellier">
            <span class="bouton-carre-label">Ajouter une bouteille</span>
            <div class="bouton-carre"><i class="fa-solid fa-plus"></i></div>    
        </a>
    </div>
    <section class="bouteilles-container">  
    <?php
    foreach ($data as $cle => $bouteille) {

        ?>
        <div class="bouteille" data-quantite="">
            <div class="bouteille-img-container">
                <img src="https:<?php echo $bouteille['image'] ?>">
            </div>
            <div class="description">
                <p class="type"><?php echo $bouteille['type'] ?></p>          
                <p class="nom"><?php echo $bouteille['nom'] ?></p>
                <p class="pays"><?php echo $bouteille['pays'] ?></p>
                <p class="millesime">Millesime <?php echo $bouteille['millesime'] ?></p>
                <div class="quantity-wrapper">
                    <div class="bouton-carre btnBoire"><i class="fa-solid fa-minus"></i></div>
                    <p class="quantite"><?php echo $bouteille['quantite'] ?></p>
                    <div class="bouton-carre btnAjouter"><i class="fa-solid fa-plus"></i></div>
                </div>
            </div>
        </div>
    <?php


    }

    ?>	
    </section> 
</div>


