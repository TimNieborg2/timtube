<?php

    require_once("config/database.inc.php");
    require("includes/viewsFormatter.php");
    $videoURL = $_GET['videoid'];

    $currentVideoQuery = "SELECT id, title, tumbnail, channelName, channelPicture, views, subs, likes, postDate, videoURL, videoDescription FROM videos WHERE videoURL = :videoUrl";
    $currentVideoStatement = $conn->prepare($currentVideoQuery);
    $currentVideoStatement->bindParam(':videoUrl', $videoURL);
    $currentVideoStatement->execute();
    $currentVideoResult = $currentVideoStatement->fetch(PDO::FETCH_ASSOC);

    $moreVideosQuery = "SELECT id, title, tumbnail, channelName, channelPicture, views, likes, postDate, videoURL FROM videos WHERE videoURL != :videoUrl";
    $moreVideosStatement = $conn->prepare($moreVideosQuery);
    $moreVideosStatement->bindParam(':videoUrl', $videoURL);
    $moreVideosStatement->execute();
    $moreVideosResult = $moreVideosStatement->fetchAll(PDO::FETCH_ASSOC);

    $commentsQuery = "SELECT comments FROM videos WHERE videoURL = :videoUrl";
    $commentsStatement = $conn->prepare($commentsQuery);
    $commentsStatement->bindParam(':videoUrl', $videoURL);
    $commentsStatement->execute();
    $video = $commentsStatement->fetch(PDO::FETCH_ASSOC);

    $existingComments = json_decode($video['comments'], true);

    function guidv4($data = null) {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16); 
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function getUserInfo($conn, $identifier) {
        $query = "SELECT * FROM users WHERE id = :userid";
        $statement = $conn->prepare($query);
        $statement->bindParam(':userid', $identifier);
        $statement->execute();
        $userData = $statement->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }
    
    function getUserData($conn, $userID) {
        $userData = getUserInfo($conn, $userID);
        if ($userData) {
            return $userData;
        }
        return false;
    }
    
    function getExistingComments($conn, $videoURL) {
        $query = "SELECT comments FROM videos WHERE videoURL = :videoId";
        $statement = $conn->prepare($query);
        $statement->bindParam(':videoId', $videoURL);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($result && isset($result['comments'])) {
            return json_decode($result['comments'], true);
        }
    
        return [];
    }
    
    function saveComments($conn, $videoURL, $comments) {
        $updatedComments = json_encode($comments);
    
        $updateSql = "UPDATE videos SET comments = :updatedComments WHERE videoURL = :videoId";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':updatedComments', $updatedComments);
        $updateStmt->bindParam(':videoId', $videoURL);
        $updateStmt->execute();
    }
    
    function addComment($conn, $userID, $videoURL, $comment) {    
        $id = guidv4();
        $currentDateTime = date("Y-m-d H:i:s");
        $existingComments = getExistingComments($conn, $videoURL);
        $trimmedComment = trim($comment);

        if (!empty($trimmedComment)) {
            $newComment = [
                "id" => $id,
                "user" => $userID,
                "text" => preg_replace("(<)", "&lt;", $trimmedComment),
                "date" => $currentDateTime,
                "likes" => 0,
            ];
        
            $existingComments[] = $newComment;
            saveComments($conn, $videoURL, $existingComments);
        
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } 
    }
    
    if (isset($_COOKIE['loggedInUser'])) {
        $userID = $_COOKIE['loggedInUser'];
        if (isset($_POST['comment'])) {
            if (!empty($_POST['comment'])) {
                addComment($conn, $userID, $videoURL, $_POST['comment']);
            } else {
                global $message;
                $message = "Comment field is empty!";
            }
        } 
    } else {
        global $message;
        $message = "Sign in to post comments!";
    }
    

    function timeAgo($date) {
        $now = time();
        $postTime = strtotime($date);
        $timeDiff = $now - $postTime;
    
        $units = [
            "year" => 31536000,
            "month" => 2592000,
            "day" => 86400,
            "hour" => 3600,
            "minute" => 60
        ];
    
        foreach ($units as $unit => $seconds) {
            $interval = floor($timeDiff / $seconds);
            if ($interval > 1) {
                return $interval . " " . $unit . "s ago";
            } elseif ($interval == 1) {
                return $interval . " " . $unit . " ago";
            }
        }
    
        return "just now";
    }

    function updateVideoViews($conn, $video) {
        $query = "SELECT * FROM videos WHERE videoURL = :video";
        $statement = $conn->prepare($query);
        $statement->bindValue(':video', $video, PDO::PARAM_STR);
        $statement->execute();
        $currentViews = $statement->fetch(PDO::FETCH_ASSOC);

        $updatedViews = $currentViews['views'] + 1;

        $updateSql = "UPDATE videos SET views = :updatedViews WHERE videoURL = :videoId";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindValue(':updatedViews', $updatedViews, PDO::PARAM_INT);
        $updateStmt->bindValue(':videoId', $video, PDO::PARAM_STR);
        $updateStmt->execute();

        return $updatedViews;
    }

    updateVideoViews($conn, $videoURL);

    if (isset($_GET['search'])) {
        header('Location: index.php?search=' . $_GET['search'] . '');
    }
    
    require("includes/header.php");
    head($currentVideoResult['title'], "");
