<?php
$id = $_REQUEST['id'];

$object = array(
	'title' => '',
	'round' => '',
	'solution' => '',
	'req_printing' => '',
	'req_sound' => '',
	'req_color' => '',
);


// Database conection credentials
$servername = 'localhost';
$username = 'homestead';
$password = 'secret';

// Create connection
$connection = new mysqli($servername, $username, $password);

// Check for an error
if ($connection->connect_error) {
	echo 'Connection failed: ' , $connection->connect_error;
	exit;
}

//Otherwise, connected successfully
//echo 'Connected successfully!';

// Connect to the fitl database
$connection->select_db('fitl');

// Query to select the object
$sql = 'SELECT * FROM puzzles WHERE id = ' . $id;

// Execute the query
$result = $connection->query($sql);

// Check for and retrieve the object
if ($result->num_rows > 0) {
	$object = $result->fetch_assoc();
	//echo '<pre>';
	//print_r($object);
	//echo '</pre>';
}

?>

<!DOCTYPE html>
<html>
	
	<head>
		<title><?php echo $object['title']; ?></title>
	</head>

	<body>
		<h1><?php echo $object['title']; ?></h1>
		<h2>Round: <?php echo $object['round']; ?></h2>
		<p>Solution: <?php echo $object['solution']; ?>
			<br>
			Requirements:
		</p>
		<pre>
			<?php 
				if ($object['req_printing'] == 1) {
					echo 'Requires printing';
				} else {
					echo 'Does not require printing';
				}
				?>
		</pre>
	</body>

</html>