function connectToSocket() {

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
