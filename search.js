
function makeQuery(filen)
{
    var getJSON = function(url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.responseType = 'json';
        xhr.onload = function() {
            var status = xhr.status;
            if (status === 200) {
                callback(null, xhr.response);
            } else {
                callback(status, xhr.response);
            }
        };
        xhr.send();
    };
    getJSON('/class_search.php?sdk=' + sdk + "&q=" + filen,
        function(err, data) {
            if (err !== null) {
                alert('Something went wrong: ' + err);
            } else {
                window.location.href = "/index.php?sdk=" + sdk + "&fw=" + data[0]["fw"] + "&file=" + data[0]["file"]
            }
        });
}

function searchf(e) {
    text = e.target.value;
    makeQuery(text);
}
