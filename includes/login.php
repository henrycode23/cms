<?php 
include "db.php"; 
session_start();    // ENABLING $_SESSION

if(isset($_POST['login'])){ // IF LOGIN SUBMITS
    $username = $_POST['username']; // CAPTURE DATA ON USERNAME INPUT
    $user_password = $_POST['user_password']; // CAPTURE DATA ON PASSWORD INPUT

    $username = mysqli_real_escape_string($connection, $username);  // SECURE DATA CAPTURE
    $user_password = mysqli_real_escape_string($connection, $user_password);  // SECURE DATA CAPTURE

    $query = "SELECT * FROM users WHERE username = '$username' ";   // SELECT QUERY
    $select_users = mysqli_query($connection, $query);

    if(!$select_users){
        die("QUERY FAILED ". mysqli_error($connection));    // QUERY ERROR DETECTION
    }

    while($row = mysqli_fetch_array($select_users)){    // LOOP THROUGH DATA
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password']; // HASHED PASSWORD IN DB
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }

    if(password_verify($user_password, $db_user_password)){  // NEW WAY TO VALIDATE LOGIN
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: ../admin");   // GO TO ADMIN
    } else{ // DEFAULT
        header("Location: ../index.php");   // GO TO INDEX
    }

    // $user_password = crypt($user_password, $db_user_password);  // CRYPT REVERSE

    // if($username === $db_username && $user_password === $db_user_password){  // OLD VALIDATE DATA, IF STRICT TRUE
    //     $_SESSION['username'] = $db_username;
    //     $_SESSION['firstname'] = $db_user_firstname;
    //     $_SESSION['lastname'] = $db_user_lastname;
    //     $_SESSION['user_role'] = $db_user_role;
    //     header("Location: ../admin");   // GO TO ADMIN
    // } else{ // DEFAULT
    //     header("Location: ../index.php");   // GO TO INDEX
    // }

}

?>
