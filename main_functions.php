<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 24-09-15
 * Time: 10:53
 */
require_once("private.php");
/**
* ::
 */
 $appDir = realpath(base_path("/"));

 function getDBDocument($id)
{
    $note = new \App\Note((int)$id);

    $note->load($id);

    return $note;
}
function getDocRow($noteId)
{
    global $mysqli;
    $res = simpleQ("select * from bn2_filesdata where isDeleted=0 and id=" . ((int)$noteId), $mysqli);
    if ($res != NULL) {
        return mysqli_fetch_assoc($res);
    } else {
        return FALSE;
    }
}

function getShareRow($noteId)
{
    global $mysqli;
    $res = simpleQ("select * from bn2_share where id=" . ((int)$noteId), $mysqli);
    if ($res != NULL) {
        return mysqli_fetch_assoc($res);
    } else {
        return FALSE;
    }
}
function getField($row, $fieldName)
{
    return $row[$fieldName];
}
function getFolderList($user) {
    global $mysqli;
    $sql = "select * from bn2_filesdata where isDirectory=1 and isDeleted=0 and username='" . mysqli_real_escape_string($mysqli, $user) . "'";
    $res = simpleQ($sql, $mysqli);
    return $res;
}
function getFolderName($noteId)
{
    $row = getDocRow($noteId);
    if($noteId<=0)
    {
        $noteId = getRootForUser(Auth::user()->email);
    }
    $folderName = getField($row, 'isDirectory')==1?$row['filename']:getField(getDocRow(getField($row, 'folder_id')), 'filename');
    return $folderName;
}
function getMimeType($id) {
    global $mysqli;
    connect();
    $result = getDocRow($id);
    if ($result != NULL) {
        if (($doc = mysqli_fetch_assoc($result)) != NULL) {
            return $doc["mime"];
        }
    }
}
function folder_field($folder_id, $field_name, $user) {
    ?>
<fieldset> <select name="<?php echo $field_name; ?>" class="user-control">
    <?php
    $res = getFolderList($user);
    while (($row = mysqli_fetch_assoc($res)) != NULL) {
        if ($row["id"] == $folder_id) {
            $optionSel = "selected='selected'";
        } else {
            $optionSel = "";
        }
        echo "<option value='" . $row['id'] . "' " . $optionSel . " >" . htmlspecialchars($row['filename']) . "</option>";
    }

    mysqli_free_result($res);
    ?>
    </select></fieldset><?php
    }
function listerNotesFromDB($filtre, $composed, $path, $user)
{
    $results = getDocumentsFiltered($filtre, $composed, $path, $user);
    ?>

    <div class="browserContainer">
    <div class="miniImgExternalBox">
        <div class="miniImgContainerTop"><p><strong>What's up?</p></div>
        <div class="miniImgContainer">
            <a href="<?php echo asset("note/list/" . (int)(getDBDocument($path)->folder_id) . "/1"); ?>">
                <img src='<?php echo asset("images/root-folder2.png") ?>'
                     class="miniImg" title="Aller &agrave; : Dossier sup&eacute;rieur"/>
            </a>
        </div>
        <div class="miniImgContainerBottom">
            &minus;&gt;
        </div>
    </div>
    <div class="miniImgExternalBox">
        <div class="miniImgContainerTop"><p><strong>News action</p></div>
        <div class="miniImgContainer action">
            <ul>
                <li>
                    <a href="<?php echo asset("file/uploadform/" . (int)($path)); ?>" title="Upload here">
                        <div id="upload_files">&nbsp;</div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo asset("note/new/" . $path); ?>" title="Cr&eacute;er une note ici">
                        <div id="new_note">&nbsp;</div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo asset("folder/new/" . $path); ?>" title="Cr&eacute;er un dossier ici">
                        <div id="new_folder">&nbsp;</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

<?php
    if ($results) {
        while (($row = mysqli_fetch_assoc($results))) {
            $filename = $row['filename'];
            $content = $row['content_file'];
            $id = $row['id'];
            $folder_id = $row["folder_id"];
            typeDB($filename, $content, $id, $row);
        }
    } else {
        echo "Pas de r&eacute;sultat";
    }
    ?></div><?php
}

function listerNotes_browser($user)
{
    global $mysqli;
    $results = mysqli_query($mysqli, "select * from bn2_filesdata where isDeleted=0 and username='" . mysqli_real_escape_string($mysqli, Auth::user()->email) . "';");

    while (($doc = mysqli_fetch_assoc($results)) != NULL) {
        $filename = $doc['filename'];
        $content = $doc['content_file'];
        $id = $doc['id'];
        $folder_id = $doc["folder_id"];
        typeDB_type_image($filename, $content, $id, $doc);
    }
}

