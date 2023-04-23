<?php

/***************************************************/
/** Fichier de configuration, contient les define et l'autoloader **/
/***************************************************/
require_once('./dataconf.php');
require_once("./config.php");

/***************************************************/
/** Initialisation des variables **/
/***************************************************/
require_once("./var.init.php");

/***************************************************/
/** Démarrage du controleur **/
/***************************************************/
$oCtl = new Controller();
$oCtl->router();
