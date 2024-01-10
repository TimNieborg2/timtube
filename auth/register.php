<?php

require_once("../config/database.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $email = strtolower( $email );
    $password = trim($_POST['password']);
    $permissions = 'user';
    $standardImage = "https://avatar-management--avatars.us-west-2.prod.public.atl-paas.net/default-avatar.png";
 
    if (!empty($username) && !empty($email) && !empty($password)) {
        $checkquery = "SELECT id FROM users WHERE user_email = :email";
        $statement = $conn->prepare($checkquery);
        $statement->bindParam(':email', $email);
        $statement->execute();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($password) >= 10 && preg_match('/[A-Z]/', $password)) {
                if ($statement->rowCount() === 0) {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $insertquery = "INSERT INTO users (`user_email`, `user_password`, `username`, `permissions`, `picture`) 
                    VALUES (:userEmail, :userPassword, :username, :permissions, :picture)";
                    $statement = $conn->prepare($insertquery);
                    $statement->bindParam(':userEmail', $email, PDO::PARAM_STR);
                    $statement->bindParam(':userPassword', $password, PDO::PARAM_STR);
                    $statement->bindParam(':username', $username, PDO::PARAM_STR);
                    $statement->bindParam(':permissions', $permissions);
                    $statement->bindParam(':picture', $standardImage, PDO::PARAM_STR);
                    $statement->execute();
                    global $message;
                    $message = "Registered successfully!";
                    header('Location: login.php');
                } else {
                    global $emailError;
                    $emailError = "Email already exists";
                }
            } else {
                global $passwordError;
                $passwordError = "Password must be at least 10 characters long and contain at least one uppercase letter.";
            }
        } else {
            global $emailError; 
            $emailError = "Email is not valid!";
        }
    } else {
        exit();
    }
    
}
?>

<?php 
    require("../includes/header.php");
    head("TimTube | Register", "../");
?>

