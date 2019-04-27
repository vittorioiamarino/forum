<?php

	require("database.php");
	$data = $_POST["data"];
	$param = "%$data%";

	//$stmt = $conn->prepare("SELECT * FROM thread WHERE titolo LIKE ?");
	
	//$stmt = $conn->prepare("SELECT *, T.id as thread_id, T.data as thread_data FROM `thread` AS T INNER JOIN `utente` AS U ON T.Utente_id = U.id WHERE T.titolo = ? ORDER BY T.data DESC");
	$stmt = $conn->prepare("SELECT *, T.id as thread_id, T.data as thread_data FROM thread as T INNER JOIN utente as U ON T.Utente_id = U.id WHERE T.titolo LIKE ?");
	$stmt->bind_param("s", $param);
	$stmt->execute();
	$result = $stmt->get_result();
	//if($result->num_rows === 0) exit('No rows');
	$results = $result->fetch_all(MYSQLI_ASSOC);

	/*if($result->num_rows === 0) {
		$res = ["error" => "no_results"];
		echo json_encode($res);
	}*/

	echo json_encode($results);

?>