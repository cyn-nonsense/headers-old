<?php
if (strpos($_GET['file'], '..') === false and strpos($_GET['fw'], '..') === false and strpos($_GET['sdk'], '..') === false)
{
    echo "<div id='diffcontainer'>";
    $filename = 'headers/' . $_GET['diff'] . '/' . $_GET['fw'] . '/' . $_GET['file'];
    echo "<pre id=\"difflinenumbers\" onload='renderDiffLineNumbers()'></pre>";
    echo "<pre><code class=\"hljs\" id=\"diffcontainer\">" . htmlentities(file_get_contents($filename)) . "</code></pre>";
    echo "</div>";
    echo "<script>
var isSyncingLeftScroll = false;
var isSyncingRightScroll = false;
var leftDiv = document.getElementById('dirlist');
var rightDiv = document.getElementById('diffcontainer');

leftDiv.onscroll = function() {
  if (!isSyncingLeftScroll) {
    isSyncingRightScroll = true;
    rightDiv.scrollTop = this.scrollTop;
  }
  isSyncingLeftScroll = false;
}

rightDiv.onscroll = function() {
  if (!isSyncingRightScroll) {
    isSyncingLeftScroll = true;
    leftDiv.scrollTop = this.scrollTop;
  }
  isSyncingRightScroll = false;
}
</script>";
    echo "<script>";
    echo "renderDiffLineNumbers();renderLineNumbers();";
    $cmd = "diff " . 'headers/' . $_GET['sdk'] . '/' . $_GET['fw'] . '/' . $_GET['file'] . " " . $filename;
    if (preg_match("^[a-zA-Z0-9\.\/]*?.h$", $cmd)) {
        $output = shell_exec($cmd);
    }
    else {
        $output = 'bad kitty';
    }
    echo "let diffcontent = `" . $output . "`;";
    echo "processDiff(diffcontent);";
    echo "</script>";
}
?>