<?php 
	require('classes/Game.class.php'); 

	if(empty($_SESSION)) {session_start();}
	unset($_SESSION["frames"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bowling Simulator</title>
                
        <!-- Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<style>
			table { background-color: #fff }
			table div { height: 25px;text-align: center }
			body { background: url("images/bowling-background.jpg") no-repeat center center fixed; background-size: cover; }
		</style>
    </head>
    <body>
    	<div class="col-12">

    		<div class="row mt-5">
    			<div class="col-md-2">
					<input id="pins" type="number" min="0" max="10" step="1" class="form-control mb-md-0 mb-2"/>
				</div>
				<div class="col-md-10 text-md-left text-right">
					<button id="submitScore" class='btn btn-primary' >
					   <i class="fas fa-bowling-ball"></i> Roll
					</button>

					<button class="btn btn-secondary ml-2" id="resetScore">
						<i class="fas fa-redo-alt"></i> Reset
					</button>
				</div>
			</div>
	        
			<div class="row mt-5" id="score">
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame1">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame2">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame3">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame4">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame5">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame6">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame7">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame8">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame9">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="2"><div class='text-primary h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
				<div class="col-xl-1 col-lg-3 col-md-4 col-sm-6" id="frame10">
					<table class="table table-bordered">
						<tr>
							<td><div></div></td>
							<td><div></div></td>
							<td><div></div></td>
						</tr>
						<tr>
							<td colspan="3"><div class='text-danger h4 font-weight-bold'></div></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<!-- JS Libraries -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>

		<!-- Custom Javascript -->
		<script src="js/function.js" type="text/javascript" language="javascript"></script>

    </body>
</html>



