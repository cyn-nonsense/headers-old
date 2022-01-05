
function renderDiffLineNumbers() {
    var code = document.getElementById("diffcontainer").innerText.split("\n")
    document.getElementById("difflinenumbers").innerHTML = "";
    for (const item in code) {
        document.getElementById("difflinenumbers").innerHTML += "<div id=\"diff-line-" + item + "\">" +  item + "</div>\n";
    }
}

function processDiff(difftext) {
    for (const index in difftext.split("\n")) {
        let item = difftext.split("\n")[index];
        if (!item.startsWith('<') && !item.startsWith('>') && !item.startsWith('-')) {
            if (item.includes('c')) {
                let leftn = item.split('c')[0] - 1
                let rightn = item.split('c')[1]
                if (rightn.includes(','))
                {
                    let s = rightn.split(',')[0] - 1;
                    let e = rightn.split(',')[1] - 1;
                    let lines = range(s, e, 1);
                    for (const i in lines) {
                        let ln = lines[i];
                        console.log(ln);
                        document.getElementById("diff-line-" + ln).classList.add("addition");
                    }
                }
                else {
                    document.getElementById("diff-line-" + (rightn - 1)).classList.add("addition");
                }
                document.getElementById("line-" + leftn).classList.add("subtraction");
            }
            else if (item.includes('a'))
            {
                let leftn = item.split('a')[0] - 1;
                let rightn = item.split('a')[1];
                if (rightn.includes(','))
                {
                    let s = rightn.split(',')[0] - 1;
                    let e = rightn.split(',')[1] - 1;
                    let lines = range(s, e, 1);
                    for (const i in lines) {
                        let ln = lines[i];
                        console.log(ln);
                        document.getElementById("diff-line-" + ln).classList.add("addition");
                    }
                }
                else {
                    document.getElementById("diff-line-" + (rightn - 1)).classList.add("addition");
                }
            }
            else if (item.includes('d'))
            {

                let leftn = item.split('d')[0] - 1;
                document.getElementById("line-" + leftn).classList.add("subtraction");
            }
        }
    }
}

function diff_changed() {
    var diff_against = document.getElementById("diff-select").value;
    sdk = urlParams.get('sdk')
    fw = urlParams.get('fw')
    fn = urlParams.get('file')
    window.location.href = "/index.php?sdk=" + sdk + "&fw=" + fw + "&file=" + encodeURIComponent(fn) + "&diff=" + diff_against;
}
