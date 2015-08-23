<?php
require_once(__DIR__."/../../all-configured-and-secured-included.php");
function listerTout($classeur) {
    global $dataDir;
    $dirh = opendir($dataDir . "/" . $classeur);
    while (($f = readdir($dirh)) != NULL) {
        if ((strtolower(substr($f, 0, 5)) == "class") && is_dir($dataDir."/".$f)) {
            if(substr($classeur, -1)=="/")
            {
                $f = substr($f, -1);
            }
            typeCls(substr($f, 5), $f);
        }
        else if (strtolower(substr($f, -4)) == ".png"
                or strtolower(substr($f, -4) == ".jpg")) {
            typeImg((($classeur=="")?"":$classeur. "/" ) . $f);
        } else if (strtolower(substr($f, -4)) == ".txt") {
            $filePath = $dataDir . "/" . $classeur ."/" .$f;
            typeTxt((($classeur=="")?"":$classeur. "/" ) . $f, $filePath);
        }
    }
}
function listerNotesFromDB($filtre, $composed, $path, $user){
    $results = getDocumentsFiltered($filtre, $composed, $path, $user);
    ?>
    <div class="browserContainer">
    <div  class="miniImgExternalBox">
        <div class="miniImgContainerTop"><p><strong>Répertoire parent (..)</p></div>
        <div class="miniImgContainer">
            <a href="<?php echo asset("note/list/".(int)(getParentNoteId($path))."/1"); ?>">
                <img src='<?php echo asset("lib/bloc-notes/images/dossier-gris.png") ?>'
                    class="miniImg" alt="Icône dossier par défaut" />
            </a>
        </div>
    <div class="miniImgContainerBottom">
        &minus;&gt;
    </div>
    </div>
    <?php
    if($results) {
    while (($row=  mysqli_fetch_assoc($results))) {
        $filename = $row['filename'];
        $content = $row['content_file'];
        $id = $row['id'];
        $folder_id =  $row["folder_id"];
        typeDB($filename, $content, $id, $row);
    }
    }
    else
    { 
        echo "Pas de résultat";
    }
    ?></div><?php
}
function typeTxt($cf, $filePath) {
    global $FILE_THUMB_MAXLEN;
    global $userdataurl;
    global $dataDir;
    $urlaction = "page.xhtml.php?composant=reader.txt&document=" . substr($cf, 0, -4);
    ?>
<div class="miniImgContainer">
<input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "TXT_".substr($cf, 0, -4); ?>" />
    <a  draggable="true"
        ondragstart="drag(event)" class='miniImg' href="<?= $urlaction ?>">
        <div class="miniImg">
            <?php echo file_get_contents($filePath, null, null, 0, 500); ?>
        </div>
        <span class="filename">
            <?php echo substr(getDocumentFromFullname($cf), 0, -4); ?>
        </span>
    </a>
</div>
    <?php
}

function typeImg($cf) {
    global $userdataurl;
    global $dataDir;
    $actionurl = "page.xhtml.php?composant=reader.img&document=$cf";
    ?>
<div class="miniImgContainer" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true"
        ondragstart="drag(event)" >
<input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "IMG_".$cf; ?>" />
    <a   class='miniImg'  href="<?= $actionurl ?>">
        <img src='<?php echo  "$userdataurl/$cf"; ?>' class="miniImg">
        <span class="filename"><?php echo $cf; ?></span></a>
</div>

        <?php
    }

    function typeCls($classeur, $f) {
        global $userdataurl;
        global $dataDir;
        $actionurl = "page.xhtml.php?composant=browser&classeur=$f";
        ?>
<div class="miniImgContainer" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true"
        ondragstart="drag(event)" >
<input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "CLASS_".substr($f, 0, -4); ?>" />
    <a class='miniImg'  href="<?= $actionurl ?>">
        <img src='images/alphabet.png' class="miniImg">
        <span class="filename"><?php echo $classeur; ?></span>
    </a>
</div>
    <?php
}
function typeDB($filename, $content, $id, &$rowdoc = NULL) {
    $urlaction = URL::to("note/list/$id/1");
    $mime = $rowdoc["mime"];
    ?>
<div class='miniImgExternalBox' >
    <div class="miniImgContainerTop">
        <span class="filename"><em><?php
                echo $rowdoc["filename"]."|".$rowdoc["id"];
                ?></em></span>
    </div>
    <div class="miniImgContainer" >
    <?php
            if(isImage(getExtension($filename), $mime))
            { ?>
            <img src ="<?php echo URL::to("file/view/$id"); ?>
            alt="<?= $filename ?>"/>
            <?php
            } else
                if(isTexte(getExtension($filename), $mime)) {
     ?><span class='typeTextBlock'><?= htmlspecialchars(substr($content, 0, 500)) ?></span> <?php
                } else if($rowdoc['isDirectory']==1 || $mime=="directory") {
?><a href="<?= $urlaction ?>"><img src='<?php echo asset("lib/bloc-notes/images/dossier-gris.png") ?>' class="miniImg" alt="Icône dossier par défaut"></a><?php
} else {
?>
    <img src='http://www.stdicon.com/humility/<?= $mime ?>'/>
<?php
}
?>
</div>
<div id="<?php echo "data-$id"; ?>" class="miniImgContainerBottom">
<a href="<?php echo asset("file/view/".$id) ?>">Voir</a>
    <label>Actions</label><ul class="onfile_actions">
        <li><a href="<?php echo asset("note/edit/".$id) ; ?>">Modifier</a></li>
        <li><a href="<?php echo asset("file/download/".$id) ; ?>">T&eacute;l&eacute;charger</a></li>
        <li>Supprimer</li>
        <li>Déplacer</li>
    </ul>
</div>
</div>
    <?php }
function echoImgBase64($content, $filename)
{
                    // A few settings

// Read image path, convert to base64 encoding
$imgData = base64_encode($content);

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: image/'.  getExtension($filename).';base64,'.$imgData;

// Echo out a sample image($filename)
echo '<img src="'.$src.'">';

}
function getExtension($filename)
{
 return $ext = strtolower(substr($filename, -3));
   
}
function isImage($ext, $mime="")
{
    return in_array($ext, array("jpg","png","gif","bmp")) or (($mime!="")&&(substr($mime, 0, 5)=="image"));
   
}
function isTexte($ext, $mime="")
{
    return in_array($ext, array("txt")) or ($mime=="text/plain");
   
}

