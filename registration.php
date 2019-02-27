<?php  include "includes/header.php"; ?>

<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if(!empty($username) && !empty($user_firstname) && !empty($user_lastname) && !empty($user_email) && !empty($user_password) ){
            $username = mysqli_real_escape_string($connection, $username);
            $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
            $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
            $user_email = mysqli_real_escape_string($connection, $user_email);
            $user_password = mysqli_real_escape_string($connection, $user_password);

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 10) ); // NEW PASSWORD ENCRYPTION
    
            // $query = "SELECT randSalt FROM users";
            // $select_randSalt = mysqli_query($connection, $query);
            // if(!$select_randSalt){
            //     die("QUERY FAILED ". mysqli_error($connection));
            // }

            // $row = mysqli_fetch_array($select_randSalt);
            // $salt = $row['randSalt'];
            // $user_password = crypt($user_password, $salt);  // CRYPT

            $query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_password, user_role) ";
            $query .= "VALUES('$username', '$user_firstname', '$user_lastname', '$user_email', '$user_password', 'subscriber')";
            $register_user = mysqli_query($connection, $query);
            if(!$register_user){
                die("QUERY FAILED ". mysqli_error($connection));
            }
                
            $message = "Your registration has been submitted";

        } else{
            $message = "Fields cannot be empty";
        }

    } else{
        $message = "";
    }
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="user_firstname" class="sr-only">First Name</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="Enter Desired First Name">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">Last Name</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Enter Desired Last Name">
                        </div>
                         <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
