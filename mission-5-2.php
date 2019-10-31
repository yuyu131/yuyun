<html>

	<meta charset="UTF-8">

	<body>

	

		<form method="post">

			<input type="text" name="name" size="" value="名前を入れてね"> <br>

			<input type="text" name="comment" size="" value="コメントしてください"> <br>

			<input type = "submit" name = "add" value ="Submit">

		</form>

		

		<form method="post">

			<input type="number" name="ID" size="" value="0" min=0 max=<?php echo 10; ?> > <br>

			<input type = "submit" name = "delete" value ="Delete">

		</form>

		

		<?php

			if (isset($_POST["add"])){

				$name = $_POST["name"];

				$comment = $_POST["comment"]; //get comment

				$time = date("Y/m/d H:i:s");

			

		
                        
			$dsn = 'mysql:dbname=tb210464db;host=localhost';

			$user = 'tb-210464';

			$password = 'kmCFPtnjhC';

			$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

			echo "database login...<br>";



			$sql = "CREATE TABLE IF NOT EXISTS formtablea"

				." ("

				. "id INT AUTO_INCREMENT PRIMARY KEY,"

				. "name char(32),"

				. "comment TEXT,"

				. "time datetime"

				.");";

				$stmt = $pdo->query($sql);

				echo "create table...<br>";		

	

			$sql = $pdo -> prepare("INSERT INTO formtablea (name, comment, time) VALUES (:name, :comment, :time)");

			$sql -> bindParam(':name', $name, PDO::PARAM_STR);

			$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);

			$sql -> bindParam(':time', $time, PDO::PARAM_STR);

			$sql -> execute();

			echo "insert info...<br>";

			echo "<hr>";	

	

			$sql = 'SELECT * FROM formtablea';

			$stmt = $pdo->query($sql);

			$results = $stmt->fetchAll();

			foreach ($results as $row){

				//$rowの中にはテーブルのカラム名が入る

				echo $row['id'].'<br>';

				echo $row['name'].'<br>';

				echo $row['comment'].'<br>';

				echo $row['time'].'<br>';

			echo "<hr>";

			}

		}

		?>

	



	</body>

<html>

