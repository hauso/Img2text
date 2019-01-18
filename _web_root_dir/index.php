<?php
/**
 * @author Tomas Domanik
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title>Tomas Domanik Magento Developer</title>
    <meta name="description" content="Tomas Domanik PHP Magento Web Developer">
    <meta name="author" content="Tomas Domanik">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://platform.linkedin.com/badges/js/profile.js" async defer></script>

</head>
<body>
<style>
    div.background {
        position: absolute;
        top: 0px;
        height: 0px;
    }

    .background pre {
        font-size: 5px;
    }

    .li-profil {
        background: #FFFFFF;
        position: absolute;
        top: 100px;
        left: 50px;
        z-index: 10;
    }
</style>

<div class="LI-profile-badge li-profil" data-version="v1" data-size="large" data-locale="cs_CZ" data-type="vertical"
     data-theme="light" data-vanity="domanik"><a class="LI-simple-link"
                                                 href='https://cz.linkedin.com/in/domanik?trk=profile-badge'>Tomáš
        Domanik</a></div>

<div class="background">
    <?php
    $img2textPath = __DIR__ . DIRECTORY_SEPARATOR . 'img2text';
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . $img2textPath);

    include_once $img2textPath . DIRECTORY_SEPARATOR . 'draw.php?i=1&chars=010';
    ?>
</div>

</body>
</html>
