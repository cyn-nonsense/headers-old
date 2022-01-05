<?php
    if (strpos($_GET['file'], '..') === false and strpos($_GET['fw'], '..') === false and strpos($_GET['sdk'], '..') === false)
    {
        $root_dir =  'headers/' . $_GET['sdk'] . '/' . $_GET['fw'];
        $root_files = scandir($root_dir);

        foreach ($root_files as $item):
            if (is_dir($root_dir . '/' . $item))
            {
            }
            else
            {
                if (strcmp($item, ".") !== 0 and strcmp($item, "..") !== 0) {

                    if (strpos($item, '.zip'))
                    {
                        echo "<div class=\"dir\"><a href='" . $root_dir . "/" . $item . "'>" . htmlentities($item) . "</a></div>";
                    }
                    else {
                        echo "<div class=\"dir\" onclick=\"loadfn('" . $item . "')\">" . htmlentities($item) . "</div>";
                    }
                }
            }
        endforeach;
        foreach ($root_files as $item):
            if (is_dir($root_dir . '/' . $item))
            {
                if (strcmp($item, ".") !== 0 and strcmp($item, "..") !== 0)
                {
                    $subdir = $root_dir . '/' . $item;
                    $subdir_files = scandir($subdir);
                    echo "<div id=\"fold-" . $item . "\" class=\"folder\">";
                    echo "<div class=\"folder-rep\"  onclick=\"togfold('fold-" . $item . "')\">" . $item . "</div>";
                    foreach ($subdir_files as $file):
                        if (strcmp($file, ".") !== 0 and strcmp($file, "..") !== 0) {
                            echo "<div class=\"dir\" onclick=\"loadfn('" . $item . "/" . $file . "')\">" . htmlentities($file) . "</div>";
                        }
                    endforeach;
                    echo "</div>";
                }
            }
            else
            {
            }
        endforeach;
    }
?>