<?php
    include "includes/admin_header.php";

    if(isset($_SESSION['username'])){
        $username_session = $_SESSION['username'];
    
        $query = "SELECT * FROM users WHERE username = '{$username_session}' "; // SELECT USERS TO OUTPUT
        $select_user_profile = mysqli_query($connection, $query);

        if(!$select_user_profile){
            die("QUERY FAILED ". mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_user_profile)){
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }

    if(isset($_POST['edit_user'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        
        // NEW PASSWORD ENCRYPTION AND VALIDATION
        if(!empty($user_password)){ // IF $USER_PASSWORD IS NOT EMPTY
            $query = "SELECT user_password FROM users WHERE username = '$username_session' ";
            $get_profile = mysqli_query($connection, $query);
            if(!$get_profile){
                die("QUERY FAILED ". mysqli_error($connection));
            }
            $row = mysqli_fetch_array($get_profile); // GET A ROW OF DATA
            $db_user_password = $row['user_password']; // GET ROW VALUE, CONTAIN TO VAR
        }
        if($db_user_password != $user_password){ // IF USER_PASSWORD IS NOT MATCH
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10) ); // HASH ENCRYPT USER_PASSWORD TO MATCH, CONTAIN TO VAR
        }

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE username = '{$username_session}' ";

        $update_user = mysqli_query($connection, $query);

        if(!$update_user){
            die("QUERY FAILED " . mysqli_error($connection));
        }
    }
?>


    <div id="wrapper">

        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Panel
                            <small><?php echo $username_session; ?></small>
                        </h1>
                        <!-- FORM -->
                        <form action="" method="post" enctype="multipart/form-data">
                            <h1>User Profile</h1>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="user_role">User Role</label>
                                <select name="user_role" class="form-control">
                                    <option value="subscriber"><?php echo $user_role; ?></option>
                                    <?php
                                        if($user_role == 'admin'){
                                            echo "<option value='subscriber'>subscriber</option>";
                                        } else{
                                            echo "<option value='admin'>admin</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" name="user_firstname" value="<?php echo $user_firstname; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" name="user_lastname" value="<?php echo $user_lastname; ?>" class="form-control">
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
                                <input type="submit" name="edit_user" class="btn btn-primary" value="Update Profile">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>