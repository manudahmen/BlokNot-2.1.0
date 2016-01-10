<?php
/**
 * Created by PhpStorm.
 * User: Win
 * Date: 10-01-16
 * Time: 20:57
 */

namespace App\Http\Browser;


use App\Http\Controllers\Controller;

class BrowserController extends Controller
{
    /***
     * @var int Affichage du navigateur de fichier à partir d'un fichier déterminé ou
     * du fichier "racine". Recherche en base de données et sur disque.
     */
    public $MODE_NORMAL = 1;
    /***
     * @var int Affichage des fichiers partagés avec un utilisateur déterminé
     */
    public $MODE_GUEST = 2;
    /***
     * @var int Affichage en vue de sélection un fichier retour par JS ou Requête HTTP GET
     * (modalités pas encore définie)
     */
    public $MODE_SELECTION = 4;
    /***
     * @var int Idem que $MODE_SELECTION mais fichiers multiples
     */
    public $MODE_SELECTION_MULTI = 8;

    public function __construct($folderId = 0, $mode = 1)
    {

    }

    public function init()
    {

    }

    public function saveState(Request $request)
    {

    }

    public function getHTMLOfView()
    {

    }
}