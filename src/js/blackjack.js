// deck of 52 cards
var cardsInDeck = 52;

let card_tab =        [{path: "img/AC.png", value: 1},
                  {path: "img/2C.png", value: 2},
                  {path: "img/3C.png", value: 3},
                  {path: "img/4C.png", value: 4},
                  {path: "img/5C.png", value: 5},
                  {path: "img/6C.png", value: 6},
                  {path: "img/7C.png", value: 7},
                  {path: "img/8C.png", value: 8},
                  {path: "img/9C.png", value: 9},
                  {path: "img/TC.png", value: 10},
                  {path: "img/JC.png", value: 10},
                  {path: "img/QC.png", value: 10},
                  {path: "img/KC.png", value: 10},
                  {path: "img/AD.png", value: 1},
                  {path: "img/2D.png", value: 2},
                  {path: "img/3D.png", value: 3},
                  {path: "img/4D.png", value: 4},
                  {path: "img/5D.png", value: 5},
                  {path: "img/6D.png", value: 6},
                  {path: "img/7D.png", value: 7},
                  {path: "img/8D.png", value: 8},
                  {path: "img/9D.png", value: 9},
                  {path: "img/TD.png", value: 10},
                  {path: "img/JD.png", value: 10},
                  {path: "img/QD.png", value: 10},
                  {path: "img/KD.png", value: 10},
                  {path: "img/AH.png", value: 1},
                  {path: "img/2H.png", value: 2},
                  {path: "img/3H.png", value: 3},
                  {path: "img/4H.png", value: 4},
                  {path: "img/5H.png", value: 5},
                  {path: "img/6H.png", value: 6},
                  {path: "img/7H.png", value: 7},
                  {path: "img/8H.png", value: 8},
                  {path: "img/9H.png", value: 9},
                  {path: "img/TH.png", value: 10},
                  {path: "img/JH.png", value: 10},
                  {path: "img/QH.png", value: 10},
                  {path: "img/KH.png", value: 10},
                  {path: "img/AS.png", value: 1},
                  {path: "img/2S.png", value: 2},
                  {path: "img/3S.png", value: 3},
                  {path: "img/4S.png", value: 4},
                  {path: "img/5S.png", value: 5},
                  {path: "img/6S.png", value: 6},
                  {path: "img/7S.png", value: 7},
                  {path: "img/8S.png", value: 8},
                  {path: "img/9S.png", value: 9},
                  {path: "img/TS.png", value: 10},
                  {path: "img/JS.png", value: 10},
                  {path: "img/QS.png", value: 10},
                  {path: "img/KS.png", value: 10}
                ];

// unknown card path and value
var secretBankCardPath;
var secretBankCardValue;

// when the user clicks on the Play button
function startGame() {
  // check value of bet
  if (!checkBet()) {
    alert("Please enter a valid bet : value between 1 and the total amount of money.");
    return;
  }
  // display game (and disable play button)
  displayGame();
  $("html, body").animate({ scrollTop: $(document).height() }, 1000);
}

// check if the amount of the bet is valid
function checkBet() {
  var currentMoney = Number($("#user-money").html());
  var currentBet = Number($("#amountBet").val());
  var remainingMoney = Number(currentMoney - currentBet);
  if (currentBet <= 0 || currentBet > currentMoney) {
    return false;
  } else {
    return true;
  }
}

// display the game
function displayGame() {
  // display game section
  $("#game").show();
  $("#amountBet").prop("disabled", "true");
  $("#button-play").prop("disabled", "true");
  $("#button-draw-cards").show();
}

//Lancement du jeu via click ou touche entrée
$("#button-play").on('click', startGame);
$('#amountBet').keypress(function (e) {
  if (e.which == 13) {
	$("#button-play").click();
  }
});

// when the user clicks on the New Card button
function drawCards() {
  // update display
  updateGameSectionDisplay();
  // display first 2 cards
  let bankCard1ID = getRandomIdCard();
  let bankCard2ID = getRandomIdCard();
  let userCard1ID = getRandomIdCard();
  let userCard2ID = getRandomIdCard();
  addSimpleCard('bank-cards', card_tab[bankCard1ID.toString()]["path"]);
  
  //Face cachée
  var img = $('<img>');
	img.attr('src', "img/01_Card_Backs/red_back.png");
	img.attr('alt', 'card');
	img.attr('class', 'playcard');
	img.attr('secret', 'true');
	img.appendTo('#bank-cards');
  
  secretBankCardPath = card_tab[bankCard2ID.toString()]["path"];
  addSimpleCard('user-cards', card_tab[userCard1ID.toString()]["path"]);
  addSimpleCard('user-cards', card_tab[userCard2ID.toString()]["path"]);
  // update level
  secretBankCardValue = Number($("#bank-level").html()) + card_tab[bankCard1ID.toString()]["value"] + card_tab[bankCard2ID.toString()]["value"];
  $("#bank-level").html("?");
  var userLevel = Number($("#user-level").html()) + card_tab[userCard1ID.toString()]["value"] + card_tab[userCard2ID.toString()]["value"];
  $("#user-level").html(userLevel);
  // remove these cards of the deck
  card_tab.splice(bankCard1ID.toString(), 1);
  card_tab.splice(bankCard2ID.toString(), 1);
  card_tab.splice(userCard1ID.toString(), 1);
  card_tab.splice(userCard1ID.toString(), 1);
  cardsInDeck -= 4;
  $("html, body").animate({ scrollTop: $(document).height() }, 1000);
}

