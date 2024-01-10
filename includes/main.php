<?php 
    require_once("config/database.inc.php");
    require("includes/viewsFormatter.php");

    $videosQuery = "SELECT id, title, tumbnail, channelName, channelPicture, views, likes, postDate, videoURL FROM videos ORDER BY RAND()";
    $videosStatement = $conn->prepare($videosQuery);
    $videosStatement->execute();
    $videosResult = $videosStatement->fetchAll(PDO::FETCH_ASSOC);


    function searchVideos($conn, $searchQuery) {
        $trimmedQuery = trim($searchQuery);

        if (!empty($trimmedQuery)) {
            $trimmedQuery = "%$trimmedQuery%";
            
            $sql = "SELECT * FROM videos WHERE title LIKE :searchQuery";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':searchQuery', $trimmedQuery, PDO::PARAM_STR);
            $stmt->execute();
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $results;
        }
    }

?>

<div id="category-container" class="flex gap-2 sm:gap-2 py-4 px-2 overflow-x-auto">
    <div class="py-1.5 px-4 rounded-lg text-sm text-white dark:text-black bg-black dark:bg-white">
        <p>All</p>
    </div>
    <div class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Gaming</p>
    </div>
    <div class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Music</p>
    </div>
    <div class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Live</p>
    </div>
    <div class="py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>CSS</p>
    </div>
    <div class="hidden min-sm:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Recently uploaded</p>
    </div>
    <div class="hidden sm:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Smartphones</p>
    </div>
    <div class="hidden py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Sports leagues</p>
    </div>
    <div class="hidden md:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Javascript</p>
    </div>
    <div class="hidden md:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Cars</p>
    </div>
    <div class="hidden lg:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Lo-fi</p>
    </div>
    <div class="hidden lg:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Chill-out music</p>
    </div>
    <div class="hidden xl:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Cooking show</p>
    </div>
    <div class="hidden xl:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Aircrafts</p>
    </div>
    <div class="hidden xl:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>Physics</p>
    </div>
    <div class="hidden xl:block py-1.5 px-4 rounded-lg text-sm text-black dark:text-white bg-secondarylightmode dark:bg-secondarydarkmode">
        <p>History</p>
    </div>
</div>

<div class="flex flex-wrap justify-center sm:justify-normal">
    <?php

    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
        $results = searchVideos($conn, $searchQuery);

        foreach ($results as $result) {
            echo '<a id="test" class="w-[350px] sm:w-[400px] sm:p-4 md:p-2"
            href="videoPlayer.php?videoid=' . $result['videoURL'] . ' ">
            <div class="w-full c-card block text-black dark:text-white rounded-lg overflow-hidden">
                <div class="relative overflow-hidden">
                    <img id="test-2" class="h-[220px] w-128 rounded-xl" src="' . $result['tumbnail'] . '"
                        alt="' . $result['channelName'] . '-tumbnail" loading="lazy">
                </div>
                <div>
                    <div class="flex gap-2 mt-2 mb-7">
                        <div>
                            <img class="rounded-full w-10 h-10 mt-1" src="' . $result['channelPicture'] . '" alt="logo" loading="lazy">
                        </div>
                        <div class="mx-1 sm:w-72">
                            <h2 class="my-1 font-medium truncate w-full" title="' . $result['title'] .'">' . $result['title']
                                . '</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">' . $result['channelName'] . '</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">' . formatViews($result['views']) . ' views • ' . $result['postDate'] . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>';       
        }
    } else {
        foreach ($videosResult as $video) {
            echo '<a id="test" class="w-[350px] sm:w-[400px] sm:p-4 md:p-2"
            href="videoPlayer.php?videoid=' . $video['videoURL'] . ' ">
            <div class="w-full c-card block text-black dark:text-white rounded-lg overflow-hidden">
                <div class="relative overflow-hidden">
                    <img id="test-2" class="h-[220px] w-128 rounded-xl" src="' . $video['tumbnail'] . '"
                        alt="' . $video['channelName'] . '-tumbnail" loading="lazy">
                </div>
                <div>
                    <div class="flex gap-2 mt-2 mb-7">
                        <div>
                            <img class="rounded-full w-10 h-10 mt-1" src="' . $video['channelPicture'] . '" alt="logo" loading="lazy">
                        </div>
                        <div class="mx-1 sm:w-72">
                            <h2 class="my-1 font-medium truncate w-full" title="' . $video['title'] .'">' . $video['title']
                                . '</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400">' . $video['channelName'] . '</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">' . formatViews($video['views']) . ' views • ' . $video['postDate'] . '</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>';   
        }
    }
        
    ?>
</div>