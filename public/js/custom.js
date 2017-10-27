function connectToSocket() {
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
    console.log("Connection established!");
};
}

function markCardAsSelected() {
    conn.send('Hello World!');
}
