<?php
    require("includes/header.php");
    head("TimTube | Home", "");
?>

<body class="bg-primarylightmode dark:bg-primarydarkmode font-roboto">
    <header>
        <?php require("includes/navbar.php"); ?>
    </header>
    <main class="flex mt-12">
        <div id="sidebar" class="hidden sm:block">
            <?php require("includes/sidebar.php"); ?>
        </div>
        <div id="main-content">
            <?php require("includes/main.php"); ?>
        </div>
    </main>
</body>

</html>