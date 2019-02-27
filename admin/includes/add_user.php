<?php
    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        // $user_image = $_POST['user_image'];
        $user_role = $_POST['user_role'];

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10) );

        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $query .= "VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role')";
        $create_user = mysqli_query($connection, $query);

        if(!$create_user){
            die("QUERY FAILED " . mysqli_error($connection));
        }

        echo "User Created: ". " ". "<a href='users.php'>View Users</a>" ;
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Add User</h1>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" class="form-control">
            <option value="subscriber">Select Options</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-primary" value="Add User">
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