
//open websocket connection on connect - moved to enter name page
var conn = new WebSocket('ws://localhost:8080');

var playersConnected;
var messageData;

//set on connect actions
conn.onopen = function(e) {
console.log("Connection established!");
};


//on message received - driven by "response codes" sent back from server
conn.onmessage = function(e) {
messageData = JSON.parse(e.data);
    // received a list of players currently in the game
    if (messageData.response_code == "1"){
    logMessage();
        //TODO drop existing cards, if any

        Object.keys(messageData.msg).forEach(function(k){
            var iDiv = document.createElement('div');
            iDiv.id = k;
            iDiv.className = 'card';
            document.getElementsByClassName('cards')[0].appendChild(iDiv);

            iDiv.innerHTML = "Another scrub has joined the game: <br>" + messageData.msg[k];

        });

    }

    // received a list of white cards - unique to this player
		if (messageData.response_code == "2"){
		logMessage();

				 Object.keys(messageData['msg']).forEach(function(k){
						var iDiv = document.createElement('div');
						iDiv.id = messageData['msg'][k]['card_id'];
						iDiv.className = 'card';
						document.getElementsByClassName('cards')[0].appendChild(iDiv);

						iDiv.innerHTML = messageData['msg'][k]['text'];
				});

		}
};

function logMessage(){
  console.log(messageData);
}

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