function typeTxt($cf, $filePath)
{
    global $FILE_THUMB_MAXLEN;
    global $userdataurl;
    global $dataDir;
    $urlaction = "page.xhtml.php?composant=reader.txt&document=" . substr($cf, 0, -4);
    ?>
    <div class="miniImgContainer">
        <input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "TXT_" . substr($cf, 0, -4); ?>"/>
        <a draggable="true"
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

function typeImg($cf)
{
    global $userdataurl;
    global $dataDir;
    $actionurl = "page.xhtml.php?composant=reader.images&document=$cf";
    ?>
    <div class="miniImgContainer" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true"
         ondragstart="drag(event)">
        <input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "IMG_" . $cf; ?>"/>
        <a class='miniImg' href="<?= $actionurl ?>">
            <img src='<?php echo "$userdataurl/$cf"; ?>' class="miniImg">
            <span class="filename"><?php echo $cf; ?></span></a>
    </div>

    <?php
}

function typeCls($classeur, $f)
{
    global $userdataurl;
    global $dataDir;
    $actionurl = "page.xhtml.php?composant=browser&classeur=$f";
    ?>
    <div class="miniImgContainer" ondrop="drop(event)" ondragover="allowDrop(event)" draggable="true"
         ondragstart="drag(event)">
        <input class="filecheckbox" type="checkbox" name="files[]" value="<?php echo "CLASS_" . substr($f, 0, -4); ?>"/>
        <a class='miniImg' href="<?= $actionurl ?>">
            <img src='images/alphabet.png' class="miniImg">
            <span class="filename"><?php echo $classeur; ?></span>
        </a>
    </div>
    <?php
}

function typeDB($filename, $content, $id, &$rowdoc = NULL)
{
    global $config;
    $urlaction = URL::to("note/list/$id/1");
    $mime = $rowdoc["mime"];
    ?>
    <div class='miniImgExternalBox'>
        <div class="miniImgContainerTop">
        <span class="filename"><?php
                echo $rowdoc["filename"] . "|" . $rowdoc["id"];
            ?></span>
        </div>
        <div class="miniImgContainer">
            <?php
            echo \Illuminate\Support\Facades\Config::get('plus_config')['thumb_size'];
            if (isImage(getExtension($filename), $mime)) { ?>
                <img src ="<?php echo URL::to(
                asset("icone/$id/".
                (\Illuminate\Support\Facades\Config::get('app.plus_config')['thumb_size'])
)
              ); ?>"
            alt="<?= $filename ?>"/>
                <?php
            } else
                if (isTexte(getExtension($filename), $mime)) {
                    ?><span class='typeTextBlock'><?= htmlspecialchars(substr($content, 0, 500)) ?></span> <?php
                } else if ($rowdoc['isDirectory'] == 1 || $mime == "directory") {
                    ?><a href="<?= $urlaction ?>"><img
                        src='<?php echo asset("images/dossier.png") ?>' class="miniImg"
                        title="Dossier: <?php echo $filename; ?>"></a><?php
                } else {
                    ?>
                    <img src='http://www.stdicon.com/humility/<?= $mime ?>'/>
                    <?php
                }
            ?>
        </div>
        <div id="<?php echo "data$id"; ?>" class="miniImgContainerBottom">

            <img id="plus_button_<?php echo $id; ?>" onclick="showMenu('<?php echo "$id"; ?>');"
                 src="/images/plus.png" class="visible"/>
            <img id="moins_button_<?php echo $id; ?>" onclick="hideMenu('<?php echo "$id"; ?>');"
                 src="/images/moins.png" class="invisible"/>
            <ul class="onfile_actions invisible" id="ul<?php echo "$id"; ?>">
                <li><a href="<?php echo asset("note/view/" . $id) ?>">Voir</a></li>
                <!-- note/view demande un login de plus!-->
                <li><a href="<?php echo asset("note/edit/" . $id); ?>">Modifier</a></li>
                <li><a href="<?php echo asset("file/download/" . $id); ?>">T&eacute;l&eacute;charger</a></li>
                <li><a href="<?php echo asset("note/delete/" . $id); ?>">Supprimer</a></li>
            </ul>
        </div>
    </div>
<?php }

function typeDB_type_image($filename, $content, $id, &$rowdoc = NULL)
{
    $mime = $rowdoc["mime"];
    if (isImage(getExtension($filename), $mime)) { ?>

        <img src="<?php echo asset("icone/$id/60") ?>"
             alt="<?= $filename ?>" style="width; 30px; height: 30px;" onclick="insertIntoEditor(<?php echo $id ?>);"/>
        <?php
    }
}
function echoImgBase64($content, $filename)
{
    // A few settings

// Read image path, convert to base64 encoding
    $imgData = base64_encode($content);

// Format the image SRC:  data:{mime};base64,{data};
    $src = 'data: image/' . getExtension($filename) . ';base64,' . $imgData;

// Echo out a sample image($filename)
    echo '<images src="' . $src . '">';

}

function getExtension($filename)
{
    return $ext = strtolower(substr($filename, strpos($filename, '.', 0)));

}

function isImage($ext, $mime = "")
{
    return in_array($ext, array("jpg", "jpeg", "png", "gif", "bmp", "ico", "tif", "tiff")) or (($mime != "") && (strpos($mime, 'image') !== FALSE));

}

function isTexte($ext, $mime = "")
{
    return in_array($ext, array("txt")) or ($mime == "text/plain");

}


