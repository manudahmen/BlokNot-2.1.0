<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 24-09-15
 * Time: 10:53
 */
require_once("private");
/**
* ::
 */
 $appDir = realpath(base_path("/"));
 /*
Class Config
{
    public $hostname;
    public $username;
    public $password;
    public $name;
    public $tableUsers;
    public $tableItem;
    public $tablePrefix;
}

$config = new Config();
*/
function getDBDocument($id)
{
    $note = new \App\Note((int)$id);

    $note->load($id);

    return $note;
}
function getDocRow($noteId)
{
global $mysqli;
    return simpleQ("select * from bn2_filesdata where id=" . ((int)$noteId), $mysqli);
}
function getField($row, $fieldName)
{
    return $row[$fieldName];
}
function getFolderList($user) {
    global $mysqli;
    $sql = "select * from bn2_filesdata where isDirectory=1 and username='" . mysqli_real_escape_string($mysqli, $user) . "'";
    $res = simpleQ($sql, $mysqli);
    return $res;
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
    </select><fieldset><?php
    }
function listerNotesFromDB($filtre, $composed, $path, $user)
{
    $results = getDocumentsFiltered($filtre, $composed, $path, $user);
    ?>
    <div class="browserContainer">
    <div class="miniImgExternalBox">
        <div class="miniImgContainerTop"><p><strong>R�pertoire parent (..)</p></div>
        <div class="miniImgContainer">
            <a href="<?php echo asset("note/list/" . (int)(getDBDocument($path)->folder_id) . "/1"); ?>">
                <img src='<?php echo asset("images/system-icone-4272-128.png") ?>'
                     class="miniImg" alt="Ic&ocirc;ne dossier par d&eacute;faut"/>
            </a>
        </div>
        <div class="miniImgContainerBottom">
            &minus;&gt;
        </div>
    </div>
    <div class="miniImgExternalBox">
        <div class="miniImgContainerTop"><p><strong>Nouveaux</p></div>
        <div class="miniImgContainer">
            <ul>
                <li><a href="<?php echo asset("file/uploadform/" . (int)($path)); ?>">Uploader un fichier ici
                    </a></li>
                <li><a href="<?php echo asset("note/new/" . $path); ?>">Cr&eacute;er une note ici
                    </a></li>
            </ul>
        </div>
        <div class="miniImgContainerBottom">
            &minus;&gt;
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
        echo "Pas de r�sultat";
    }
    ?></div><?php
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
    $urlaction = URL::to("note/list/$id/1");
    $mime = $rowdoc["mime"];
    ?>
    <div class='miniImgExternalBox'>
        <div class="miniImgContainerTop">
        <span class="filename"><em><?php
                echo $rowdoc["filename"] . "|" . $rowdoc["id"];
                ?></em></span>
        </div>
        <div class="miniImgContainer">
            <?php
            if (isImage(getExtension($filename), $mime)) { ?>
                <img src ="<?php echo URL::to("file/view/$id"); ?>
            alt="<?= $filename ?>"/>
                <?php
            } else
                if (isTexte(getExtension($filename), $mime)) {
                    ?><span class='typeTextBlock'><?= htmlspecialchars(substr($content, 0, 500)) ?></span> <?php
                } else if ($rowdoc['isDirectory'] == 1 || $mime == "directory") {
                    ?><a href="<?= $urlaction ?>"><img
                        src='<?php echo asset("images/system-icone-4272-128.png") ?>' class="miniImg"
                        alt="Ic�ne dossier par d�faut"></a><?php
                } else {
                    ?>
                    <img src='http://www.stdicon.com/humility/<?= $mime ?>'/>
                    <?php
                }
            ?>
        </div>
        <div id="<?php echo "data-$id"; ?>" class="miniImgContainerBottom">

            <label>Actions</label>
            <ul class="onfile_actions">
                <li><a href="<?php echo asset("note/view/" . $id) ?>">Voir</a></li>
                <!-- note/view demande un login de plus!-->
                <li><a href="<?php echo asset("note/edit/" . $id); ?>">Modifier</a></li>
                <li><a href="<?php echo asset("file/download/" . $id); ?>">T&eacute;l&eacute;charger</a></li>
                <li><a href="<?php echo asset("note/delete/" . $id); ?>">Supprimer</a></li>
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
    $src = 'data: image/' . getExtension($filename) . ';base64,' . $imgData;

// Echo out a sample image($filename)
    echo '<images src="' . $src . '">';

}

function getExtension($filename)
{
    return $ext = strtolower(substr($filename, -3));

}

function isImage($ext, $mime = "")
{
    return in_array($ext, array("jpg", "png", "gif", "bmp")) or (($mime != "") && (strpos($mime, 'image') !== FALSE));

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
    return mysqli_query($mysqli, $q);
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
        echo "Fichier racine cr��";
    }
}

function deleteDBDoc($dbdoc) {
    global $mysqli;
    global $monutilisateur;
    $sql = "update bn2_filesdata set isDeleted=1 where id=" . mysqli_real_escape_string($mysqli, $dbdoc) . " and username='" . mysqli_real_escape_string($mysqli, $monutilisateur) . "'";
    return simpleQ($sql, $mysqli);
}

connect();

function getParentNoteId($path)
{
    global $mysqli;

    $sql = "select folder_id where id=".$path;
    if (($result=simpleQ($sql, $mysqli))!=NULL) {

        return mysqli_fetch_assoc($result)["folder_id"];
    }

}
