<?php
header('Content-type: application/json');
$output=null;
$retval=null;
exec('find ./headers/' . $_GET["sdk"] . '/ -name ' . $_GET["q"] . ".h", $output, $retval);
echo "[";
$i = 0;
foreach ($output as $found_file):
    if ($i == 0) {
        $i = 1;
    }
    else {
        echo ", ";
    }
    $olin=explode("/", $found_file);
    $item = '{"sdk": "' . $olin[2] . '", "fw": "' . $olin[3] . '/' . $olin[4] . '", "file":"' . $olin[5] . '/' . $olin[6] . '"}';
    echo $item;
endforeach;
echo "]"
?>