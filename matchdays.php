<?php
	/**
	* Gibt eine Verbindung zur Datenbank zurück
	*/
	function getConnection(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "uefa";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		return $conn;
	}
	/**
	* Schliesst eine Verbindung zur Datenbank
	*/
	function connectionClose($conn){
		$conn->close();
	}
	
	/**
	* gibt alle Spiele zurück
	*/
	function getAllGames(){
		$conn = getConnection();
		$games = [];
		
		// do stuff here
		
		return $games;
	}
	
	/**
	* gibt alle Matchtage zurück
	*/
	function getAllMatchdays(){
		$conn = getConnection();
		$sql = "SELECT id, title FROM matchdays";
		$result = $conn->query($sql);
		$matchdays = [];

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$matchdays[] = $row;
			}
		} else {
			echo "0 results";
		}
		connectionClose($conn);
		return $matchdays;
	}
	
	/**
	* speichert ein neues Spiel
	*/
	function saveNewGame(){
		if(isset($_POST['submit'])){
			$conn = getConnection();
			// do stuff here
			connectionClose($conn);
		}
	}
	
	/**
	* löscht ein neues Spiel
	*/
	function deleteGame(){
		if(isset($_POST['game_id'])){
			$conn = getConnection();
			// do stuff here
			connectionClose($conn);
		}
	}
	
	saveNewGame();
	deleteGame();
?>
<center>
	<h2> Neues Spiel hinzufügen </h2>

	<form action="http://localhost/me/matchdays.php" method="POST">
		Team 1<input type="text" name="team_first"><br>
		Team 2<input type="text" name="team_second"><br>
		Startdatum<input type="text"><br>
		<select name="matchday_id">
			<?php foreach(getAllMatchdays() as $matchday): ?>
			<option value="<?php echo $matchday['id']; ?>"><?php echo $matchday['title']; ?></option>
			<?php endforeach;?>
		</select>
		<br>
		<input name="submit" type="submit">
	</form>

	
	<h2> Spiele </h2>
<?php
	$games = getAllGames();
	foreach($games as $game){
		echo "<br>";
		echo $game['team_first']." ".$game['team_second']." ".$game['matchday_id'];
		echo '<form method="POST" action="http://localhost/me/matchdays.php">
		<input type="hidden" name="game_id" value="'.$game['id'].'">
		<input type="submit" value="DELETE">
		</form>';
	}
?>
 
<center>	
	