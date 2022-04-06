<?php
    require_once("functions.inc");
      //prevent access if they haven't submitted the form.
    if (!isset($_POST['submit'])) {
          die(header("Location: edit.php"));
	  }

    $id = "";

    if(!empty($_GET['id'])){
      $id = trim($_GET['id']);
    }

    if(updateStudent($_POST, $id)) {
    	unset($_SESSION['formAttempt']);
    	die(header("Location: index.php"));
    } else {
    	error_log("Problem update user: {$_POST['firstName']}");
    	$_SESSION['error'][] = "Problem update account";
    	die(header("Location: edit.php"));
    	}
    function updateStudent($userData, $id) {
    $mysqli = new mysqli(DBHOST,DBUSER,DBPASS,DB);
    if ($mysqli->connect_errno) {
    	error_log("Cannot connect to MySQL: " . $mysqli->connect_error);
    	return false;
    }
    
    $firstName = $mysqli->real_escape_string($_POST['firstName']);
    $lastName = $mysqli->real_escape_string($_POST['lastName']);

    if (isset($_POST['contactNum'])) {
    	$contactNum = $mysqli->real_escape_string($_POST['contactNum']);
    } else {
    	$contactNum = "";
    }
    if (isset($_POST['vaccinated'])) {
    	$vaccinated = $mysqli->real_escape_string($_POST['vaccinated']);
      if ($vaccinated == "yes") {
        $vaccinated = 1;
      }
      else {
        $vaccinated = 0;
      }
    } else {
    	$vaccinated = "";
    }
    if (isset($_POST['course'])) {
    	$course = $mysqli->real_escape_string($_POST['course']);
    } else {
    	$course = "";
    }

    //process uploading image
    $target_dir = "uploads/";
    var_dump($_FILES);
    $target_file = $target_dir . basename($_FILES['profile']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['profile']['tmp_name']);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

    //update into database
    $query = "UPDATE Students SET firstName = '{$firstName}', lastName = '{$lastName}', contactNumber = '{$contactNum}', profileImg = '{$target_file}', course = '{$course}', isVaccinated = '{$vaccinated}' WHERE studentId = '{$id}'";
    if ($mysqli->query($query)) {
    	$id = $mysqli->insert_id;
    	error_log("Updated {$firstName} as ID {$id}");
    	return true;
    } else {
    	error_log("Problem inserting {$query}");
    	return false;
    } //end function registerUser
    }
?>