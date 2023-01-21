<?php

/**
 * Class MonSQL
 * Classe qui génère ma connection à MySQL à travers un singleton
 *
 *
 * @author Jonathan Martel
 * @version 1.0
 *
 *
 *
 */
class SAQ extends Modele
{

    const DUPLICATION = 'duplication';
    const ERREURDB = 'erreurdb';
    const INSERE = 'Nouvelle bouteille insérée';

    private static $_webpage;
    private static $_status;
    private $stmtBouteille;
    private $stmtType;

    public function __construct()
    {
        parent::__construct();
        $mysqli = $this->_db;
        if (!($this->stmtBouteille = $this->_db->prepare("INSERT INTO vino__bouteille(nom, vino__type_id, image, code_saq, pays, description, prix_saq, url_saq, url_img, format, vino__catalogue_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) || !($this->stmtType = $this->_db->prepare("INSERT INTO vino__type(id, type) VALUES (?, ?)"))) {
            echo "Echec de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    /**
     * Va chercher les produits sur le site de la SAQ
     * @param int $nombre
     * @param int $debut
     */
    public function getProduits($nombre = 24, $page = 1)
    {
        $s = curl_init();
        // $url = "https://www.saq.com/fr/produits/vin/vin-rouge?p=" . $page . "&product_list_limit=" . $nombre . "&product_list_order=name_asc";
        // $url = "https://www.saq.com/fr/produits/vin?p=" . $page . "&product_list_limit=" . $nombre . "&product_list_order=name_asc";
        $url = "https://www.saq.com/fr/produits?p=" . $page . "&product_list_limit=" . $nombre . "&product_list_order=name_asc";
        //curl_setopt($s, CURLOPT_URL, "http://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?searchType=&orderBy=&categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=".$debut."&tri=&metaData=YWRpX2YxOjA8TVRAU1A%2BYWRpX2Y5OjE%3D&pageSize=". $nombre ."&catalogId=50000&searchTerm=*&sensTri=&pageView=&facet=&categoryId=39919&storeId=20002");
        //curl_setopt($s, CURLOPT_URL, "https://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=" . $debut . "&pageSize=" . $nombre . "&catalogId=50000&searchTerm=*&categoryId=39919&storeId=20002");
        //curl_setopt($s, CURLOPT_URL, $url);
        //curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($s, CURLOPT_CUSTOMREQUEST, 'GET');
        //curl_setopt($s, CURLOPT_NOBODY, false);
        //curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

        // Se prendre pour un navigateur pour berner le serveur de la saq...
        curl_setopt_array($s, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0',
            CURLOPT_ENCODING => 'gzip, deflate',
            CURLOPT_HTTPHEADER => array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: en-US,en;q=0.5',
                'Accept-Encoding: gzip, deflate',
                'Connection: keep-alive',
                'Upgrade-Insecure-Requests: 1',
            )
        ));

        self::$_webpage = curl_exec($s);
        self::$_status = curl_getinfo($s, CURLINFO_HTTP_CODE);
        curl_close($s);

        $doc = new DOMDocument();
        $doc->recover = true;
        $doc->strictErrorChecking = false;
        @$doc->loadHTML(self::$_webpage);
        $elements = $doc->getElementsByTagName("li");
        $i = 0;
        foreach ($elements as $key => $noeud) {
            //var_dump($noeud -> getAttribute('class')) ;
            //if ("resultats_product" == str$noeud -> getAttribute('class')) {
            if (strpos($noeud->getAttribute('class'), "product-item") !== false) {

                //echo $this->get_inner_html($noeud);
                $info = self::recupereInfo($noeud);

                // Certains des articles comme les tires-bouchons n'ont pas de type et causaient une erreur
                if(isset($info->desc->type)){
                    $espaces = strpos($info->desc->type, " ", 0);

                    if($espaces != false){
                        $premierMotType = explode(" ", $info->desc->type)[0];
                    } else {
                        $premierMotType = $info->desc->type;
                    }

                    if($premierMotType == "Vin" || $premierMotType == "Champagne"){
                        echo "<p>" . $info->nom . " (" . $info->prix . ")";
                        $retour = $this->ajouteProduit($info);
                        echo "<br>Code de retour : " . $retour->raison . "<br>";
                        if ($retour->succes == false) {
                            echo "<pre>";
                            var_dump($info);
                            echo "</pre>";
                            echo "<br>";
                        } else {
                            $i++;
                        }
                        echo "</p>";
                    }
                }
            }
        }

        return $i;
    }


    /**
     * Retourne l'inner html d'un noeud
     * @param object $node
     */
    private function get_inner_html($node)
    {
        $innerHTML = '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $innerHTML .= $child->ownerDocument->saveXML($child);
        }

        return $innerHTML;
    }

    
    /**
     * Enlève les espaces vides d'une chaine
     * @param string $chaine
     */
    private function nettoyerEspace($chaine)
    {
        return preg_replace('/\s+/', ' ', $chaine);
    }


    /**
     * Récupère les informations de chaques vins
     * @param object $noeud
     */
    private function recupereInfo($noeud)
    {
        $info = new stdClass();
        $info->img = $noeud->getElementsByTagName("img")->item(0)->getAttribute('src'); //TODO : Nettoyer le lien
        ;
        $a_titre = $noeud->getElementsByTagName("a")->item(0);
        $info->url = $a_titre->getAttribute('href');

        $nom = $noeud->getElementsByTagName("a")->item(1)->textContent;

        $info->nom = self::nettoyerEspace(trim($nom));

        // Type, format et pays
        $aElements = $noeud->getElementsByTagName("strong");
        foreach ($aElements as $node) {
            if ($node->getAttribute('class') == 'product product-item-identity-format') {
                $info->desc = new stdClass();
                $info->desc->texte = $node->textContent;
                $info->desc->texte = self::nettoyerEspace($info->desc->texte);
                $aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
                if (count($aDesc) == 3) {

                    $info->desc->type = trim($aDesc[0]);
                    $info->desc->format = trim($aDesc[1]);
                    $info->desc->pays = trim($aDesc[2]);
                }

                $info->desc->texte = trim($info->desc->texte);
            }
        }

        //Code SAQ
        $aElements = $noeud->getElementsByTagName("div");
        foreach ($aElements as $node) {
            if ($node->getAttribute('class') == 'saq-code') {
                if (preg_match("/\d+/", $node->textContent, $aRes)) {
                    $info->desc->code_SAQ = trim($aRes[0]);
                }
            }
        }

        $aElements = $noeud->getElementsByTagName("span");
        foreach ($aElements as $node) {
            if ($node->getAttribute('class') == 'price') {
                $info->prix = trim($node->textContent);
            }
        }

        return $info;
    }


    /**
     * Ajoute un type non-existant à la BD
     * @param string $dernierId
     * @param string $typeManquant
     */
    private function ajoutTypeDB($dernierId, $typeManquant)
    {
        $nouveauId = intval($dernierId) + 1;
        $this->stmtType->bind_param("is", $nouveauId, $typeManquant);
        return $this->stmtType->execute();

    }


    /**
     * Ajoute une bouteille à la BD
     * @param object $bte
     */
    private function ajouteProduit($bte)
    {
        $retour = new stdClass();
        $retour->succes = false;
        $retour->raison = '';

        // Vérifie si le type commence par "vin" avant de formater (Par exemple, si c'est un champagne, on ignore le formatage)
        if(substr($bte->desc->type, 0 , 3) == "Vin"){
            // Récupère le type et le formate pour qu'il corresponde aux types de la DB ("Rouge, Blanc..." au lieu de "Vin rouge, Vin blanc..." )
            $bte->desc->type = ucfirst(explode("Vin ", $bte->desc->type)[1]);
        }

        // Rassembler tous les types déjà présent dans la DB
        $rowsType = $this->_db->query("select * from vino__type");

        if ($rowsType->num_rows > 0) {
            $typePresent = false;
            
            // Déterminer si le type de la nouvelle bouteille est manquant ou non
            while($rowType = $rowsType->fetch_assoc()) {
                if($rowType["type"] == $bte->desc->type) {
                    $typePresent = true;
                } else {
                    $typeManquant = $bte->desc->type;
                    $dernierId = $rowType["id"];
                }
            }
        }
        
        // Si le type de la bouteille provenant de la SAQ n'existe pas dans vino__type, on l'insère avant de procéder à aller chercher son ID
        if($typePresent == false) {
            $reussite = $this->ajoutTypeDB($dernierId, $typeManquant);
        }

        // Aller chercher l'id dans du type de la nouvelle bouteille
        $rows = $this->_db->query("select id from vino__type where type = '" . $bte->desc->type . "'");
        if ($rows->num_rows == 1) {
            $type = $rows->fetch_assoc();
            $type = $type['id'];
            
            // Vérifier si la bouteille est déjà dans la DB
            $rows = $this->_db->query("select id from vino__bouteille where code_saq = '" . $bte->desc->code_SAQ . "'");
            if ($rows->num_rows < 1) {
                $catalogueId = 1;
                // Change la string pour un float avec une virgule au lieu d'un point
                $bte->prix = floatval(str_replace(",", ".", strval($bte->prix)));
                $this->stmtBouteille->bind_param("sissssdsssi", $bte->nom, $type, $bte->img, $bte->desc->code_SAQ, $bte->desc->pays, $bte->desc->texte, $bte->prix, $bte->url, $bte->img, $bte->desc->format, $catalogueId);
                $retour->succes = $this->stmtBouteille->execute();
                $retour->raison = self::INSERE;
            } else {
                $retour->succes = false;
                $retour->raison = self::DUPLICATION;
            }
        } else {
            $retour->succes = false;
            $retour->raison = self::ERREURDB;
        }
        return $retour;
    }
}