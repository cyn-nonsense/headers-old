<?php
    # TODO: i'm not sanitizing this properly
    if (strpos($_GET['file'], '..') === false and strpos($_GET['fw'], '..') === false and strpos($_GET['sdk'], '..') === false)
    {
        $filename = 'headers/' . $_GET['sdk'] . '/' . $_GET['fw'] . '/' . $_GET['file'];
        echo "<pre id=\"linenumbers\" onload='renderLineNumbers()'></pre>";
        echo "<pre><code class=\"hljs\" id=\"filecontainer\">" . htmlentities(file_get_contents($filename)) . "</code></pre>";
    }
    else
    {
        echo ":thonk:";
    }
?>