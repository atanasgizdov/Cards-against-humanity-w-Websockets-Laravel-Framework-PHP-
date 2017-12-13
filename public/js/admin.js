
//open websocket connection on connect - moved to enter name page
var conn = new WebSocket('ws://localhost:8080');

var playersConnected;
var messageData;
var nameSet = false;

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

      // destroy existing dom cards, if any
      removeChildren (document.getElementsByClassName('cards')[0]);

          // for each card object returned
				 Object.keys(messageData['msg']).forEach(function(k){

           // create dom elements for each card
            var linebreak = document.createElement("br");
						var iDiv = document.createElement('div');
            var iDiv2 = document.createElement('div');
            var iDiv3 = document.createElement('div');
            var card_img = document.createElement("img");

            //set id's for card div - this is the ID of the card rendered
						iDiv.id = messageData['msg'][k]['cards_id'];

            //add onclick
            //iDiv.onclick = logMessage;
            //iDiv.onclick = function() {logMessage("test");};
            iDiv.onclick = function() {markCardAsSelected(iDiv.id);};

            //set class
            iDiv.className = 'card';
            card_img.className = 'card';

            //set content
            card_img.setAttribute("src", "https://pbs.twimg.com/profile_images/923599161940955136/KtK4rkf1.jpg");
            iDiv2.innerHTML = messageData['msg'][k]['title'];
            iDiv3.innerHTML = messageData['msg'][k]['text'];

            iDiv.appendChild(card_img);
            iDiv2.appendChild(iDiv3);
            iDiv.appendChild(iDiv2);
            document.getElementsByClassName('cards')[0].appendChild(iDiv);
            document.getElementsByClassName('cards')[0].appendChild(linebreak);

				});

		}
};

//debuggers
function logMessage(){
  console.log(messageData);
}

function logMessage2(msg){
  console.log(msg);
}

// sends card id to server + stlying for selected card
function markCardAsSelected(card) {

    //send server message card was selected
    buildCardJSON(card);
    //grab all elements with Card class
    var cardsArray = document.getElementsByClassName("card");
    //remove highlight from all cards
    for(var i = 0; i < cardsArray.length; i++) {
        var element = cardsArray[i];
        element.style.boxShadow = "0px 0px 0px lightblue";
};
    //add highlight to current card
    document.getElementById(card).style.boxShadow = "5px 5px 5px lightgreen";

}

// build JSON object for card user selects

function buildCardJSON (card) {
   var cardObject = {};
   cardObject.msg = 3;
   cardObject.card = card;
   cardObject = JSON.stringify(cardObject);
   conn.send(cardObject);
}

// misc JS for manipulating page

// load modal on load so that player enters name
$(window).on('load',function(){
    $('#myModal').modal('show');
});

// updates UserName, based on entry from modal - UI only
function sendUserName(){
  var playerName_UIOnly = $('#user_name_ui').val();
  document.getElementById('user_name_ui_show').innerHTML = playerName_UIOnly;
  conn.send(playerName_UIOnly);
  nameSet = true;
}

// remove children nodes from current element

function removeChildren (div) {
  while (div.hasChildNodes()) {
    div.removeChild(div.lastChild);
  }
}
