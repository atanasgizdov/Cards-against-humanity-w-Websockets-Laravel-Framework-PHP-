function connectToSocket() {
    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function(e) {
    console.log("Connection established!");
    var players = JSON.parse(e.data);
    console.log(players);
};

    conn.onmessage = function(e) {
    var obj = JSON.parse(e.data);
    console.log(obj);
    };
}

function markCardAsSelected(card) {
    conn.send(card);
}
