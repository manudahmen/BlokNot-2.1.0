// Search for a specified string.
function playsong(searchStr) {
    $("#search-container").html("" +
        "<a href='https://www.youtube.com/results?search_query=" +
        searchStr + "' target='new'>link</a>" +
        "<a id='query' onclick='search()'></a>" +
        ""
    );
    /*$("#media").attr('src', "https://www.youtube.com/results?search_query=" +
     searchStr);*/
    $("#query").html(searchStr);
}

$("a").click(function (event) {
    event.preventDefault();
    playsong($(this).attr("value"));


});


// Search for a specified string.
function search() {
    var q = $('#query').html();
    var request = gapi.client.youtube.search.list({
        q: q,
        part: 'snippet'
    });

    request.execute(function (response) {
        var str = JSON.stringify(response.result);
        $('#search-container').html('<pre>' + str + '</pre>');
    });
}

function appendResults(text) {
    var results = document.getElementById("results");
    results.appendChild(document.createElement('P'));
    results.appendChild(document.createTextNode(text));
}

function makeRequest() {
    var request = gapi.client.urlshortener.url.get({
        'shortUrl': 'http://goo.gl/fbsS'
    });
    request.then(function (response) {
        appendResults(response.result.longUrl);
    }, function (reason) {
        console.log('Error: ' + reason.result.error.message);
    });
}

function init() {
    gapi.client.setApiKey('YOUR API KEY');
    gapi.client.load('urlshortener', 'v1').then(makeRequest);
}

var clientId = '837050751313';

var apiKey = 'AIzaSyAdjHPT5Pb7Nu56WJ_nlrMGOAgUAtKjiPM';

var scopes = 'https://www.googleapis.com/auth/plus.me';

function handleClientLoad() {
    // Step 2: Reference the API key
    gapi.client.setApiKey(apiKey);
    window.setTimeout(checkAuth, 1);
}

function checkAuth() {
    gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}

      