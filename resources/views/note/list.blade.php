<?php
/**
 * Created by PhpStorm.
 * User: manue_001
 * Date: 11/08/2015
 * Time: 14:12
 */
require_once(asset("Libs/event/main.php"));

$rootDoc = getRootForUser();
$root = mysqli_fetch_assoc($rootDoc);
$docs = getDocumentsFiltered("", false, $root["id"]);

       while(($doc=mysqli_fetch_assoc($docs))!=NULL)
           {
               displayNote($doc["id"]);
           }