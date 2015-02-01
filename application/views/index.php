<?php 
	session_start();

	if(!isset($_SESSION['score']) || empty($_SESSION['score'])){
		$_SESSION['score'] = 0;
		$_SESSION['log']= array('Welcome to Ninja Gold Country');
		$_SESSION['color']='green';
	}
?>

<!DOCTYPE HTML>
<html lang='en'>
<head>
	<title>Ninja gold game</title>
	<meta charset='UTF-8'>
	<meta name='description' content='fun game that finds gold in certain places'>
	<link rel='stylesheet' type='text/css'  href='../assets/ninjaGold.css'> 
</head>
<style>
</style>
<body>
	<div id='container'>
		<p>Your Gold</p>
		<p id='score'><?= $this->session->userdata('total'); ?></p>
		<div id='places'>
			<form action='/main/process_money' method='post'>
				<h3>Farm</h3>
				<p>(earns 10-20 golds)</p>
				<input type='submit' name='submit' value='Find Gold'>
				<input type='hidden' name='location' value='farm'>
			</form>
			<form action='/main/process_money' method='post'>
				<h3>Cave</h3>
				<p>(earns 5-10 golds)</p>
				<input type='submit' name='submit' value='Find Gold'>
				<input type='hidden' name='location' value='cave'>
			</form>
			<form action='/main/process_money' method='post'>
				<h3>House</h3>
				<p>(earns 2-5 golds)</p>
				<input type='submit' name='submit' value='Find Gold'>
				<input type='hidden' name='location' value='house'>
			</form>
			<form action='/main/process_money' method='post'>
				<h3>Casino</h3>
				<p>(earns/takes 0-50 golds)</p>
				<input type='submit' name='submit' value='Find Gold'>
				<input type='hidden' name='location' value='casino'>
			</form>
		</div>
		<form action='/main/reset' method='post'>
			<input  id='reset' type='submit' name='location' value='Reset'>
		</form>
		<h4>Activities</h4>
		<div id='logger'>
<?php
			foreach($this->session->userdata('log') as $key=>$message)
			{	
				echo $message.'<br/>'; 
			}
?>
		</div>
	</div>
</body>
</html>