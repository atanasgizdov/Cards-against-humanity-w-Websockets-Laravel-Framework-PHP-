
//open websocket connection on connect - moved to enter name page
var conn = new WebSocket('ws://localhost:8080');

var playersConnected;
var messageData;

//set on connect actions
conn.onopen = function(e) {
console.log("Connection established!");
};

//on message received
conn.onmessage = function(e) {
messageData = JSON.parse(e.data);
logMessage();

Object.keys(messageData).forEach(function(k){
		var iDiv = document.createElement('div');
		iDiv.id = k;
		iDiv.className = 'card';
		document.getElementsByTagName('body')[0].appendChild(iDiv);

		iDiv.innerHTML = messageData[k];

    //Object.keys(obj).forEach(function(k, v){
    //console.log(k + ' - ' + v);
});
};

function logMessage(){
  console.log(messageData);
}

//TODO Parse JSON and create a table of players
//TODO Add a popup window that captures real player names and associates them with ID // http://jsfiddle.net/M5PXE/2/

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
