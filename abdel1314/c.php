<?php
include_once 'connect.php';

switch ($_GET["table"]) {
	case "score":
<<<<<<< HEAD
		createScore($_GET);
		break;
	case "personne":
		createPersonne($_GET);
		break;
	case "document":
		createDocument($_GET);
		break;		
	default:
		;
=======
	createScore($_GET);
	break;
	case "personne":
	createPersonne($_GET);
	break;
	case "document":
	createDocument($_GET);
	break;		
	default:
	;
>>>>>>> b446527977cd3b7e3b79c13ffa7aed0f3e22e20e
	break;
}

function createScore($data){
	global $conn;
	
	$sql = "INSERT INTO scores (id_doc, id_perso, distance, maj)
	VALUES (".$data["id_doc"].", ".$data["id_perso"].", ".$data["distance"].",NOW())";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
	} else {
<<<<<<< HEAD
	    echo "Error: " . $sql . "<br>" . $conn->error;
=======
		echo "Error: " . $sql . "<br>" . $conn->error;
>>>>>>> b446527977cd3b7e3b79c13ffa7aed0f3e22e20e
	}	
}
function createPersonne($data){
	global $conn;
<<<<<<< HEAD
	
	$sql = "INSERT INTO personnes (nom)
	VALUES ('".$data["nom"]."')";
	echo "New record has id: " . mysqli_insert_id($conn);
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
=======
	$sql = "SELECT * FROM personnes where  nom = '". $data["nom"]."'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
		
		$sql = "INSERT INTO personnes (nom)
		VALUES ('".$data["nom"]."')";
		echo "New record has id: " . mysqli_insert_id($conn);
	//echo $sql;
		if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}	
		
	}



	
>>>>>>> b446527977cd3b7e3b79c13ffa7aed0f3e22e20e

}

// function createDocument($data){
// 	global $conn;
<<<<<<< HEAD
	
=======

>>>>>>> b446527977cd3b7e3b79c13ffa7aed0f3e22e20e
// 	$sql = "INSERT INTO documents (nom, latlng, url)
// 	VALUES (".$data["nom"].", ".$data["latlng"].", ".$data["url"].")";
// 	//echo $sql;
// 	if ($conn->query($sql) === TRUE) {
// 	    //echo "New record created successfully";
// 	} else {
// 	    echo "Error: " . $sql . "<br>" . $conn->error;
// 	}	
<<<<<<< HEAD
	
=======

>>>>>>> b446527977cd3b7e3b79c13ffa7aed0f3e22e20e
// }

$conn->close();
?>