<?php

?>

<html>
<head>
    <title>iOS Headers</title>
    <link rel="stylesheet" href="/main.css">
    <link rel="stylesheet"
          href="https://highlightjs.org/static/demo/styles/kimbie-dark.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script src="logos.js"></script>
    <script src="util.js"></script>
    <script src="diff.js"></script>
    <script src="search.js"></script>
</head>
<!--
                 ___====-_  _-====___
           _--^^^#####//      \\#####^^^--_
        _-^##########// (    ) \\##########^-_
       -############//  |\^^/|  \\############-
     _/############//   (@::@)   \\############\_
    /#############((     \\//     ))#############\
   -###############\\    (oo)    //###############-
  -#################\\  /    \  //#################-
 -###################\\/      \//###################-
_#/|##########/\######(   /\   )######/\##########|\#_
|/ |#/\#/\#/\/  \#/\##\  |  |  /##/\#/  \/\#/\#/\#| \|
`  |/  V  V  `   V  \#\| |  | |/#/  V   '  V  V  \|  '
   `   `  `      `   / | |  | | \   '      '  '   '
                    (  | |  | |  )    headers.cynder.me
   php codebase    __\ | |  | | /__   @arm64e
                  (vvv(VVV)(VVV)vvv)  gh/cxnder/headers

-->
<script src="main.js"></script>

<body onload="body_onload()"
    <?php
    if (isset($_GET['file']))
    {
        if (isset($_GET['diff'])) {
            echo "class = 'file diff'";
        }
        else {
            echo "class ='file'";
        }
    }
    else if (isset($_GET['fw']))
    {
        echo "class ='fw'";
    }
    else if (isset($_GET['sdk']))
    {
        echo "class ='sdk'";
    }
    ?>
>
<div id="navbar">
    <div class="button" id="logo" onclick="home()">iOS Headers</div>
    <?php
    if (isset($_GET['sdk']))
    {
        if (preg_match("^iOS[0-9\.]*?$", $_GET['sdk']))
        {
            echo "<div class=\"button\" onclick=\"loadsdk('" . $_GET['sdk'] . "')\">" . htmlentities($_GET['sdk']) . "</div>";
        }
    }
    if (isset($_GET['fw']))
    {
        if (preg_match("^[a-zA-Z0-9\.\/]*?.framework$", $_GET['fw']))
        {
            echo "<div class=\"button\" onclick=\"loadfw('" . $_GET['fw'] . "')\">" . htmlentities($_GET['fw']) . "</div>";
        }
    }
    if (isset($_GET['file']))
    {
        if (preg_match("^[a-zA-Z0-9\.\/]*?.h$", $_GET['file'])) {
            echo "<div class=\"button\" onclick=\"loadfn('" . $_GET['file'] . "')\">" . htmlentities($_GET['file']) . "</div>";
        }
    }
    ?>
    <input type="text" placeholder="Search" id="search">
    <select name="Diff against" onchange="diff_changed()" id="diff-select">
        <option value="init">Diff Against</option>
        <?php
        $hl_content = file_get_contents("headers/headers.json");
        $json = json_decode($hl_content);

        foreach ($json as $title => $dir):
            echo "<option value=\"" . $dir . "\">" . $title . "</option>";
        endforeach;

        ?>
    </select>
</div>
<div id="searchresultcontainer" class="inactive">
    <div id="searchresultlist">

    </div>
</div>
<script>
    var search = document.getElementById("search");
    search.addEventListener("keydown", function (e) {
        if (e.code === "Enter") {  //checks whether the pressed key is "Enter"
            searchf(e);
        }
    });
</script>
<div id="content">
    <div id="dirlist">
        <?php
        $hl_content = file_get_contents("headers/headers.json");
        $json = json_decode($hl_content);

        if (isset($_GET['sdk']))
        {
            if (isset($_GET['fw']))
            {
                if (isset($_GET['file']))
                {
                    include '_load_file.php';
                }
                else
                {
                    include '_load_framework.php';
                }
            }
            else
            {
                include '_load_sdk.php';
            }
        }
        else
        {
            foreach ($json as $title => $dir):
                echo "<div class=\"dir\" onclick=\"loadsdk('" . $dir . "')\">" . htmlentities($title) . "</div>";
            endforeach;
            echo "<pre><code class=\"hljs markdown\" id=\"filecontainer\">" . file_get_contents("headers/README.md") . "</code></pre>";

        }
        ?>
    </div>
    <?php
    if (isset($_GET['diff'])) {
        include '_diff.php';
    }
    else {
        echo "
    <script>
        renderLineNumbers();
    </script>";
    }
    ?>
    <pre id="logos" class="inactive">

    </pre>
</div>
</body>
</html>