// update display in game section
function updateGameSectionDisplay() {
  let noCardsText = $(".no-cards");
  for (let i = 0; i < noCardsText.length; i++) {
    noCardsText[i].style.display = "none";
  }
  $("#button-draw-cards").toggle();//h
  $("#button-hit").toggle();//s
  $("#button-stand").toggle();//s
  $("#button-double").toggle();//s
}

function addSimpleCard(parentId, cardImagePath) {
	var img = $('<img>');
	img.attr('src', cardImagePath);
	img.attr('alt', 'card');
	img.attr('class', 'playcard');
	img.appendTo('#'+parentId).hide().fadeIn(1000);
}

// get random card
function getRandomIdCard() {
  return Math.floor((Math.random() * cardsInDeck));
}

$("#button-draw-cards").on('click', drawCards);

function hit() {
  // display a card
  let userCardID = getRandomIdCard();
  addSimpleCard('user-cards', card_tab[userCardID.toString()]["path"]);
  // update level
  var userLevel = Number($("#user-level").html()) + card_tab[userCardID.toString()]["value"];
  $("#user-level").html(userLevel);
  // remove these cards of the deck
  card_tab.splice(userCardID.toString(), 1);
  cardsInDeck -= 1;

  if (userLevel === 21){
    playBank();
  } else if (userLevel > 21) {
    throwResult();
  }
}

$("#button-hit").on('click', hit);

function stand() {
  playBank();
}

$("#button-stand").on('click', stand);

function double() {
  // we increase the value of the bet then hit
  var currentBet = Number($("#amountBet").val());
  var newBet = currentBet * 2;
  var currentMoney = Number($("#user-money").html());
  if (newBet > currentMoney) {
    alert("You can't double, you don't have enough money!");
  } else {
    $("#amountBet").val(newBet);
    hit();
  }
}

$("#button-double").on('click', double);

function playBank() {
	$("#bank-cards").last().src = secretBankCardPath;
	/*let lastCard = $("#bank-cards").lastElementChild;
	lastCard.src = secretBankCardPath;*/
	$("#bank-level").html(secretBankCardValue);

	
	$("[secret]").fadeOut('fast');
	$("[secret]").attr('src',secretBankCardPath);
	
	$("[secret]").fadeIn('fast');
	
		while (secretBankCardValue < 17) {
			// add a card
				let bankCardID = getRandomIdCard();
				addSimpleCard('bank-cards', card_tab[bankCardID.toString()]["path"]);
				// update level
				secretBankCardValue += card_tab[bankCardID.toString()]["value"];
				$("#bank-level").html(secretBankCardValue);
				// remove these cards of the deck
				card_tab.splice(bankCardID.toString(), 1);
				cardsInDeck -= 1;
			}
	throwResult();
}

function throwResult() {
  var bankLevel = Number($("#bank-level").html());
  var userLevel = Number($("#user-level").html());

  $("#result").show();

  if (userLevel > 21) {
    $("#result").html("You're over 21, you lost!");
	$("#user-circle").css("backgroundColor", "red");
    bankGetTheMoney();
  } else if (bankLevel > 21) {
    $("#result").html("The bank is over 21, you won!");
	$("#bank-circle").css("backgroundColor", "red");
    userGetTheMoney();
  } else if (bankLevel === userLevel) {
    $("#result").html("It's a tie!");
    $("#result").css("color", "black");
  } else if (bankLevel > userLevel) {
    $("#result").html("The bank has a better score, you lost!");
    bankGetTheMoney();
  } else if (bankLevel < userLevel) {
    $("#result").html("You have the best score, you won!");
    userGetTheMoney();
  }

  // disable game buttons and enable new game button
  $("#button-hit").hide();
  $("#button-stand").hide();
  $("#button-double").hide();
  $("#button-start-new-game").show();

  var userMoney = Number($("#user-money").html());
  var bankMoney = Number($("#bank-money").html());
  if (userMoney <= 0) {
    alert("Game Over !");
    window.location.reload();
  } else if (bankMoney <= 0) {
    alert("Victory !");
    window.location.reload();
  }
}

function bankGetTheMoney() {
  var moneyBank = Number($("#bank-money").html());
  var userBank = Number($("#user-money").html());
  var currentBet = Number($("#amountBet").val());
  $("#bank-money").html(moneyBank + currentBet);
  $("#user-money").html(userBank - currentBet);
  $("#result").css("color", "red");
}

function userGetTheMoney() {
  var moneyBank = Number($("#bank-money").html());
  var userBank = Number($("#user-money").html());
  var currentBet = Number($("#amountBet").val());
  $("#bank-money").html(moneyBank - currentBet);
  $("#user-money").html(userBank + currentBet);
  $("#result").css("color", "green");
}

function startNewGame() {
  $("#result").hide();
  $("#button-start-new-game").hide();
  $("#button-hit").hide();
  $("#button-stand").hide();
  $("#button-double").hide();
  $("#button-draw-cards").hide();
  $("#game").hide();
  $("#user-circle").css("backgroundColor", "green");
  $("#bank-circle").css("backgroundColor", "green");
  let noCardsText = $(".no-cards");
  for (let i = 0; i < noCardsText.length; i++) {
    noCardsText[i].style.display = "inline";
  }
  // delete all cards
  $("#bank-cards").empty();
  $("#user-cards").empty();
  
  // delete previous score
  $("#bank-level").html("0");
  $("#user-level").html("0");
  // enable bet
  $("#amountBet").prop('disabled', false);
  //$("#amountBet").val("0");
  $("#button-play").prop('disabled', false);
}

$("#button-start-new-game").on('click', startNewGame);
