<?php
include_once 'connect.php';

switch ($_GET["table"]) {
	case "score":
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
	break;
}

function createScore($data){
	global $conn;
	
	$sql = "INSERT INTO scores (id_doc, id_perso, pays, maj)
	VALUES (".$data["id_doc"].", ".$data["id_perso"].", NOW())";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
function createPersonne($data){
	global $conn;
	
	
	
	$sql = "INSERT INTO personnes (nom)
	VALUES ('".$data["nom"]."')";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
}
function createDocument($data){
	global $conn;

	
	

	$sql = "INSERT INTO documents (nom, pays, url)

	VALUES ('".$data["nom"]."', '".$data["pays"]."' , '".$data["url"]."')";
	//echo $sql;
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	





}


$conn->close();
