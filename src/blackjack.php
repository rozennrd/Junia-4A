<!DOCTYPE html>

<?php
session_start();
//Si un utilisateur non connecté essaye d'accéder à cette partie
//on le redirige immédiatemment vers la page de connexion
if (!isset($_SESSION['login'])){
  header('Location: connect.php');
}
?>

<html>
  <?php 
    $page = basename(__FILE__);
    $name = '';
    include ('head.php');


  ?>
  <body>

    <?php include ('header.php') ?>
    <!-- title -->
    <h1 class="big-title centered"><?php echo $name ?></h1>

    <!-- content -->
    <div class="container">
      <!-- Money money money -->
      <div class="jumbotron row centered shadow rounded">
        <div class="col">
          <p>The bank's money:</p>
          <p id="bank-money">1000</p>
        </div>
        <div class="col">
          <p>Your money:</p>
          <p id="user-money">1000</p>
        </div>
      </div>
      <!-- Place your bet -->
      <div class="bloc">
        <div class="row justify-content-center align-items-center">
          <div class="col-md-4">
            <img src="img/token.png" alt="token" width="50%">
          </div>
          <input id="amountBet" type="number" class="col-md-2 form-control" placeholder="Enter bet">
          <button id="button-play" type="button" class="btn btn-secondary align-items-center col-md-2" style="margin-left: 6px;">Play</button>
        </div>
      </div>
      <!-- Cards -->
      <div id="game" class="bloc border-top" style="display: none;">
        <div class="row centered">
          <!-- Bank's cards -->
          <div class="col">
            <h2>The bank's cards</h2>
            <p class="vertical-margin">
				<div id="bank-circle" class="circle-container">
					<span id="bank-level">0</span>
				</div>
			</p>
            <p class="no-cards">No cards yet!</p>
            <div id="bank-cards">
            </div>
          </div>
          <!-- User's cards -->
          <div class="col">
            <h2>Your cards</h2>
            <p class="vertical-margin" >
				<div id="user-circle" class="circle-container">
					<span id="user-level">0</span>
				</div>
			</p>
            <p class="no-cards">No cards yet!</p>
            <div id="user-cards">
            </div>
		  </div>
		</div>
	  </div>
        <div class="centered vertical-margin">
          <p class="centered"><button type="button" id="button-draw-cards" class="btn btn-secondary" style="display:none">Draw cards!</button></p>
          <div>
            <button type="button" id="button-hit" class="btn btn-secondary col-md-2" style="display: none;">Hit</button>
            <button type="button" id="button-stand" class="btn btn-secondary col-md-2" style="display: none;">Stand</button>
            <button type="button" id="button-double" class="btn btn-secondary col-md-2" style="display: none;">Double</button>
          </div>
          <div id="result" class="card" style="display: none;">
            <p></p>
          </div>
          <button type="button" id="button-start-new-game" class="btn btn-secondary" style="display: none;">Start a new game</button>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/blackjack.js"></script>
  </body>
</html>
