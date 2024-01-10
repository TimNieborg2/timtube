<?php

function head($title, $baseUrl) {
    $cssPath = $baseUrl . "css/style.css";
    $jsPath = $baseUrl . "js/main.js";
    $tailwindJsPath = $baseUrl . "js/tailwind.js";
    $navbarJsPath = $baseUrl . "js/navbar.js";
    $videoPlayerJsPath = $baseUrl . "js/videoPlayer.js";
    $adminJsPath = $baseUrl . "js/admin.js";
    $currentPage = basename($_SERVER['PHP_SELF']);

    ?>
    <!doctype html>
    <html lang="nl">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?=$title?></title>
            <link rel="icon" href="https://www.youtube.com/s/desktop/dbf5c200/img/favicon_48x48.png" type="favicon">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="stylesheet" href="<?=$cssPath?>">
            <script src="<?=$tailwindJsPath?>"></script>
            <script src="<?=$jsPath?>" defer></script>
            <script src="<?=$navbarJsPath?>" defer></script>

            <?php
                if ($currentPage === 'videoPlayer.php') {
                    echo '<script src="' . $videoPlayerJsPath . '" defer></script>';
                } else if ($currentPage === 'admin.php') {
                    echo '<script src="' . $adminJsPath . '" defer></script>';
                }
            ?>
        </head>
    </html>
<?php
}