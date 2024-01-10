<?php

function formatViews($views) {
    $suffixes = array('', 'k', 'M', 'B', 'T');
    $suffixIndex = 0;

    while ($views >= 1000 && $suffixIndex < count($suffixes) - 1) {
        $views /= 1000;
        $suffixIndex++;
    }

    return round($views, 1) . $suffixes[$suffixIndex];
}

?>