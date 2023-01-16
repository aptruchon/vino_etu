-- Insertions de base pour travailler avec la DB

--
-- Contenu de la table `vino__type`
--
INSERT INTO `vino__type` (id, type)
VALUES
    (1, 'Rouge'),
    (2, 'Blanc');


--
-- Contenu de la table `vino__catalogue`
--
INSERT INTO `vino__catalogue` (id, nom)
VALUES
    (1, 'SAQ'),
    (2, 'Non répertorié');


--
-- Contenu de la table `vino__bouteille`
--
-- Insertion dans tous les champs
INSERT INTO `vino__bouteille` (id, nom, image, code_saq, pays, description, prix_saq, url_saq, url_img, format, vino__type_id, vino__catalogue_id)
VALUES 
    (1, 'Borsao Seleccion', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', '10324623', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', 11, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (2, 'Monasterio de Las Vinas Gran Reserva', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', '10359156', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10359156', 19, 'https://www.saq.com/page/fr/saqcom/vin-rouge/monasterio-de-las-vinas-gran-reserva/10359156', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (3, 'Castano Hecula', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', '11676671', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11676671', 12, 'https://www.saq.com/page/fr/saqcom/vin-rouge/castano-hecula/11676671', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (4, 'Campo Viejo Tempranillo Rioja', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', '11462446', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11462446', 14, 'https://www.saq.com/page/fr/saqcom/vin-rouge/campo-viejo-tempranillo-rioja/11462446', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (5, 'Bodegas Atalaya Laya 2017', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', '12375942', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12375942', 17, 'https://www.saq.com/page/fr/saqcom/vin-rouge/bodegas-atalaya-laya-2017/12375942', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (6, 'Vin Vault Pinot Grigio', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', '13467048', 'États-Unis', 'Vin blanc\r\n         \r\n      \r\n      \r\n      États-Unis, 3 L\r\n      \r\n      \r\n      Code SAQ : 13467048', NULL, 'https://www.saq.com/page/fr/saqcom/vin-blanc/vin-vault-pinot-grigio/13467048', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', ' 3 L', 2, 1),
    (7, 'Huber Riesling Engelsberg 2017', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', '13675841', 'Autriche', 'Vin blanc\r\n         \r\n      \r\n      \r\n      Autriche, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13675841', 22, 'https://www.saq.com/page/fr/saqcom/vin-blanc/huber-riesling-engelsberg-2017/13675841', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', ' 750 ml', 2, 1),
    (8, 'Dominio de Tares Estay Castilla y Léon 2015', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', '13802571', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13802571', 18, 'https://www.saq.com/page/fr/saqcom/vin-rouge/dominio-de-tares-estay-castilla-y-leon-2015/13802571', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (9, 'Tessellae Old Vines Côtes du Roussillon 2016', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', '12216562', 'France', 'Vin rouge\r\n         \r\n      \r\n      \r\n      France, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12216562', 21, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tessellae-old-vines-cotes-du-roussillon-2016/12216562', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1),
    (10, 'Tenuta Il Falchetto Bricco Paradiso -... 2015', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', '13637422', 'Italie', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Italie, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13637422', 34, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tenuta-il-falchetto-bricco-paradiso---barbera-dasti-superiore-docg-2015/13637422', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1);
-- Insertion dans les champs obligatoires seulement (test)
INSERT INTO `vino__bouteille` (id, nom, pays, vino__type_id, vino__catalogue_id)
VALUES (2, 'Vin blanc du paradis', "Canada", 2, 2);


--
-- Contenu de la table `vino__role`
--
INSERT INTO `vino__role` (id, nom)
VALUES
    (1, 'Administrateur'),
    (2, 'Utilisateur');


--
-- Contenu de la table `vino__utilisateur`
--
INSERT INTO `vino__utilisateur` (id, nom, prenom, courriel, mot_de_passe, date_inscription, confirmation, vino__role_id)
VALUES
    (1, "Swanson", "Ron", "parkBoss@pawnee.usa", "no", now(), "lkj", 1),
    (2, "Knope", "Leslie", "parkSavior@pawnee.usa", "yes", now(), "lkj", 2);


--
-- Contenu de la table `vino__cellier`
--
INSERT INTO `vino__cellier` (id, nom, vino__utilisateur_id)
VALUES
    (1, "House", 2),
    (2, "Summer House", 2),
    (3, "Restaurant", 2),
    (4, "Cabin", 1),
    (5, "Workshop", 1);


--
-- Contenu de la table `vino__cellier_contient`
--
-- Insertion dans tous les champs
INSERT INTO `vino__cellier_contient` (id, vino__cellier_id, vino__bouteille_id, date_ajout, garde_jusqua, notes, prix, quantite, millesime)
VALUES
    (1, 1, 1, now(), "Noël 2024", "Oublis pas de boire toutes les bouteilles avant Noël!", 30.99, 3, 2015),
    (2, 1, 2, now(), "Septembre 2022", "Miam!", 22.99, 3, 2021),
    (3, 1, 3, now(), "Jusqu'à ma prochaine promotion", "Tu le mérites", 59.99, 1, 2005),
    (4, 2, 4, now(), "Été 2023", "Rafraichissant", 25.99, 3, 2005),
    (5, 2, 5, now(), "Janvier 2029", "Patience", 49.99, 1, 2012),
    (6, 4, 7, now(), "4ieme pleine lune de 2023", "Vin meilleur quand la marée est basse", 44.99, 1, 2014);
-- Insertion dans les champs obligatoires seulement (test)
INSERT INTO `vino__cellier_contient` (id, vino__cellier_id, vino__bouteille_id, date_ajout, quantite)
VALUES
    (7, 4, 2, now(), 2);