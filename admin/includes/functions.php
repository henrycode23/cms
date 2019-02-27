<?php
// functions.php
//function func_name($result){
    //global $connection;
    // statements... example if($result)
//}

// function call at other_page.php
//func_name($query_name);


function insert_categories(){
    global $connection;
    // CREATE CATEGORY - INSERT INTO
    if(isset($_POST['insert_category'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";
            $insert_categories = mysqli_query($connection, $query);
            if(!$insert_categories){
                die("QUERY FAILED " . mysqli_error($connection));
            }
        }
    }

}

function select_category_display(){
    global $connection;
    // SELECT CATEGORY THEN DISPLAY
    $query = "SELECT * FROM categories";
    $select_category = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_category)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id' class='btn btn-primary'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$cat_id' class='btn btn-primary'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_category(){
    global $connection;
    // DELETE CATEGORY
    if(isset($_GET['delete'])){
        $get_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $get_cat_id";
        $delete_category = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}


// USERS ONLINE FEATURE
function users_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include "../includes/db.php";
            
            $session = session_id(); // VAR TO CONTAIN CATCH IDs SESSION
            $time = time(); // VAR TO CONTAIN TIME
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds; // CALCULATE USER STAYED TIME
        
            $select_users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE session = '$session' ");
            $count = mysqli_num_rows($select_users_online);
            if($count == NULL){ // IF NEW USER, INSERT SESSION & TIME
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
            } else{ // IF OLD USER, UPDATE TIME
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }
        
            $users_online_stayed = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_stayed); // IF USER STAYED 30secs OR MORE, COUNT USER
        }
    } // GET ONLINEUSERS
}
users_online();