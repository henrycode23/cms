<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2">Change Role</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>

    <?php
    // SELECT USERS TO OUTPUT
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];   // ?DELETE=$USER_ID
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            // OUTPUT TO VIEW_ALL_USERS TABLE
            echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";

                echo "<td><a href='users.php?cta=$user_id' class='btn btn-success'>Admin</a></td>";
                echo "<td><a href='users.php?cts=$user_id' class='btn btn-warning'>Subscriber</a></td>";
                echo "<td><a href='users.php?source=edit_user&edit_user=$user_id' class='btn btn-primary'>Edit</a></td>";
                echo "<td><a href='users.php?delete=$user_id' onclick=\"javascript: return confirm('Are you sure you want to delete?'); \" class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";

                // RELATE POST_ID TO COMMENT_POST_ID
                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                // $relate_post_to_comment = mysqli_query($connection, $query);
                // while($row = mysqli_fetch_assoc($relate_post_to_comment)){
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];

                //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                // }
        }
    ?>

    </tbody>
</table>

<?php
// DELETE USER
    if(isset($_GET['delete'])){
        $get_delete_user = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = $get_delete_user";
        $delete_user = mysqli_query($connection, $query);

        header("Location: users.php");
    }

// CTA / CHANGE TO ADMIN USER ROLE
    if(isset($_GET['cta'])){
        $get_cta_comment = $_GET['cta'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $get_cta_comment ";
        $cta_user = mysqli_query($connection, $query);

        header("Location: users.php");
    }

// CTS / CHANGE TO SUBSCRIBER USER ROLE
    if(isset($_GET['cts'])){
        $get_cts_comment = $_GET['cts'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $get_cts_comment ";
        $cts_user = mysqli_query($connection, $query);

        header("Location: users.php");
    }
?>