?>

<body class="bg-primarylightmode dark:bg-primarydarkmode font-roboto">
    <header>
        <?php require("includes/navbar.php"); ?>
    </header>
    <main>
        <div class="flex flex-col sm:flex-row mt-14 px-2 md:px-28 md:py-6">
            <div id="left-section">
                <div id="video">
                    <iframe id="trailer-video"
                        class="w-full h-[15rem] sm:w-[55rem] sm:h-[30rem] 3xl:w-[75rem] 3xl:h-[42rem] rounded-xl"
                        src="https://www.youtube.com/embed/<?=$currentVideoResult['videoURL']?>"
                        title="Video from <?=$currentVideoResult['channelName']?>">
                    </iframe>
                </div>
                <div id="video-info" class="text-black dark:text-white mt-3 p-2">
                    <div>
                        <h1 class="text-xl">
                            <?=$currentVideoResult['title']?>
                        </h1>
                    </div>
                    <div id="pc" class="hidden sm:flex flex-row flex-wrap items-center justify-between mt-3">
                        <div class="flex">
                            <div>
                                <img class="w-10 h-10 rounded-full" src="<?=$currentVideoResult['channelPicture']?>"
                                    alt="channel-logo" loading="lazy">
                            </div>
                            <div class="ml-2">
                                <p class="font-semibold">
                                    <?=$currentVideoResult['channelName']?>
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 text-xs">
                                    <?=$currentVideoResult['subs']?> subscribers
                                </p>
                            </div>
                            <div class="flex items-center">
                                <p
                                    class="py-1.5 px-2.5 ml-5 font-medium rounded-3xl bg-black dark:bg-white text-white dark:text-black">
                                    Subscribe</p>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-3">
                            <div class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-2.5">
                                    <button>
                                        <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                            focusable="false">
                                            <path
                                                d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z">
                                            </path>
                                        </svg>
                                    </button>
                                    <p class="ml-1">
                                        <?=$currentVideoResult['likes']?>
                                    </p>
                                    <div class="border-l mx-3"></div>
                                    <button>
                                        <svg class="w-6 h-6 mr-1 fill-black dark:fill-white" viewBox="0 0 24 24"
                                            focusable="false">
                                            <path
                                                d="M17,4h-1H6.57C5.5,4,4.59,4.67,4.38,5.61l-1.34,6C2.77,12.85,3.82,14,5.23,14h4.23l-1.52,4.94C7.62,19.97,8.46,21,9.62,21 c0.58,0,1.14-0.24,1.52-0.65L17,14h4V4H17z M10.4,19.67C10.21,19.88,9.92,20,9.62,20c-0.26,0-0.5-0.11-0.63-0.3 c-0.07-0.1-0.15-0.26-0.09-0.47l1.52-4.94l0.4-1.29H9.46H5.23c-0.41,0-0.8-0.17-1.03-0.46c-0.12-0.15-0.25-0.4-0.18-0.72l1.34-6 C5.46,5.35,5.97,5,6.57,5H16v8.61L10.4,19.67z M20,13h-3V5h3V13z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-3">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M15 5.63 20.66 12 15 18.37V14h-1c-3.96 0-7.14 1-9.75 3.09 1.84-4.07 5.11-6.4 9.89-7.1l.86-.13V5.63M14 3v6C6.22 10.13 3.11 15.33 2 21c2.78-3.97 6.44-6 12-6v6l8-9-8-9z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">Share</p>
                                </div>
                            </button>
                            <button class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-3">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M17 18v1H6v-1h11zm-.5-6.6-.7-.7-3.8 3.7V4h-1v10.4l-3.8-3.8-.7.7 5 5 5-4.9z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">Download</p>
                                </div>
                            </button>
                            <button class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-full">
                                <div class="flex py-1.5 px-1.5">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M7.5 12c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5zm4.5-1.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm6 0c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div id="mobile" class="sm:hidden flex flex-wrap items-center justify-between mt-3">
                        <div class="flex gap-[70px]">
                            <div class="flex">
                                <div>
                                    <img class="w-16 xs:w-10 h-10 rounded-full" src="<?=$currentVideoResult['channelPicture']?>"
                                        alt="channel-logo" loading="lazy">
                                </div>
                                <div class="ml-2">
                                    <p class="font-semibold">
                                        <?=$currentVideoResult['channelName']?>
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-xs">
                                        <?=$currentVideoResult['subs']?> subscribers
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button class="flex items-center">
                                    <p class="py-1.5 px-2.5 ml-5 text-black font-medium rounded-3xl bg-white">Subscribe
                                    </p>
                                </button>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-4">
                            <div class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-2.5">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z">
                                        </path>
                                    </svg>
                                    <p class="ml-1">
                                        <?=$currentVideoResult['likes']?>
                                    </p>
                                    <div class="border-l mx-3"></div>
                                    <svg class="w-6 h-6 mr-1 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M17,4h-1H6.57C5.5,4,4.59,4.67,4.38,5.61l-1.34,6C2.77,12.85,3.82,14,5.23,14h4.23l-1.52,4.94C7.62,19.97,8.46,21,9.62,21 c0.58,0,1.14-0.24,1.52-0.65L17,14h4V4H17z M10.4,19.67C10.21,19.88,9.92,20,9.62,20c-0.26,0-0.5-0.11-0.63-0.3 c-0.07-0.1-0.15-0.26-0.09-0.47l1.52-4.94l0.4-1.29H9.46H5.23c-0.41,0-0.8-0.17-1.03-0.46c-0.12-0.15-0.25-0.4-0.18-0.72l1.34-6 C5.46,5.35,5.97,5,6.57,5H16v8.61L10.4,19.67z M20,13h-3V5h3V13z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <button class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-3">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M15 5.63 20.66 12 15 18.37V14h-1c-3.96 0-7.14 1-9.75 3.09 1.84-4.07 5.11-6.4 9.89-7.1l.86-.13V5.63M14 3v6C6.22 10.13 3.11 15.33 2 21c2.78-3.97 6.44-6 12-6v6l8-9-8-9z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">Share</p>
                                </div>
                            </button>
                            <!-- <button class="bg-secondarylightmode dark:bg-secondarydarkmode rounded-3xl">
                                <div class="flex py-1.5 px-3">
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                        focusable="false">
                                        <path
                                            d="M17 18v1H6v-1h11zm-.5-6.6-.7-.7-3.8 3.7V4h-1v10.4l-3.8-3.8-.7.7 5 5 5-4.9z">
                                        </path>
                                    </svg>
                                    <p class="ml-2">Download</p>
                                </div>
                            </button> -->
                        </div>
                    </div>
                    <div class="p-4 mt-3 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-128 sm:w-[860px] 3xl:w-[1200px]">
                        <div id="description" class="overflow-hidden h-16">
                            <div class="flex gap-2 text-sm font-semibold">
                                <p><?=formatViews($currentVideoResult['views'])?> views</p>
                                <p><?=$currentVideoResult['postDate']?></p>
                            </div>
                            <p>
                                <?=$currentVideoResult['videoDescription']?>
                            </p>
                        </div>
                        <button id="toggleDescription" class="text-sm font-semibold text-black dark:text-white mt-2">more</button>
                    </div>
                    <div id="comments" class="block mt-8">
                        <div class="flex gap-8">
                            <p>
                                <?php
                                    if (isset($existingComments)) {
                                        $commentNumber = count($existingComments);
                                        if ($commentNumber > 1) {
                                            echo "$commentNumber Comments";
                                        } else {
                                            echo "$commentNumber Comment";
                                        }
                                    } else {
                                        echo "0 comments";
                                    }
                                ?>
                            </p>
                            <button class="flex">
                                <svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
                                    viewBox="0 0 24 24" focusable="false">
                                    <path d="M21 6H3V5h18v1zm-6 5H3v1h12v-1zm-6 6H3v1h6v-1z"></path>
                                </svg>
                                <p class="text-black dark:text-white">Sort by</p>
                            </button>
                        </div>
                        <div class="mt-5 mb-8">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full" src="<?php
                                if (isset($userData)) {
                                    echo $userData['picture'];
                                } else {
                                    echo " https://flowbite.com/docs/images/people/profile-picture-5.jpg"; }?>"
                                alt="profile-picture" loading="lazy">
                                <form method="POST" class="max-w-full w-full px-4">
                                    <div class="relative flex items-center">
                                        <input id="comment" type="search" name="comment"
                                            class="w-full bg-primarylightmode dark:bg-[#121212] py-2 border-b border-[#CACACA] dark:border-[#3D3D3D] shadow-sm focus:outline-none text-black dark:text-white"
                                            placeholder="Add a comment">
                                        <?php 
                                            if (isset($userData)) {
                                                echo '
                                                <input type="submit" value=""
                                                    class="absolute inset-y-0 right-0 flex items-center px-4 text-black dark:text-white">
                                                    <svg class="ml-2 w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                        focusable="false">
                                                        <path
                                                            d="m20.87 20.17-5.59-5.59C16.35 13.35 17 11.75 17 10c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.75 0 3.35-.65 4.58-1.71l5.59 5.59.7-.71zM10 16c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z">
                                                        </path>
                                                    </svg>
                                                </input>';
                                            }
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <?php 
                                global $message;
                                echo '<p class="text-red-600 mt-1 ml-14">' . $message . '</p>';
                            ?>
                        </div>
                        <?php 
                        if (isset($existingComments)) {
                            $reversedComments = array_reverse($existingComments);
                            foreach ($reversedComments as $index => $comment) {
                                $userInfo = getUserInfo($conn, $comment['user']);

                                if (!preg_match("(script)", $comment['text']) && !preg_match("(script)", $userInfo['username']) && !preg_match("(script)", $userInfo['picture'])) {
                                    echo '
                                    <div class="flex justify-between mt-4 relative">
                                    <div class="flex">
                                        <img class="w-10 h-10" src="' . $userInfo['picture'] . '" alt="profile-picture" loading="lazy">
                                        <div class="ml-4 w-64 sm:w-[700px] 3xl:w-[1000px]">
                                            <p>' . $userInfo['username']  . '<span class="ml-1 text-gray-600 dark:text-gray-400 text-xs">' . timeAgo($comment['date']) . '</span></p>
                                            <p class="truncate">' . $comment['text'] . '</p>
                                            <div class="flex items-center mt-2">
                                                <button
                                                    class="hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode p-1 rounded-full">
                                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 24 24"
                                                        focusable="false">
                                                        <path
                                                            d="M18.77,11h-4.23l1.52-4.94C16.38,5.03,15.54,4,14.38,4c-0.58,0-1.14,0.24-1.52,0.65L7,11H3v10h4h1h9.43 c1.06,0,1.98-0.67,2.19-1.61l1.34-6C21.23,12.15,20.18,11,18.77,11z M7,20H4v-8h3V20z M19.98,13.17l-1.34,6 C18.54,19.65,18.03,20,17.43,20H8v-8.61l5.6-6.06C13.79,5.12,14.08,5,14.38,5c0.26,0,0.5,0.11,0.63,0.3 c0.07,0.1,0.15,0.26,0.09,0.47l-1.52,4.94L13.18,12h1.35h4.23c0.41,0,0.8,0.17,1.03,0.46C19.92,12.61,20.05,12.86,19.98,13.17z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <p class="mr-2 text-gray-600 dark:text-gray-400 text-xs">' . $comment['likes'] . '</p>
                                                <button
                                                    class="hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode p-1 rounded-full">
                                                    <svg class="w-6 h-6 mr-1 fill-black dark:fill-white" viewBox="0 0 24 24"
                                                        focusable="false">
                                                        <path
                                                            d="M17,4h-1H6.57C5.5,4,4.59,4.67,4.38,5.61l-1.34,6C2.77,12.85,3.82,14,5.23,14h4.23l-1.52,4.94C7.62,19.97,8.46,21,9.62,21 c0.58,0,1.14-0.24,1.52-0.65L17,14h4V4H17z M10.4,19.67C10.21,19.88,9.92,20,9.62,20c-0.26,0-0.5-0.11-0.63-0.3 c-0.07-0.1-0.15-0.26-0.09-0.47l1.52-4.94l0.4-1.29H9.46H5.23c-0.41,0-0.8-0.17-1.03-0.46c-0.12-0.15-0.25-0.4-0.18-0.72l1.34-6 C5.46,5.35,5.97,5,6.57,5H16v8.61L10.4,19.67z M20,13h-3V5h3V13z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button
                                                    class="hover:bg-secondarylightmode dark:hover:bg-secondarydarkmode px-3 py-2 rounded-full">
                                                    <p class="text-black dark:text-white text-sm">Reply</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="info-btn-dropdown" class="flex items-center">
                                        <svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24"
                                            viewBox="0 0 24 24" focusable="false">
                                            <path
                                                d="M12 16.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zM10.5 12c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5zm0-6c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5z">
                                            </path>
                                        </svg>
                                    </button>';
                                    if ($comment['user'] == isset($_COOKIE['loggedInUser'])) {
                                        echo '
                                            <div id="info-menu-create-' . ($index + 1) . '"
                                                class="absolute top-2 right-7 hidden z-10 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-44">
                                                <div>
                                                    <ul class="py-2 text-sm text-black dark:text-white">
                                                        <li>
                                                            <a class="flex items-center mx-3" href="#">
                                                                <svg class="w-6 h-6 fill-black dark:fill-white"
                                                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                                    focusable="false">
                                                                    <path
                                                                        d="m14.06 7.6 2.34 2.34L6.34 20H4v-2.34L14.06 7.6m0-1.41L3 17.25V21h3.75L17.81 9.94l-3.75-3.75zm3.55-2.14 2.37 2.37-1.14 1.14-2.37-2.37 1.14-1.14m0-1.42-2.55 2.55 3.79 3.79 2.55-2.55-3.79-3.79z">
                                                                    </path>
                                                                </svg>
                                                                <p class="block pl-2 py-2">Edit</p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="flex items-center mx-3" href="comments/deleteComment.php?video=' . $videoURL . '&commentid=' . $comment['id'] . '">
                                                                <svg class="w-6 h-6 fill-black dark:fill-white"
                                                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                                    focusable="false">
                                                                    <path
                                                                        d="M11 17H9V8h2v9zm4-9h-2v9h2V8zm4-4v1h-1v16H6V5H5V4h4V3h6v1h4zm-2 1H7v15h10V5z">
                                                                    </path>
                                                                </svg>
                                                                <p class="block pl-2 py-2">Delete</p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>';
                                    } else {
                                        echo '
                                            <div id="info-menu-create-' . ($index + 1) . '" class="absolute top-5 right-7 hidden z-10 bg-secondarylightmode dark:bg-secondarydarkmode rounded-xl w-44">
                                                <div>
                                                    <ul class="py-2 text-sm text-black dark:text-white">
                                                        <li>
                                                            <a class="flex items-center mx-3" href="#">
                                                                <svg class="w-6 h-6 fill-black dark:fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                                                    focusable="false">
                                                                    <path
                                                                        d="m13.18 4 .24 1.2.16.8H19v7h-5.18l-.24-1.2-.16-.8H6V4h7.18M14 3H5v18h1v-9h6.6l.4 2h7V5h-5.6L14 3z">
                                                                    </path>
                                                                </svg>
                                                                <p class="block pl-2 py-2">Report</p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>';
                                    }
                                    echo '</div>';
                                }                          
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="right-section" class="ml-2">
                <div class="flex gap-2 sm:gap-2 py-1 px-2 overflow-x-auto">
                    <div
                        class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
                        <p>All</p>
                    </div>
                    <div
                        class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
                        <p>Gaming</p>
                    </div>
                    <div
                        class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
                        <p>Music</p>
                    </div>
                    <div
                        class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
                        <p>Live</p>
                    </div>
                    <div
                        class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
                        <p>CSS</p>
                    </div>
                </div>
                <div class="flex flex-col mt-3">
                    <?php
                        foreach ($moreVideosResult as $video) {
                            echo '
                            <a class="flex my-2" href="videoPlayer.php?videoid=' . $video['videoURL'] . '">
                                <div class="w-1/2 md:w-1/2 3xl:w-2/4">
                                    <img class="w-full h-auto rounded-xl" src="' . $video['tumbnail'] . '" alt="tumbnail van ' . $video['channelName'] . '" loading="lazy">
                                </div>
                                <div class="w-1/4 md:w-1/2 3xl:w-1/2 text-black dark:text-white ml-2">
                                    <div class="flex flex-wrap w-36 sm:w-64">
                                        <p class="font-semibold truncate w-full" title="' . $video['title'] . '">' . $video['title'] . '</p>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-gray-600 dark:text-gray-400 text-xs">' . $video['channelName'] . '</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-xs">' . $video['views'] . ' views • ' . $video['postDate'] . '</p>
                                    </div>
                                </div>
                            </a>';  
                        }   
                    ?>
                </div>
            </div>
        </div>
    </main>

</body>