<body class="bg-primarylightmode dark:bg-primarydarkmode">
    <main class="max-w-xl lg:max-w-7xl px-10 mx-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="px-10 py-3 pt-14 text-left bg-secondarylightmode dark:bg-secondarydarkmode shadow-lg">
                <a class="flex justify-center" href="../index.php">
                    <svg class="ml-5 sm:ml-3 w-[180px] external-icon" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900.000000 202.000000" preserveAspectRatio="xMidYMid meet">
				        <g class="fill-gray-900 dark:fill-white" transform="translate(0.000000,202.000000) scale(0.100000,-0.100000)">
        			        <path class="fill-[#FF0000]" d="M1130 2009 c-480 -11 -774 -38 -865 -78 -54 -24 -129 -92 -160 -146 -104 -176 -130 -1018 -45 -1417 28 -131 65 -192 153 -252 29 -19 79 -42 112 -50 301 -76 1883 -79 2214 -5 78 17 130 46 186 103 64 66 87 121 109 261 31 197 39 359 33 673 -10 563 -52 718 -221 817 -24 14 -75 32 -112 40 -114 24 -416 45 -726 50 -161 3 -311 7 -333 8 -22 2 -177 0 -345 -4z m560 -877 c96 -55 183 -107 193 -114 16 -12 1 -23 -145 -108 -483 -278 -574 -330 -580 -330 -9 0 -11 844 -2 852 5 6 78 -35 534 -300z"/>
        			        <path d="M7340 1928 c0 -2 -1 -402 -3 -891 l-2 -887 117 0 117 0 11 55 c6 30 14 55 17 55 3 0 21 -17 39 -39 95 -110 288 -120 379 -19 45 49 60 85 88 202 19 82 21 121 21 381 1 315 -11 416 -58 521 -40 87 -122 131 -226 121 -84 -7 -163 -55 -212 -127 -16 -24 -17 -9 -17 303 l-1 327 -135 0 c-74 0 -135 -1 -135 -2z m443 -719 c47 -36 52 -77 52 -419 0 -350 -6 -392 -57 -435 -16 -14 -41 -25 -54 -25 -37 0 -91 26 -103 48 -7 14 -11 145 -11 393 l0 372 44 43 c50 50 87 57 129 23z"/>
        			        <path d="M3210 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 0 -743 0 -742 138 0 137 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        			        <path d="M5650 1765 c0 -58 -1 -108 -2 -112 -2 -5 60 -10 137 -13 l140 -5 3 -742 2 -743 135 0 135 0 0 745 0 745 140 0 140 0 0 115 0 115 -415 0 -415 0 0 -105z"/>
        			        <path d="M4129 1647 c-68 -45 -76 -123 -18 -171 56 -48 126 -47 173 3 52 54 42 124 -23 168 -43 29 -89 29 -132 0z"/>
        			        <path d="M4648 1416 c-62 -23 -85 -43 -112 -99 -43 -87 -49 -187 -42 -702 3 -253 6 -461 6 -463 0 -1 71 -1 158 0 l157 3 5 509 5 508 33 28 c42 35 81 44 104 23 16 -15 18 -57 20 -542 l3 -526 156 -3 156 -2 7 115 c4 64 6 299 5 522 l-2 406 27 19 c32 24 88 27 111 8 38 -31 39 -53 40 -565 l0 -500 136 -3 137 -3 7 133 c4 73 5 313 3 533 -4 350 -7 406 -22 449 -40 111 -94 155 -200 163 -94 8 -166 -16 -226 -76 l-47 -47 -24 37 c-32 52 -87 81 -168 86 -84 6 -116 -6 -119 -43 -3 -36 -8 -40 -29 -22 -65 57 -206 84 -285 54z"/>
        			        <path d="M8537 1420 c-102 -18 -174 -73 -218 -165 -55 -114 -64 -182 -64 -480 0 -301 10 -371 66 -484 52 -104 127 -147 270 -158 248 -18 399 104 399 324 l0 63 -43 0 c-24 0 -78 3 -119 6 l-75 7 -7 -62 c-10 -85 -24 -119 -57 -136 -67 -35 -129 -6 -148 69 -6 25 -11 97 -11 160 l0 116 236 0 237 0 -6 223 c-6 241 -15 299 -62 386 -30 55 -82 98 -145 120 -46 16 -192 22 -253 11z m157 -205 c31 -34 35 -54 43 -222 l6 -143 -107 0 -106 0 0 133 c0 143 10 199 43 235 30 32 90 30 121 -3z"/>
        			        <path d="M6404 1397 c-2 -7 -4 -252 -2 -543 3 -525 3 -529 26 -586 39 -96 106 -138 218 -138 96 0 179 44 237 127 36 50 40 46 52 -50 l7 -57 109 0 109 0 0 630 0 631 -137 -3 -138 -3 -3 -505 -2 -504 -27 -28 c-32 -34 -85 -51 -118 -38 -49 19 -50 21 -55 565 l-5 510 -133 3 c-104 2 -134 0 -138 -11z"/>
        			        <path d="M4050 770 l0 -630 140 0 140 0 0 630 0 630 -140 0 -140 0 0 -630z"/>	
				        </g>
			        </svg>
                </a>
                <h3 class="text-xl font-bold text-center text-black dark:text-white mt-5">Register your account</h3>
                <?php 
                    global $message; 
                    echo '<p class="text-green-500 text-center mt-3">' . $message . '';
                ?>
                <form method="POST">
                    <div class="mt-2">
                        <div class="w-128">
                            <label class="block text-black dark:text-white mt-2" for="username">Username:</label>
                            <input id="username" name="username" type="text" placeholder="Username*"
                                class="w-full text-black pl-4 py-2 sm:pr-48 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        </div>
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['username'])) {
                                echo '<span class="text-xs tracking-wide text-red-600">Username field is required*</span>';
                            }
                        ?>
                        <div>
                            <label class="block text-black dark:text-white mt-2" for="email">Email:</label>
                            <input id="email" name="email" type="text" placeholder="Email*"
                                class="w-full text-black pl-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        </div>
                        <?php
                            global $emailError; 
                            echo '<p class="text-red-500 mt-1">' . $emailError . '';
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['email'])) {
                                 echo '<span class="text-xs tracking-wide text-red-600">Email field is required*</span>';
                            }
                        ?>
                        <div class="flex flex-col">
                            <label class="block text-black dark:text-white mt-2" for="password">Password:</label>
                            <input id="password" name="password" type="password" placeholder="Password*"
                                class="w-full text-black pl-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        </div>
                        <div class="flex flex-wrap">
                            <?php 
                                global $passwordError; 
                                echo '<p class="text-red-500 mt-1">' . $passwordError . '';
                            ?>
                        </div>
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['password'])) {
                                echo '<span class="text-xs tracking-wide text-red-600">Passworld field is required*</span>';
                            }
                        ?>
                        <div class="flex flex-col md:flex-row items-baseline justify-between">
                            <button
                                class="px-6 py-2 mt-6 text-white bg-[#EA0505] mx-auto rounded-lg hover:bg-red-600">Create</button>
                        </div>
                        <div class="flex justify-center mt-8 mb-8">
                            <span class="text-black dark:text-white text-center">Already registered? <a
                                    class="text-[#EA0505] hover:text-red-500" href="login.php">Login<a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>