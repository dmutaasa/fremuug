<?php


session_start();



// initializing variables

$firstname = "";
$lastname = "";
$user_id = "";
$Email = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'admin', 'lubega1992', 'fremuug');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $Email = mysqli_real_escape_string($db, $_POST['Email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "First Name is required"); }
  if (empty($lastname)) { array_push($errors, "Last_Name is required"); }
  if (empty($user_id)) { array_push($errors, "user_id is required"); }
  if (empty($Email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same user_id and/or email
  $user_check_query = "SELECT * FROM users WHERE user_id='$user_id' OR Email='$Email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_id'] === $user_id) {
      array_push($errors, "user_id already exists");
    }

    if ($user['Email'] === $Email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (First_name,Last_name,user_id, Email, password) 
  			  VALUES('$firstname','$lastname','$user_id', '$Email','$password')";
  	mysqli_query($db, $query);
  	
  	$_SESSION['success'] = "You are now logged in";
	
	
  	header('location: Registration.php');
  }
}

// ... 

// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($user_id)) {
  	array_push($errors, "user_id is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM admins WHERE user_name='$user_id' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
		$users = mysqli_fetch_assoc($results);
  	  $_SESSION['user_name'] = $user_name;
	  $_SESSION['First_name'] = $users['First_name'];
	  $_SESSION['Last_name'] = $users['Last_name'];
      
	  
	  
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location:index.php?page=dashboard');

  	}else {
  		array_push($errors, "Wrong user_id/password combination");
  	}
  }
 }


?>