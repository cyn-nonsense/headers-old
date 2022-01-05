
function methodDataSet() {
    var code = document.getElementById("filecontainer").innerText.split("\n")
    var items = []
    var line = 0
    for (const item in code) {
        line += 1;
        // console.log(code[item]);
        if (code[item].startsWith("-") || code[item].startsWith("+")) {
            items.push('meth|' + code[item]);
        }
        else items.push('')
    }
    return items;
}

function genLogosHooks() {
    let text = ""
    text += "%hook "
    let methids = methodDataSet()
    var code = document.getElementById("filecontainer").innerText.split("\n")
    for (const item in code) {
        if (code[item].startsWith("@interface ")) {
            text += code[item].split('@interface ')[1].split(' ')[0]
        }
    }
    text += "\n\n"
    let kids = document.getElementById("linenumbers").children
    let showlogos = 0
    for (const linenum in kids)
    {
        try {
            if (kids[linenum].classList.contains("selected"))
            {
                showlogos = 1;
                text += methids[kids[linenum].innerText].split('|')[1].split(';')[0] + '{\n\n}\n\n'
            }
        }
        catch {

        }

    }
    text += "%end\n"
    if (showlogos === 1) {
        document.getElementById("logos").classList.remove("inactive")
        document.getElementById("dirlist").classList.add("logosdisp")
        document.getElementById("logos").innerText = text;
    }
    else {
        document.getElementById("logos").classList.add("inactive")
        document.getElementById("dirlist").classList.remove("logosdisp")
    }
}