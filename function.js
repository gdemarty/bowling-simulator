var BowlingFcts=function(){
	return{
		init:function(){

		//EVENTS
			//Add value from #pins to the game score when clicking on submit button 
			$( "#submitScore" ).on( "click", function( e ) {
				addRoll();
			});

			//Add value from #pins to the game score when clicking on RETURN key
			$('#pins').on('keyup', function( e ) {
		        if(e.keyCode == 13){
		        	addRoll();
		        }
		   	});

			//Reset current game when clicking on Reset button
			$( "#resetScore" ).on( "click", function( e ) {
				resetGame();
			});


		//FUNCTIONS
			//Add to the game the roll entered in #pins input
			function addRoll(){
				pins = $("#pins").val();

				if(pins % 1 != 0 || !pins){
					Swal.fire(
					  'Error',
					  'Please enter a valid number',
					  'error'
					)

					return false;
				}
				
				$("#pins").val('');

				$.ajax({
					method: "POST",
					url: "ajax/addRoll.php",
					data: { pins: pins }
				})
				.done(function( frames ) {
					framesJSON = $.parseJSON(frames);
					total      = 0;

					$.each(framesJSON, function( index, value ) {

						frameNumber = index+1;

						//if Strike or Spare in last frame
						if(frameNumber == 11){
							if(framesJSON[9][0] == 10){
								$("#score #frame10 tr:nth-child(1) td:nth-child(2) div").html( value[0] );
								
								if(typeof value[1] !== "undefined"){
									$("#score #frame10 tr:nth-child(1) td:nth-child(3) div").html( value[1] );
								}
							}
							else if(framesJSON[9][0] + framesJSON[9][1] == 10){
								$("#score #frame10 tr:nth-child(1) td:nth-child(3) div").html( value[0] );
							}
							else{
								return false;
							}
						}
						else if(frameNumber == 12){						
							if(typeof value[0] !== "undefined"){
								$("#score #frame10 tr:nth-child(1) td:nth-child(3) div").html( value[0] );
							}
						}
						else{
							total = total + (typeof value["total"] !== "undefined" ? value["total"] : 0);
						}

						if(typeof value[0] !== "undefined"){
							$("#score #frame"+frameNumber+" tr:nth-child(1) td:nth-child(1) div").html( value[0] );
						}

						if(typeof value[1] !== "undefined"){
							$("#score #frame"+frameNumber+" tr:nth-child(1) td:nth-child(2) div").html( value[1] );
						}

						if(typeof value["total"] !== "undefined"){
							$("#score #frame"+frameNumber+" tr:nth-child(2) td:nth-child(1) div").html( total );
						}

					});

					//Focus back to the #pins input
					$("#pins").focus();

				})
				.fail(function(returnedMessage) {
					Swal.fire(
					  'Error',
					  returnedMessage.responseText,
					  'error'
					)
				});
			}

			//Reset current game (kill $_SESSION["frames"] variable)
			function resetGame(){
				$.ajax({
					method: "POST",
					url: "ajax/resetScore.php",
				})
				.done(function( msg ) {
					//Clear tables
					$("table div").empty();
					//Clear #pins input
					$("#pins").val("");
					//Focus back to the #pins input
					$("#pins").focus();

					Swal.fire(
					  'Reset',
					  'Your game has been reset.',
					  'success'
					)
				});
			}
		}
	}
}();

jQuery(document).ready(function(){
	BowlingFcts.init()
});