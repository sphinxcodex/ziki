<?php
if ($handle = opendir(__DIR__.'/resources/themes')) {
    // This loops over the directory file
    while (false !== ($entry = readdir($handle))) {
        echo "$entry\n";
    }

    closedir($handle);
}
?>