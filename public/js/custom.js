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

//TODO Parse JSON and create a table of players 

function markCardAsSelected(card) {

    //send server message card was selected
    conn.send(card);
    //grab all elements with Card class
    var cardsArray = document.getElementsByClassName("card");
    //remove highlight from all cards
    for(var i = 0; i < cardsArray.length; i++) {
        var element = cardsArray[i];
        element.style.boxShadow = "0px 0px 0px lightblue";
};
    //add highlight to current card
    cardsArray[card].style.boxShadow = "10px 20px 30px lightgreen";

}
