<?php 

require('classes/Game.class.php');

$SCORE = new Game();

//Frame 1
$SCORE->roll(5);
$SCORE->roll(4);

//Frame 2
$SCORE->roll(7);
$SCORE->roll(3);

//Frame 3
$SCORE->roll(0);
$SCORE->roll(10);

//Frame 4
$SCORE->roll(10);

//Frame 5
$SCORE->roll(3);
$SCORE->roll(3);

//Frame 6
$SCORE->roll(2);
$SCORE->roll(1);

//Frame 7
$SCORE->roll(2);
$SCORE->roll(8);

//Frame 8
$SCORE->roll(5);
$SCORE->roll(5);

//Frame 9
$SCORE->roll(3);
$SCORE->roll(0);

//Frame 10
$SCORE->roll(8);
$SCORE->roll(1);

$SCORE->score();

?>

<pre>
	<?php print_r($SCORE->frames);?>
</pre>

<?php 

$total = 0;

foreach ($SCORE->frames as $frame) {
	$total += $frame["total"] ?? 0;
}

echo "FINAL SCORE: ".$total;

?>