function getDocumentsFiltered($filtre, $composedOnly, $pathId, $user) {
    global $mysqli;

    if ($pathId == 0) {
        $pathId = getRootForUser($user);
    }

    $q = "SELECT * FROM bn2_filesdata " .
        "WHERE username='" . mysqli_real_escape_string($mysqli, $user) .
        "' and ((filename like '%" . mysqli_real_escape_string($mysqli, $filtre) .
        "%') or (content_file like'%" . mysqli_real_escape_string($mysqli, $filtre) .
        "%') and (content_file like '%" .
        ($composedOnly ? "{{" : "") . "%' )) and isDeleted=0 and "
        . "folder_id=" . ( (int) $pathId);

    $result = simpleQ($q, $mysqli);

    return $result;
}

function simpleQ($q, $mysqli) {


    global $mysqli;
    global $date;
    $date = date("Y-m-d-H-i-s");

    if ($mysqli == NULL) {
        connect();
    }


    $result = mysqli_query($mysqli, $q);
    return $result;

}

function connect() {
    global $mysqli;
    $config = new Config();
    global $date;
    if ($date == "") {
        $date = date("Y-m-d-H-i-s");
    }
    $hostname = trim($config->hostname);
    $username = trim($config->username);
    $password = trim($config->password);
    $dbname = trim($config->name);


    //conection:
    $mysqli = mysqli_connect($hostname, $username, $password, $dbname) or die("Error " . mysqli_error($mysqli));

    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }


    //echo 'Succ�s... ' . $mysqli->host_info . "\n";
}
function deleteNote($noteId)
{

}
function getRootForUser($user=NULL) {
    global $mysqli;
    if($user==NULL)
    {
        global $monutilisateur;

    }
    $sql = "select id from bn2_filesdata where username like '" .
        mysqli_real_escape_string($mysqli, $user)
        . "' and isRoot=1";

    $result = simpleQ($sql, $mysqli);
    if ($result) {
        if (($arr = $result->fetch_assoc())!=NULL) {
            $id = $arr['id'];
        } else {
            $id = 0;
        }
    } else {
        $id = -1;
        echo "No root for user";
    }//echo "ID;; $id";
    return $id;
}

function createRootForUser() {
    global $mysqli;
    connect();
    $sql = "insert into bn2_filesdata (filename, folder_id, isDirectory) values ('Dossier racine', -1, TRUE)";
    if (mysqli_query($mysqli, $sql)) {
        echo "Root file created";
    }
}

function deleteDBDoc($dbdoc) {
    global $mysqli;
    $sql = "update bn2_filesdata set isDeleted=1 where id=" . mysqli_real_escape_string($mysqli, $dbdoc) . " and username like '" . mysqli_real_escape_string($mysqli, Auth::user()->email) . "'";
    return simpleQ($sql, $mysqli);
}

connect();

function getParentNoteId($noteId)
{
    global $mysqli;

    $doc = getDocRow($noteId);

    return $doc['folder_id'];
}

function redimAndDisplay($data, $mimeType, $T = NULL)
{

    if ($T == NULL)
{
    $T = \Illuminate\Support\Facades\Config::get("app.plus_config")["thumb_size"];
}
$image = imagecreatefromstring($data);

$size = getimagesizefromstring ($data);

    $dst_im = imagecreatetruecolor($T, $T);

    //imagecolortransparent($dst_im, imagecolorallocate($dst_im, 0, 0, 0));
    $X1 = $size[0];
    $Y1 = $size[1];

    if ($X1 >= $Y1) {
        $X2 = $T;
        $Y2 = $T * $Y1 / $X1;
        $blank_top = ($T - $Y2) / 2;
        imagecopyresampled($dst_im, $image, 0, $blank_top, 0, 0, $T, $T - $blank_top * 2, $X1, $Y1);
    } else {
        $X2 = $T * $X1 / $Y1;
        $Y2 = $T;
        $blank_left = ($T - $X2) / 2;
        imagecopyresampled($dst_im, $image, $blank_left, 0, 0, 0, $T - $blank_left * 2, $T, $X1, $Y1);
    }
    $mimeType = "image/png";

header("Content-Type: $mimeType");
    $mimeType = strtolower($mimeType);

    if ($mimeType == "image/jpg" || $mimeType == "image/jpeg")
{
    imagejpeg($dst_im);
}
else if($mimeType=="image/png")
{
    imagepng($dst_im);

}
else if($mimeType=="image/gif")
{
    imagegif($dst_im);
}
imagedestroy($dst_im);
imagedestroy($image);


}

function search($expresion, $user = NULL, $folderId = NULL)
{
    global $mysqli;
    $terms = explode(' ', $expresion);
    $sql = 'select * from bn2_filesdata where ';
    $first = true;
    foreach ($terms as $term) {
        if (!$first) {
            $add = " and ";
        } else {
            $add = " ";
        }
        $sql .= $add . "content_file like '%" . $term . "%'";

        $sql .= " and username like '" . (Auth::user()->email) . "';'";

    }
    echo $sql;
    $result = simpleQ($sql, $mysqli);
    return $result;
}
