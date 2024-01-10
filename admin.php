<?php
    session_start();

    require_once("config/database.inc.php");

    $userID = $_COOKIE['loggedInUser'];
    
    $query = "SELECT * FROM users WHERE id = :userid";
    $statement = $conn->prepare($query);
    $statement->bindParam(':userid', $userID);
    $statement->execute();
    $userData = $statement->fetch(PDO::FETCH_ASSOC);

    if (!empty($userData) || ($userID != null)) {
        ($userData['permissions'] === 'admin') ? $_SESSION['loggedInAdmin'] = $userID : (header("Location: index.php") && exit());
    } else {
        header("Location: index.php");
        exit();
    }
    

    require("includes/header.php");
    head("TimTube | Home", "");

?>

<body class="bg-primarylightmode dark:bg-primarydarkmode font-roboto">
    <header>
        <?php require("admin/navbar.php"); ?>
    </header>
    <main class="flex mt-12">
        <div id="adminSidebar">
            <?php require("admin/sidebar.php"); ?>
        </div>
        <div id="adminMain">
            <?php require("admin/main.php"); ?>
        </div>
    </main>
</body>

</html>