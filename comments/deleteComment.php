<?php

    require_once("../config/database.inc.php");

    if (isset($_GET['commentid']) && isset($_GET['video'])) {
        $videoURL = $_GET['video'];
        $commentId = $_GET['commentid'];
        
        $selectSql = "SELECT comments FROM videos WHERE videoURL = :videoURL";
        $selectStmt = $conn->prepare($selectSql);
        $selectStmt->bindParam(':videoURL', $videoURL);
        $selectStmt->execute();
        
        $videoData = $selectStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($videoData) {
            $comments = json_decode($videoData['comments'], true);
    
            foreach ($comments as $key => $comment) {
                if ($comment['id'] == $commentId) {
                    unset($comments[$key]);
                    break;
                }
            }
    
            $updatedComments = json_encode(array_values($comments));
    
            $updateSql = "UPDATE videos SET comments = :updatedComments WHERE videoURL = :videoURL";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':updatedComments', $updatedComments);
            $updateStmt->bindParam(':videoURL', $videoURL);
    
            if ($updateStmt->execute()) {
                header("Location: ../videoPlayer.php?videoid=$videoURL");
                exit;
            } else {
                echo "<p>Error deleting comment.<a href='../videoPlayer.php?videoid=$videoURL'>terug naar video.</a></p>";
            }
        } else {
            echo "<p>Video not found<a href='../videoPlayer.php?videoid=$videoURL'>terug naar video.</a></p>";
        }
    } else {
        echo "<p>Comment ID not provided</p><a href='../videoPlayer.php?videoid=$videoURL'>terug naar video.</a>";
    }