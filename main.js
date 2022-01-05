
if (!window.location.href.includes('https://headers.cynder.me'))
// Redirect http://cynder and/or https://krit.me to the official location
{
    window.location.replace("https://headers.cynder.me/" + document.location.search);
}

const urlParams = new URLSearchParams(window.location.search);
var sdk = urlParams.get('sdk')
var file = urlParams.get('file')
let selected = []

var fw = urlParams.get('fw')
if (!file.includes('.'))
{
    window.location.href = '/headers/' + sdk + '/' + fw + '/' + file
}
switch (file.split('.')[1])
{
    case 'h':
        document.getElementById('filecontainer').classList.add('language-objectivec')
        break;
    case 'tbd':
        document.getElementById('filecontainer').classList.add('language-yaml')
        break;
}
function home()
{
    window.location.href = "/"
}
function loadsdk(dir)
{
    window.location.href = "/index.php?sdk=" + dir
}
function loadfw(fw)
{
    const urlParams = new URLSearchParams(window.location.search);
    sdk = urlParams.get('sdk')
    window.location.href = "/index.php?sdk=" + sdk + "&fw=" + fw
}
function loadfn(fn)
{
    const urlParams = new URLSearchParams(window.location.search);
    sdk = urlParams.get('sdk')
    fw = urlParams.get('fw')
    window.location.href = "/index.php?sdk=" + sdk + "&fw=" + fw + "&file=" + encodeURIComponent(fn)
}
function togfold(fold)
{
    folder = document.getElementById(fold)
    if (folder.classList.contains('closed'))
    {
        folder.classList.remove('closed')
    }
    else {
        folder.classList.add('closed')
    }
}

function selline(line_number) {
    var lineNumberItem = document.getElementById("line-" + line_number)
    if (lineNumberItem.classList.contains("selected")) {
        lineNumberItem.classList.remove("selected")
    } else {
        lineNumberItem.classList.add("selected")
    }
    genLogosHooks();
}

function renderLineNumbers() {
    var code = document.getElementById("filecontainer").innerText.split("\n")
    document.getElementById("linenumbers").innerHTML = "";
    for (const item in code) {
        document.getElementById("linenumbers").innerHTML += "<div id=\"line-" + item + "\"" + " onclick=\"selline(" + item + ")\"" +">" +  item + "</div>\n";
    }
}

function body_onload() {
    console.log('                 ___====-_  _-====___\n' +
        '           _--^^^#####//      \\\\#####^^^--_\n' +
        '        _-^##########// (    ) \\\\##########^-_\n' +
        '       -############//  |\\^^/|  \\\\############-\n' +
        '     _/############//   (@::@)   \\\\############\\_\n' +
        '    /#############((     \\\\//     ))#############\\\n' +
        '   -###############\\\\    (oo)    //###############-\n' +
        '  -#################\\\\  /    \\  //#################-\n' +
        ' -###################\\\\/      \\//###################-\n' +
        '_#/|##########/\\######(   /\\   )######/\\##########|\\#_\n' +
        '|/ |#/\\#/\\#/\\/  \\#/\\##\\  |  |  /##/\\#/  \\/\\#/\\#/\\#| \\|\n' +
        '`  |/  V  V  `   V  \\#\\| |  | |/#/  V   \'  V  V  \\|  \'\n' +
        '   `   `  `      `   / | |  | | \\   \'      \'  \'   \'\n' +
        '                    (  | |  | |  )    headers.cynder.me\n' +
        '   js codebase     __\\ | |  | | /__   @arm64e\n' +
        '                  (vvv(VVV)(VVV)vvv)  gh/cxnder/headers')
}