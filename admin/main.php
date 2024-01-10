<?php

require_once("config/database.inc.php");
require("includes/viewsFormatter.php");

$videosQuery = "SELECT id, title, tumbnail, channelName, channelPicture, views, likes, postDate, videoURL FROM videos";
$videosStatement = $conn->prepare($videosQuery);
$videosStatement->execute();
$videosResult = $videosStatement->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="mt-4">
    <h1 class="text-black dark:text-white text-2xl text-center">Videos</h1>
</div>
<div class="flex flex-wrap justify-center sm:justify-normal">

<?php

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

?>

</div>