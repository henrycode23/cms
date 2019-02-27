<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>

    <?php
    // VIEW SELECT COMMENTS
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];   // ?DELETE=$COMMENT_ID
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];

            // OUTPUT TO VIEW_ALL_COMMENTS TABLE
            echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";

                // RELATE POST_ID TO COMMENT_POST_ID
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $relate_post_to_comment = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($relate_post_to_comment)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }

                echo "<td>$comment_date</td>";
                echo "<td><a href='comments.php?approve=$comment_id' class='btn btn-primary'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove=$comment_id' class='btn btn-primary'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete=$comment_id' class='btn btn-danger'>Delete</a></td>";
            echo "</tr>";
        }
    ?>

    </tbody>
</table>

<?php
// DELETE COMMENT
    if(isset($_GET['delete'])){
        $get_delete_comment = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = $get_delete_comment";
        $delete_comment = mysqli_query($connection, $query);

        header("Location: comments.php");
    }

// UNAPPROVE COMMENT
    if(isset($_GET['unapprove'])){
        $get_unapprove_comment = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $get_unapprove_comment ";
        $unapprove_comment = mysqli_query($connection, $query);

        header("Location: comments.php");
    }

// APPROVE COMMENT
    if(isset($_GET['approve'])){
        $get_approve_comment = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $get_approve_comment ";
        $unapprove_comment = mysqli_query($connection, $query);

        header("Location: comments.php");
    }
?>