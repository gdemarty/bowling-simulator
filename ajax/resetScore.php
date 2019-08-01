<?php 

//Kill the $_SESSION["frames"] to reset the game

if(empty($_SESSION)) {session_start();}

unset($_SESSION["frames"]);

?>