<link href="css/freezer.css" type="text/css" rel="stylesheet"/>
<script src="scripts/jquery-1.11.2.js"></script>
<script src="scripts/layoutActions.js"></script>
<script type="text/javascript" src="scripts/play.js">

</script>
<script src="scripts/auth.js"></script>
<script src="scripts/playlist.js"></script>
<div id="search-form-container">
    <form method="GET" action="index.php">
        <fieldset>

            <table>

                <tr>
                    <td><label>Artiste(s)</label></td>
                    <td><input type="text" name="artist" value="<?php echo filter_input(INPUT_GET, "artist") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><label>Album</label></td>
                    <td><input type="text" name="album" value="<?php echo filter_input(INPUT_GET, "album") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><label>Link to Youtube search</label></td>
                    <td><input type="checkbox" name="yt" value="<?php echo filter_input(INPUT_GET, "yt") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><label>Search for Lyrics</label></td>
                    <td><input type="checkbox" name="lyrics" value="<?php echo filter_input(INPUT_GET, "lyrics") ?>"/>
                    </td>
                </tr>
                <tr>
                    <td><label>Envoyer:</label></td>
                    <td><input type="submit" name="submit-button" value="Clic moi"/></td>
                </tr>
            </table>

        </fieldset>
    </form>
</div>
<div id="text_view">
    <?php
    require_once("php-gracenote/Gracenote.class.php");
    require_once("private.php");
    $api = new Gracenote\WebAPI\GracenoteWebAPI($clientID, $clientTag);

    $userID = $api->register();

    $artiste = filter_input(INPUT_GET, 'artist');
    $album = filter_input(INPUT_GET, 'album');

    if ($artiste == "" && $album == "") {
        exit(-1);
    }
    if ($album == "") {
        $results = $api->searchArtist($artiste);
    } else {
        $results = $api->searchAlbum($artiste, $album);
    }

    if (isset($results[0]["artist_image_url"])) {
    ?>
    <a id='authorBioNOLinkShow' onclick='montrerBioArtist("authorBioNO")'>Monter Bio artiste</a>
    <a id='authorBioNOLinkHide' onclick='cacherBioArtist("authorBioNO");'>Cacher Bio artiste</a>

    <div id='authorBioNO'/>
    <img src='<?php echo $results[0]["artist_image_url"]; ?>'>
    <?php echo file_get_contents($results[0]["artist_bio_url"]); ?>
</div>
<?php

}


$i = 0;
$j = 0;
while (isset($results[$i])) :
    global $j;
    global $i;
    $result0 = $api->fetchAlbum($results[$i]["album_gnid"]);
    ?>
    <p class="album_title"><a href="#album<?= $i ?>" onclick='montrerAlbum("album<?= $i ?>");'>
            <?= $result0[0]["album_artist_name"] ?>,
            <?= $result0[0]["album_title"] ?>-- date : <?= $results[$i]["album_year"] ?>
        </a></p>
<div class='album_view' id="album<?= $i ?>">
    <p class="album_title"><a href="#album<?= $i ?>" onclick='montrerAlbum("album<?= $i ?>");'>
            <i><?= $result0[0]["album_artist_name"] ?></i>
            <strong><?= $result0[0]["album_title"] ?></strong><?= $results[$i]["album_year"] ?>
        </a></p>
    <img src='<?= $result0[0]["album_art_url"] ?>'>
    <p class='genre_title'>Pistes</p>
    <ul>
        <?php
        foreach ($result0[0]['tracks'] as $track) {
            // again echo anything here you would like.
            ?>
            <li><?php echo $track["track_title"] ?>
                <input type='text' class='musicSpan' id='musicSpan<?php echo $j; ?>'
                       value="<?php echo $result0[0]["album_artist_name"]; ?> , <?php echo $result0[0]["album_title"]; ?> , <?php echo $track["track_title"]; ?>"/>
                <input type='button' value='Lire chanson sur Youtube'
                       onclick="playsong('<?php echo rawurlencode($result0[0]["album_artist_name"] . " " . $result0[0]["album_title"] . " " . $track["track_title"]); ?>');"/>
            </li>
            <?php
            $j++;
        }
        ?>
    </ul>
    <p class='genre_title'>Genres</p>
    <ul>
        <?php
        foreach ($result0[0]['genre'] as $genre) {
            // again echo anything here you would like.
            echo "<li>" . $genre['text'] . "</li>";
        } ?>
    </ul>
    <?php if ($results[$i]["review_url"] != "") { ?>
    <div class='album_review'>
        <p><a href="<?php echo $results[$i]["review_url"]; ?>">Album review</a></p>
        <?= file_get_contents($results[$i]["review_url"]); ?></div>
    </div>
    <?php
}
    $i++;
endwhile;
?>
<div id="#player"></div>

</div>

<div id="media_view">
    <div id="search-container">Player here</div>
    <br/><span id='query'></span>

    <div id="results"/>
</div>
<script type="text/javascript">
    mettreEnPageInitiale();
</script>
<script src="https://apis.google.com/js/client.js?onload=init"></script>
</body>


</html>
