-- Insertions de base pour travailler avec la DB

--
-- Contenu de la table `vino__type`
--
INSERT INTO `vino__type` (id, type)
VALUES
    (1, 'Vin rouge'),
    (2, 'Vin blanc');


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
VALUES (1, 'Borsao Seleccion', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', '10324623', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', 11, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', ' 750 ml', 1, 1);
-- Insertion dans les champs obligatoires seulement
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
    (2, "Cabin", 1);


--
-- Contenu de la table `vino__cellier_contient`
--
-- Insertion dans tous les champs
INSERT INTO `vino__cellier_contient` (id, vino__cellier_id, vino__bouteille_id, date_ajout, garde_jusqua, notes, prix, quantite, millesime)
VALUES
    (1, 1, 1, now(), "Noël 2024", "Oublis pas de boire toutes les bouteilles avant Noël!", 30.99, 3, 2015),
    (2, 1, 2, now(), "Jusqu'à ma prochaine promotion", "Tu le mérites", 59.99, 1, 2005);
-- Insertion dans les champs obligatoires seulement
INSERT INTO `vino__cellier_contient` (vino__cellier_id, vino__bouteille_id, date_ajout, quantite)
VALUES
    (2, 2, now(), 2);