<?php

if (isset($_COOKIE['loggedInUser'])) {
    setcookie("loggedInUser", "", time() - 3600, "/");
    header('Location: login.php');
    exit();
} else {
    header('Location: login.php');
}