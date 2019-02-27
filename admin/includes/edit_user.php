<?php
    if(isset($_GET['edit_user'])){ // IF GET CATCHES EDIT_USER URL PARAMS
        $get_edit_user = $_GET['edit_user']; // GET EDIT_USER, CONTAIN TO VAR
    
        $query = "SELECT * FROM users WHERE user_id = $get_edit_user"; // SELECT USERS TO OUTPUT
        $select_users = mysqli_query($connection, $query); 
        while($row = mysqli_fetch_assoc($select_users)){ // WHILE LOOP THROUGH QUERY
            // GET DATA, LOOP, CONTAIN TO VAR
            $user_id = $row['user_id'];   // LINKED TO: ?DELETE=$USER_ID
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }

        if(isset($_POST['edit_user'])){ // IF POST CATCHES EDIT_USER
            // CATCH THE INPUTS, CONTAIN TO VAR
            $username = $_POST['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_password = $_POST['user_password'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];

            // OLD PASSWORD ENCRYPTION AND VALIDATION
            // $query = "SELECT randSalt FROM users";
            // $select_randSalt = mysqli_query($connection, $query);
            // if(!$select_randSalt){
            //     die("QUERY FAILED ". mysqli_error($connection));
            // }
            // $row = mysqli_fetch_array($select_randSalt);    // 1 result back
            // $salt = $row['randSalt'];
            // $hashed_password = crypt($user_password, $salt);

            // if(!empty($user_password)){
            //     $query = "UPDATE users SET ";
            //     $query.= "user_password = '$hashed_password' ";
            //     $query.= "WHERE user_id = '$get_edit_user' ";
            //     $edit_user_password = mysqli_query($connection, $query);
            //     if(!$edit_user_password){
            //         die("QUERY FAILED ". mysqli_error($connection));
            //     }
            // }

            // NEW PASSWORD ENCRYPTION AND VALIDATION
            if(!empty($user_password)){ // IF $USER_PASSWORD IS NOT EMPTY
                $query = "SELECT user_password FROM users WHERE user_id = $get_edit_user";
                $get_user = mysqli_query($connection, $query);
                if(!$get_user){
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                $row = mysqli_fetch_array($get_user); // GET A ROW OF DATA
                $db_user_password = $row['user_password']; // GET ROW VALUE, CONTAIN TO VAR
            }
            if($db_user_password != $user_password){ // IF USER_PASSWORD IS NOT MATCH
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10) ); // HASH ENCRYPT USER_PASSWORD TO MATCH, CONTAIN TO VAR
            }

            $query = "UPDATE users SET "; 
            $query.= "username = '$username', ";
            $query.= "user_firstname = '$user_firstname', ";
            $query.= "user_lastname = '$user_lastname', ";
            $query.= "user_password = '$hashed_password', "; // USER_PASSWORD = $HASHED_PASSWORD
            $query.= "user_email = '$user_email', ";
            $query.= "user_role = '$user_role' ";
            $query.= "WHERE user_id = '$get_edit_user' ";

            $update_user = mysqli_query($connection, $query);

            if(!$update_user){
                die("QUERY FAILED " . mysqli_error($connection));
            }

            echo "User Updated: ". " ". "<a href='users.php'>View Users</a>" ;
        }
    } else{ // ELSE NO EDIT_USER FOUND
        header("Location: index.php"); // REDIRECT TO INDEX
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Edit User</h1>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" value="<?php echo $user_firstname; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" value="<?php echo $user_lastname; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" value="<?php echo $user_email; ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" value="" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" class="form-control">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
                if($user_role == 'admin'){
                    echo "<option value='subscriber'>subscriber</option>";
                } else {
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="edit_user" class="btn btn-primary" value="Update User">
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control-static">
    </div> -->
    <!-- <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="" class="form-control">
            <?php
                // $query = "SELECT * FROM users";
                // $select_users = mysqli_query($connection, $query);
                // if(!$select_users){
                //     die("QUERY FAILED " . mysqli_error($connection));
                // }
                // while($row = mysqli_fetch_assoc($select_users)){
                //     $user_id = $row['user_id'];
                //     $user_role = $row['user_role'];

                //     echo "<option value='$user_id'>$user_role</option>";
                // }
            ?>     
        </select>
    </div> -->
</form>