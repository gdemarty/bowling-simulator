<?php

require('../classes/Game.class.php');

if(empty($_SESSION)) {session_start();}

//Init Variables
$error 			= false;
$valueReturned 	= null;

//Params
$pins = filter_var(intval($_POST['pins']), FILTER_VALIDATE_INT );

try{
	$SCORE	= new Game;
	$SCORE->frames = $_SESSION["frames"] ?? [[]];
	
	$SCORE->roll($pins);
	$SCORE->score();

	$valueReturned 		= json_encode($SCORE->frames);
	$_SESSION["frames"] = $SCORE->frames;
}
catch (Exception $e) {
	$error 	 	   = true;
	$valueReturned = $e->getMessage();
}

header($_SERVER['SERVER_PROTOCOL'] . ($error ? ' 500 Internal Server Error' : ' 200 OK'), true, ($error ? 500 : 200) ) ;
header('Content-Type: text/plain');
echo $valueReturned;
